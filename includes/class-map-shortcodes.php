<?php
/**
 * Shortcodes Class
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Shortcodes {
    
    /**
     * Initialize shortcodes
     */
    public static function init() {
        add_shortcode('modern_auth_login', array(__CLASS__, 'login_shortcode'));
        add_shortcode('modern_auth_profile', array(__CLASS__, 'profile_shortcode'));
        add_shortcode('modern_auth_change_password', array(__CLASS__, 'change_password_shortcode'));
        add_shortcode('modern_auth_reset_password', array(__CLASS__, 'reset_password_shortcode'));
        add_shortcode('modern_auth_logout', array(__CLASS__, 'logout_shortcode'));
        add_shortcode('modern_auth_welcome', array(__CLASS__, 'welcome_shortcode'));
        add_shortcode('modern_auth_status', array(__CLASS__, 'status_shortcode'));
    }
    
    /**
     * Get base styles
     */
    private static function get_base_styles($unique_id) {
        $primary_color = esc_attr(get_option('map_primary_color', '#D4FF00'));
        $secondary_color = esc_attr(get_option('map_secondary_color', '#000000'));
        
        ob_start();
        include MAP_PLUGIN_DIR . 'templates/styles.php';
        return ob_get_clean();
    }
    
    /**
     * Login shortcode
     */
    public static function login_shortcode() {
        if (is_user_logged_in()) {
            return '<div class="map-notice map-success">' . 
                   esc_html__('You are already logged in.', 'modern-auth-portal') . 
                   ' <a href="' . esc_url(wp_logout_url(home_url())) . '">' . 
                   esc_html__('Logout', 'modern-auth-portal') . '</a></div>';
        }
        
        $unique_id = 'map_' . uniqid();
        
        ob_start();
        echo self::get_base_styles($unique_id);
        include MAP_PLUGIN_DIR . 'templates/login-form.php';
        include MAP_PLUGIN_DIR . 'templates/login-script.php';
        return ob_get_clean();
    }
    
    /**
     * Profile shortcode
     */
    public static function profile_shortcode() {
        if (!is_user_logged_in()) {
            return '<div class="map-notice map-error">' . 
                   esc_html__('You must be logged in to edit your profile.', 'modern-auth-portal') . 
                   '</div>';
        }
        
        $unique_id = 'map_profile_' . uniqid();
        
        ob_start();
        echo self::get_base_styles($unique_id);
        include MAP_PLUGIN_DIR . 'templates/profile-form.php';
        include MAP_PLUGIN_DIR . 'templates/profile-script.php';
        return ob_get_clean();
    }
    
    /**
     * Change password shortcode
     */
    public static function change_password_shortcode() {
        if (!is_user_logged_in()) {
            return '<div class="map-notice map-error">' . 
                   esc_html__('You must be logged in to change your password.', 'modern-auth-portal') . 
                   '</div>';
        }
        
        $unique_id = 'map_chgpwd_' . uniqid();
        
        ob_start();
        echo self::get_base_styles($unique_id);
        include MAP_PLUGIN_DIR . 'templates/change-password-form.php';
        include MAP_PLUGIN_DIR . 'templates/change-password-script.php';
        return ob_get_clean();
    }
    
    /**
     * Reset password shortcode
     */
    public static function reset_password_shortcode() {
        if (is_user_logged_in()) {
            return '<div class="map-notice map-success">' . 
                   esc_html__('You are already logged in.', 'modern-auth-portal') . 
                   '</div>';
        }
        
        $unique_id = 'map_reset_' . uniqid();
        
        ob_start();
        echo self::get_base_styles($unique_id);
        include MAP_PLUGIN_DIR . 'templates/reset-password-form.php';
        include MAP_PLUGIN_DIR . 'templates/reset-password-script.php';
        return ob_get_clean();
    }
    
    /**
     * Logout shortcode
     */
    public static function logout_shortcode() {
        if (!is_user_logged_in()) {
            return '';
        }
        
        return '<a href="' . esc_url(wp_logout_url(home_url())) . '" class="map-logout-btn">' . 
               esc_html__('Logout', 'modern-auth-portal') . 
               '</a>';
    }
    
    /**
     * Welcome shortcode
     */
    public static function welcome_shortcode() {
        if (!is_user_logged_in()) {
            return '';
        }
        
        $user = wp_get_current_user();
        return '<div class="map-welcome-box">' . 
               sprintf(
                   esc_html__('Welcome back, %s!', 'modern-auth-portal'),
                   '<strong>' . esc_html($user->display_name) . '</strong>'
               ) . 
               '</div>';
    }
    
    /**
     * Status shortcode
     */
    public static function status_shortcode() {
        if (is_user_logged_in()) {
            return '<span class="map-status-badge map-status-logged-in">✓ ' . 
                   esc_html__('Logged In', 'modern-auth-portal') . 
                   '</span>';
        } else {
            return '<span class="map-status-badge map-status-logged-out">✗ ' . 
                   esc_html__('Not Logged In', 'modern-auth-portal') . 
                   '</span>';
        }
    }
}
