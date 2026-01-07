<?php
/**
 * Page Restrictions Class
 *
 * @package ModernAuthSystem
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Restrictions {
    
    /**
     * Initialize restrictions
     */
    public static function init() {
        add_action('template_redirect', array(__CLASS__, 'restrict_pages'), 1);
        add_filter('the_content', array(__CLASS__, 'maybe_replace_content'), 999);
    }
    
    /**
     * Restrict pages to logged-in users
     */
    public static function restrict_pages() {
        // Skip if user is logged in
        if (is_user_logged_in()) {
            return;
        }
        
        // Skip if not a page
        if (!is_page()) {
            return;
        }
        
        // Get restricted pages
        $restricted = get_option('map_restricted_pages', array());
        
        if (empty($restricted) || !is_array($restricted)) {
            return;
        }
        
        // Get current page ID
        $current_page_id = get_the_ID();
        
        // Check if current page is in restricted list
        if (in_array($current_page_id, $restricted)) {
            // Store flag for content replacement
            global $map_page_restricted;
            $map_page_restricted = true;
        }
    }
    
    /**
     * Maybe replace content with login form
     */
    public static function replace_with_login_form($content) {
        global $map_page_restricted;
        
        // Only replace if page is restricted and user not logged in
        if (!empty($map_page_restricted) && !is_user_logged_in()) {
            return do_shortcode('[modern_auth_login]');
        }
        
        return $content;
    }
}
