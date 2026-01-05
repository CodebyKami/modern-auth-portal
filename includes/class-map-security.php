<?php
/**
 * Security Class
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Security {
    
    /**
     * Initialize security features
     */
    public static function init() {
        add_action('init', array(__CLASS__, 'force_color_check'));
        add_action('wp_login_failed', array(__CLASS__, 'log_failed_login'));
        add_filter('authenticate', array(__CLASS__, 'check_login_lockout'), 30, 3);
    }
    
    /**
     * Force color check on every load
     */
    public static function force_color_check() {
        $current_primary = get_option('map_primary_color');
        $current_secondary = get_option('map_secondary_color');
        
        if ($current_primary !== '#D4FF00') {
            update_option('map_primary_color', '#D4FF00');
        }
        if ($current_secondary !== '#000000') {
            update_option('map_secondary_color', '#000000');
        }
    }
    
    /**
     * Log failed login attempts
     */
    public static function log_failed_login($username) {
        $ip = self::get_user_ip();
        $attempts = get_transient('map_login_attempts_' . $ip);
        
        if ($attempts === false) {
            $attempts = 1;
        } else {
            $attempts++;
        }
        
        $max_attempts = absint(get_option('map_login_attempts', 5));
        $lockout_duration = absint(get_option('map_lockout_duration', 15)) * MINUTE_IN_SECONDS;
        
        set_transient('map_login_attempts_' . $ip, $attempts, $lockout_duration);
        
        if ($attempts >= $max_attempts) {
            set_transient('map_locked_out_' . $ip, true, $lockout_duration);
        }
    }
    
    /**
     * Check if IP is locked out
     */
    public static function check_login_lockout($user, $username, $password) {
        $ip = self::get_user_ip();
        
        if (get_transient('map_locked_out_' . $ip)) {
            $attempts = get_transient('map_login_attempts_' . $ip);
            return new WP_Error(
                'too_many_attempts',
                sprintf(
                    __('Too many failed login attempts. Please try again in %d minutes.', 'modern-auth-portal'),
                    absint(get_option('map_lockout_duration', 15))
                )
            );
        }
        
        return $user;
    }
    
    /**
     * Get user IP address
     */
    public static function get_user_ip() {
        $ip = '';
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = sanitize_text_field(wp_unslash($_SERVER['HTTP_CLIENT_IP']));
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = sanitize_text_field(wp_unslash($_SERVER['HTTP_X_FORWARDED_FOR']));
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR']));
        }
        
        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
    }
    
    /**
     * Sanitize and validate email
     */
    public static function validate_email($email) {
        $email = sanitize_email($email);
        return is_email($email) ? $email : false;
    }
    
    /**
     * Sanitize username
     */
    public static function sanitize_username($username) {
        return sanitize_user($username, true);
    }
    
    /**
     * Validate password strength
     */
    public static function validate_password($password) {
        if (strlen($password) < 8) {
            return new WP_Error('weak_password', __('Password must be at least 8 characters long.', 'modern-auth-portal'));
        }
        
        return true;
    }
}
