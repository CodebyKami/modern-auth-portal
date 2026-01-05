<?php
/**
 * Plugin Deactivator
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Deactivator {
    
    /**
     * Deactivate the plugin
     */
    public static function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
        
        // Clear any scheduled events
        wp_clear_scheduled_hook('map_cleanup_lockouts');
        
        // Note: We don't remove user role or options on deactivation
        // This preserves user data if plugin is temporarily deactivated
    }
}
