<?php
/**
 * Page Restrictions Class
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Restrictions {
    
    /**
     * Initialize restrictions
     */
    public static function init() {
        add_action('template_redirect', array(__CLASS__, 'restrict_pages'));
    }
    
    /**
     * Restrict pages to logged-in users
     */
    public static function restrict_pages() {
        if (is_user_logged_in()) {
            return;
        }
        
        $restricted = get_option('map_restricted_pages', array());
        
        if (empty($restricted) || !is_array($restricted)) {
            return;
        }
        
        if (is_page($restricted)) {
            add_filter('the_content', array(__CLASS__, 'replace_with_login_form'));
        }
    }
    
    /**
     * Replace content with login form
     */
    public static function replace_with_login_form($content) {
        return do_shortcode('[modern_auth_login]');
    }
}
