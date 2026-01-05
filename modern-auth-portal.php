<?php
/**
 * Plugin Name: Modern Auth Portal
 * Plugin URI: https://github.com/CodebyKami/modern-auth-portal
 * Description: Complete authentication system with Login, Register, Edit Profile, Reset Password, Change Password - All with stunning modern UI and enterprise-grade security
 * Version: 2.1.0
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Kamran Rasool
 * Author URI: mailto:kamranrasool0045@gmail.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: modern-auth-portal
 * Domain Path: /languages
 * 
 * @package ModernAuthPortal
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Plugin constants
define('MAP_VERSION', '2.1.0');
define('MAP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MAP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MAP_ROLE', 'dashboard_user');
define('MAP_MIN_PHP', '7.4');
define('MAP_MIN_WP', '5.8');

// Check PHP version
if (version_compare(PHP_VERSION, MAP_MIN_PHP, '<')) {
    add_action('admin_notices', 'map_php_version_notice');
    return;
}

function map_php_version_notice() {
    echo '<div class="error"><p>';
    printf(
        esc_html__('Modern Auth Portal requires PHP version %s or higher. You are running version %s.', 'modern-auth-portal'),
        MAP_MIN_PHP,
        PHP_VERSION
    );
    echo '</p></div>';
}

// Include required files
require_once MAP_PLUGIN_DIR . 'includes/class-map-activator.php';
require_once MAP_PLUGIN_DIR . 'includes/class-map-deactivator.php';
require_once MAP_PLUGIN_DIR . 'includes/class-map-security.php';
require_once MAP_PLUGIN_DIR . 'includes/class-map-ajax-handlers.php';
require_once MAP_PLUGIN_DIR . 'includes/class-map-shortcodes.php';
require_once MAP_PLUGIN_DIR . 'includes/class-map-admin.php';
require_once MAP_PLUGIN_DIR . 'includes/class-map-restrictions.php';

// Activation hook
register_activation_hook(__FILE__, array('MAP_Activator', 'activate'));

// Deactivation hook
register_deactivation_hook(__FILE__, array('MAP_Deactivator', 'deactivate'));

// Initialize plugin
function map_init() {
    // Load text domain
    load_plugin_textdomain('modern-auth-portal', false, dirname(plugin_basename(__FILE__)) . '/languages');
    
    // Initialize classes
    MAP_Security::init();
    MAP_Ajax_Handlers::init();
    MAP_Shortcodes::init();
    MAP_Admin::init();
    MAP_Restrictions::init();
}
add_action('plugins_loaded', 'map_init');

// Add settings link on plugin page
function map_add_settings_link($links) {
    $settings_link = '<a href="' . admin_url('admin.php?page=modern-auth-portal') . '">' . __('Settings', 'modern-auth-portal') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'map_add_settings_link');

// Enqueue admin styles
function map_admin_styles($hook) {
    if ($hook !== 'toplevel_page_modern-auth-portal') {
        return;
    }
    wp_enqueue_style('map-admin-styles', MAP_PLUGIN_URL . 'assets/css/admin.css', array(), MAP_VERSION);
}
add_action('admin_enqueue_scripts', 'map_admin_styles');
