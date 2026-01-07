<?php
/**
 * Plugin Activator
 *
 * @package ModernAuthSystem
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Activator {
    
    /**
     * Activate the plugin
     */
    public static function activate() {
        // Check WordPress version
        if (version_compare(get_bloginfo('version'), MAP_MIN_WP, '<')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die(
                sprintf(
                    esc_html__('Modern Auth System requires WordPress version %s or higher.', 'modern-auth-system'),
                    MAP_MIN_WP
                )
            );
        }
        
        // Set default options
        self::set_default_options();
        
        // Flush rewrite rules
        flush_rewrite_rules();
        
        // Set activation flag
        set_transient('map_activation_notice', true, 30);
    }
    
    /**
     * Set default plugin options
     */
    private static function set_default_options() {
        $defaults = array(
            'map_enable_registration' => '1',
            'map_require_approval' => '0',
            'map_redirect_after_login' => home_url(),
            'map_primary_color' => '#D4FF00',
            'map_secondary_color' => '#000000',
            'map_restricted_pages' => array(),
            'map_logo_url' => '',
            'map_brand_name' => __('Welcome', 'modern-auth-system'),
            'map_tagline' => __('Sign in to continue', 'modern-auth-system'),
            'map_login_attempts' => '5',
            'map_lockout_duration' => '15',
            'map_user_role' => 'subscriber',
            'map_user_role_name' => __('Member', 'modern-auth-system'),
            'map_allow_backend_users' => '1'
        );
        
        foreach ($defaults as $key => $value) {
            if (get_option($key) === false) {
                add_option($key, $value, '', 'no');
            }
        }
    }
}
