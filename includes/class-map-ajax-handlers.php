<?php
/**
 * AJAX Handlers Class
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Ajax_Handlers {
    
    /**
     * Initialize AJAX handlers
     */
    public static function init() {
        // Login
        add_action('wp_ajax_nopriv_map_login', array(__CLASS__, 'process_login'));
        add_action('wp_ajax_map_login', array(__CLASS__, 'process_login'));
        
        // Registration
        add_action('wp_ajax_nopriv_map_register', array(__CLASS__, 'process_register'));
        
        // Profile update
        add_action('wp_ajax_map_update_profile', array(__CLASS__, 'process_update_profile'));
        
        // Change password
        add_action('wp_ajax_map_change_password', array(__CLASS__, 'process_change_password'));
        
        // Reset password
        add_action('wp_ajax_nopriv_map_reset_password', array(__CLASS__, 'process_reset_password'));
    }
    
    /**
     * Process login
     */
    public static function process_login() {
        check_ajax_referer('map_login', 'map_login_nonce');
        
        $username_or_email = isset($_POST['username']) ? sanitize_text_field(wp_unslash($_POST['username'])) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $remember = isset($_POST['remember']);
        
        if (empty($username_or_email) || empty($password)) {
            wp_send_json_error(array('message' => __('Please fill in all fields.', 'modern-auth-portal')));
        }
        
        // Try to find user by email or username
        if (is_email($username_or_email)) {
            $user = get_user_by('email', $username_or_email);
        } else {
            $user = get_user_by('login', $username_or_email);
        }
        
        if (!$user || !wp_check_password($password, $user->user_pass, $user->ID)) {
            wp_send_json_error(array('message' => __('Invalid credentials. Please try again.', 'modern-auth-portal')));
        }
        
        // Check if user has required role
        if (!in_array(MAP_ROLE, $user->roles) && !in_array('administrator', $user->roles)) {
            wp_send_json_error(array('message' => __('Access denied. You do not have permission to access this portal.', 'modern-auth-portal')));
        }
        
        // Check approval status
        if (get_option('map_require_approval') == '1') {
            $approved = get_user_meta($user->ID, 'map_approved', true);
            if ($approved !== '1' && !in_array('administrator', $user->roles)) {
                wp_send_json_error(array('message' => __('Your account is pending approval. Please contact an administrator.', 'modern-auth-portal')));
            }
        }
        
        // Clear login attempts on successful login
        $ip = MAP_Security::get_user_ip();
        delete_transient('map_login_attempts_' . $ip);
        delete_transient('map_locked_out_' . $ip);
        
        // Set auth cookie
        wp_set_auth_cookie($user->ID, $remember);
        
        // Get redirect URL
        $redirect = apply_filters('map_login_redirect', get_option('map_redirect_after_login', home_url()), $user);
        
        do_action('map_after_login', $user);
        
        wp_send_json_success(array(
            'redirect' => esc_url($redirect),
            'message' => __('Login successful! Redirecting...', 'modern-auth-portal')
        ));
    }
    
    /**
     * Process registration
     */
    public static function process_register() {
        check_ajax_referer('map_register', 'map_register_nonce');
        
        if (get_option('map_enable_registration') != '1') {
            wp_send_json_error(array('message' => __('Registration is currently disabled.', 'modern-auth-portal')));
        }
        
        $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
        $username = isset($_POST['username']) ? MAP_Security::sanitize_username(wp_unslash($_POST['username'])) : '';
        $email = isset($_POST['email']) ? MAP_Security::validate_email(wp_unslash($_POST['email'])) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        // Validate inputs
        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            wp_send_json_error(array('message' => __('Please fill in all fields.', 'modern-auth-portal')));
        }
        
        // Validate username
        if (strlen($username) < 3) {
            wp_send_json_error(array('message' => __('Username must be at least 3 characters long.', 'modern-auth-portal')));
        }
        
        if (!validate_username($username)) {
            wp_send_json_error(array('message' => __('Username contains invalid characters.', 'modern-auth-portal')));
        }
        
        if (username_exists($username)) {
            wp_send_json_error(array('message' => __('Username already exists. Please choose another.', 'modern-auth-portal')));
        }
        
        // Validate email
        if (!$email) {
            wp_send_json_error(array('message' => __('Please enter a valid email address.', 'modern-auth-portal')));
        }
        
        if (email_exists($email)) {
            wp_send_json_error(array('message' => __('Email address is already registered.', 'modern-auth-portal')));
        }
        
        // Validate password
        $password_check = MAP_Security::validate_password($password);
        if (is_wp_error($password_check)) {
            wp_send_json_error(array('message' => $password_check->get_error_message()));
        }
        
        // Create user
        $user_id = wp_create_user($username, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_send_json_error(array('message' => $user_id->get_error_message()));
        }
        
        // Update user meta with proper name fields
        $name_parts = explode(' ', $name, 2);
        $first_name = $name_parts[0];
        $last_name = isset($name_parts[1]) ? $name_parts[1] : '';
        
        wp_update_user(array(
            'ID' => $user_id,
            'display_name' => $name,
            'first_name' => $first_name,
            'last_name' => $last_name
        ));
        
        // Set user role
        $user = new WP_User($user_id);
        $user->set_role(MAP_ROLE);
        
        // Set approval status
        if (get_option('map_require_approval') == '1') {
            update_user_meta($user_id, 'map_approved', '0');
            
            // Notify admin
            self::notify_admin_new_registration($user);
            
            do_action('map_after_registration', $user, false);
            
            wp_send_json_success(array(
                'message' => __('Registration successful! Your account is pending approval. You will be notified once approved.', 'modern-auth-portal')
            ));
        } else {
            update_user_meta($user_id, 'map_approved', '1');
            
            // Send welcome email
            self::send_welcome_email($user);
            
            do_action('map_after_registration', $user, true);
            
            wp_send_json_success(array(
                'message' => __('Registration successful! You can now login with your credentials.', 'modern-auth-portal')
            ));
        }
    }
    
    /**
     * Process profile update
     */
    public static function process_update_profile() {
        check_ajax_referer('map_profile', 'map_profile_nonce');
        
        if (!is_user_logged_in()) {
            wp_send_json_error(array('message' => __('You must be logged in to update your profile.', 'modern-auth-portal')));
        }
        
        $user_id = get_current_user_id();
        $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
        $email = isset($_POST['email']) ? MAP_Security::validate_email(wp_unslash($_POST['email'])) : '';
        $bio = isset($_POST['bio']) ? sanitize_textarea_field(wp_unslash($_POST['bio'])) : '';
        
        if (empty($name) || empty($email)) {
            wp_send_json_error(array('message' => __('Name and email are required.', 'modern-auth-portal')));
        }
        
        if (!$email) {
            wp_send_json_error(array('message' => __('Please enter a valid email address.', 'modern-auth-portal')));
        }
        
        // Check if email is already in use by another user
        $email_exists = email_exists($email);
        if ($email_exists && $email_exists != $user_id) {
            wp_send_json_error(array('message' => __('Email address is already in use by another account.', 'modern-auth-portal')));
        }
        
        // Update user data
        $name_parts = explode(' ', $name, 2);
        $first_name = $name_parts[0];
        $last_name = isset($name_parts[1]) ? $name_parts[1] : '';
        
        $result = wp_update_user(array(
            'ID' => $user_id,
            'display_name' => $name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_email' => $email,
            'description' => $bio
        ));
        
        if (is_wp_error($result)) {
            wp_send_json_error(array('message' => $result->get_error_message()));
        }
        
        // Handle avatar upload
        if (!empty($_FILES['avatar']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            
            $upload = wp_handle_upload($_FILES['avatar'], array('test_form' => false));
            
            if (!isset($upload['error'])) {
                update_user_meta($user_id, 'map_avatar', esc_url($upload['url']));
            }
        }
        
        do_action('map_after_profile_update', $user_id);
        
        wp_send_json_success(array('message' => __('Profile updated successfully!', 'modern-auth-portal')));
    }
    
    /**
     * Process password change
     */
    public static function process_change_password() {
        check_ajax_referer('map_change_password', 'map_change_password_nonce');
        
        if (!is_user_logged_in()) {
            wp_send_json_error(array('message' => __('You must be logged in to change your password.', 'modern-auth-portal')));
        }
        
        $user_id = get_current_user_id();
        $current_password = isset($_POST['current_password']) ? $_POST['current_password'] : '';
        $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            wp_send_json_error(array('message' => __('Please fill in all fields.', 'modern-auth-portal')));
        }
        
        $user = get_userdata($user_id);
        
        if (!wp_check_password($current_password, $user->user_pass, $user_id)) {
            wp_send_json_error(array('message' => __('Current password is incorrect.', 'modern-auth-portal')));
        }
        
        // Validate new password
        $password_check = MAP_Security::validate_password($new_password);
        if (is_wp_error($password_check)) {
            wp_send_json_error(array('message' => $password_check->get_error_message()));
        }
        
        if ($new_password !== $confirm_password) {
            wp_send_json_error(array('message' => __('New passwords do not match.', 'modern-auth-portal')));
        }
        
        // Update password
        wp_set_password($new_password, $user_id);
        
        // Re-authenticate user
        wp_set_auth_cookie($user_id);
        
        do_action('map_after_password_change', $user_id);
        
        wp_send_json_success(array('message' => __('Password changed successfully!', 'modern-auth-portal')));
    }
    
    /**
     * Process password reset
     */
    public static function process_reset_password() {
        check_ajax_referer('map_reset_password', 'map_reset_password_nonce');
        
        $email = isset($_POST['email']) ? MAP_Security::validate_email(wp_unslash($_POST['email'])) : '';
        
        if (!$email) {
            wp_send_json_error(array('message' => __('Please enter a valid email address.', 'modern-auth-portal')));
        }
        
        $user = get_user_by('email', $email);
        
        if (!$user) {
            wp_send_json_error(array('message' => __('No account found with that email address.', 'modern-auth-portal')));
        }
        
        // Generate reset key
        $key = get_password_reset_key($user);
        
        if (is_wp_error($key)) {
            wp_send_json_error(array('message' => $key->get_error_message()));
        }
        
        // Create reset URL
        $reset_url = add_query_arg(
            array(
                'action' => 'rp',
                'key' => $key,
                'login' => rawurlencode($user->user_login)
            ),
            wp_login_url()
        );
        
        // Send email
        $subject = sprintf(__('[%s] Password Reset Request', 'modern-auth-portal'), get_bloginfo('name'));
        
        $message = sprintf(__('Hi %s,', 'modern-auth-portal'), $user->display_name) . "\n\n";
        $message .= __('You requested a password reset for your account.', 'modern-auth-portal') . "\n\n";
        $message .= __('Click the link below to reset your password:', 'modern-auth-portal') . "\n\n";
        $message .= $reset_url . "\n\n";
        $message .= __('If you did not request this, please ignore this email.', 'modern-auth-portal') . "\n\n";
        $message .= sprintf(__('Thanks,', 'modern-auth-portal')) . "\n";
        $message .= get_bloginfo('name');
        
        $sent = wp_mail($email, $subject, $message);
        
        if ($sent) {
            wp_send_json_success(array('message' => __('Password reset link has been sent to your email address.', 'modern-auth-portal')));
        } else {
            wp_send_json_error(array('message' => __('Failed to send email. Please try again later.', 'modern-auth-portal')));
        }
    }
    
    /**
     * Notify admin of new registration
     */
    private static function notify_admin_new_registration($user) {
        $admin_email = get_option('admin_email');
        $subject = sprintf(__('[%s] New User Registration Pending Approval', 'modern-auth-portal'), get_bloginfo('name'));
        
        $message = sprintf(__('A new user has registered and is awaiting approval:', 'modern-auth-portal')) . "\n\n";
        $message .= sprintf(__('Username: %s', 'modern-auth-portal'), $user->user_login) . "\n";
        $message .= sprintf(__('Email: %s', 'modern-auth-portal'), $user->user_email) . "\n";
        $message .= sprintf(__('Name: %s', 'modern-auth-portal'), $user->display_name) . "\n\n";
        $message .= sprintf(__('To approve this user, visit:', 'modern-auth-portal')) . "\n";
        $message .= admin_url('user-edit.php?user_id=' . $user->ID);
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * Send welcome email
     */
    private static function send_welcome_email($user) {
        $subject = sprintf(__('Welcome to %s!', 'modern-auth-portal'), get_bloginfo('name'));
        
        $message = sprintf(__('Hi %s,', 'modern-auth-portal'), $user->display_name) . "\n\n";
        $message .= sprintf(__('Welcome to %s!', 'modern-auth-portal'), get_bloginfo('name')) . "\n\n";
        $message .= __('Your account has been successfully created.', 'modern-auth-portal') . "\n\n";
        $message .= sprintf(__('Username: %s', 'modern-auth-portal'), $user->user_login) . "\n";
        $message .= sprintf(__('Email: %s', 'modern-auth-portal'), $user->user_email) . "\n\n";
        $message .= __('You can now login to access your account.', 'modern-auth-portal') . "\n\n";
        $message .= sprintf(__('Thanks,', 'modern-auth-portal')) . "\n";
        $message .= get_bloginfo('name');
        
        wp_mail($user->user_email, $subject, $message);
    }
}
