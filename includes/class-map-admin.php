<?php
/**
 * Admin Class
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class MAP_Admin {
    
    /**
     * Initialize admin features
     */
    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_admin_menu'));
        add_action('admin_init', array(__CLASS__, 'register_settings'));
        add_action('admin_notices', array(__CLASS__, 'activation_notice'));
        add_action('show_user_profile', array(__CLASS__, 'user_approval_field'));
        add_action('edit_user_profile', array(__CLASS__, 'user_approval_field'));
        add_action('personal_options_update', array(__CLASS__, 'save_approval'));
        add_action('edit_user_profile_update', array(__CLASS__, 'save_approval'));
    }
    
    /**
     * Add admin menu
     */
    public static function add_admin_menu() {
        add_menu_page(
            __('Auth Portal', 'modern-auth-portal'),
            __('Auth Portal', 'modern-auth-portal'),
            'manage_options',
            'modern-auth-portal',
            array(__CLASS__, 'settings_page'),
            'dashicons-lock',
            30
        );
    }
    
    /**
     * Register settings
     */
    public static function register_settings() {
        register_setting('map_settings_group', 'map_enable_registration');
        register_setting('map_settings_group', 'map_require_approval');
        register_setting('map_settings_group', 'map_redirect_after_login');
        register_setting('map_settings_group', 'map_primary_color');
        register_setting('map_settings_group', 'map_secondary_color');
        register_setting('map_settings_group', 'map_brand_name');
        register_setting('map_settings_group', 'map_tagline');
        register_setting('map_settings_group', 'map_restricted_pages');
        register_setting('map_settings_group', 'map_logo_url');
        register_setting('map_settings_group', 'map_login_attempts');
        register_setting('map_settings_group', 'map_lockout_duration');
    }
    
    /**
     * Settings page
     */
    public static function settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Handle form submissions
        if (isset($_POST['map_save']) && check_admin_referer('map_settings', 'map_nonce')) {
            self::save_settings();
            echo '<div class="notice notice-success is-dismissible"><p><strong>' . 
                 esc_html__('Settings saved successfully!', 'modern-auth-portal') . 
                 '</strong></p></div>';
        }
        
        if (isset($_POST['map_reset_colors']) && check_admin_referer('map_settings', 'map_nonce')) {
            update_option('map_primary_color', '#D4FF00');
            update_option('map_secondary_color', '#000000');
            echo '<div class="notice notice-success is-dismissible"><p><strong>' . 
                 esc_html__('Colors reset to default!', 'modern-auth-portal') . 
                 '</strong></p></div>';
        }
        
        include MAP_PLUGIN_DIR . 'templates/admin-page.php';
    }
    
    /**
     * Save settings
     */
    private static function save_settings() {
        // Basic settings
        update_option('map_enable_registration', isset($_POST['enable_registration']) ? '1' : '0');
        update_option('map_require_approval', isset($_POST['require_approval']) ? '1' : '0');
        
        if (isset($_POST['redirect_url'])) {
            update_option('map_redirect_after_login', esc_url_raw(wp_unslash($_POST['redirect_url'])));
        }
        
        // Colors
        if (isset($_POST['primary_color'])) {
            update_option('map_primary_color', sanitize_hex_color(wp_unslash($_POST['primary_color'])));
        }
        
        if (isset($_POST['secondary_color'])) {
            update_option('map_secondary_color', sanitize_hex_color(wp_unslash($_POST['secondary_color'])));
        }
        
        // Branding
        if (isset($_POST['brand_name'])) {
            update_option('map_brand_name', sanitize_text_field(wp_unslash($_POST['brand_name'])));
        }
        
        if (isset($_POST['tagline'])) {
            update_option('map_tagline', sanitize_text_field(wp_unslash($_POST['tagline'])));
        }
        
        // Security settings
        if (isset($_POST['login_attempts'])) {
            update_option('map_login_attempts', absint($_POST['login_attempts']));
        }
        
        if (isset($_POST['lockout_duration'])) {
            update_option('map_lockout_duration', absint($_POST['lockout_duration']));
        }
        
        // Restricted pages
        $restricted_pages = isset($_POST['restricted_pages']) ? array_map('intval', (array) $_POST['restricted_pages']) : array();
        update_option('map_restricted_pages', $restricted_pages);
        
        // Logo upload
        if (!empty($_FILES['logo_upload']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $upload = wp_handle_upload($_FILES['logo_upload'], array('test_form' => false));
            
            if (!isset($upload['error'])) {
                update_option('map_logo_url', esc_url($upload['url']));
            }
        }
    }
    
    /**
     * Activation notice
     */
    public static function activation_notice() {
        if (get_transient('map_activation_notice')) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><strong><?php esc_html_e('Modern Auth Portal activated successfully!', 'modern-auth-portal'); ?></strong></p>
                <p><?php esc_html_e('Get started by configuring your settings in', 'modern-auth-portal'); ?> 
                   <a href="<?php echo esc_url(admin_url('admin.php?page=modern-auth-portal')); ?>">
                       <?php esc_html_e('Auth Portal Settings', 'modern-auth-portal'); ?>
                   </a>
                </p>
            </div>
            <?php
            delete_transient('map_activation_notice');
        }
    }
    
    /**
     * User approval field
     */
    public static function user_approval_field($user) {
        if (!in_array(MAP_ROLE, $user->roles)) {
            return;
        }
        
        $approved = get_user_meta($user->ID, 'map_approved', true);
        ?>
        <h3><?php esc_html_e('Portal Access', 'modern-auth-portal'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="map_approved"><?php esc_html_e('Approval Status', 'modern-auth-portal'); ?></label></th>
                <td>
                    <label>
                        <input type="checkbox" name="map_approved" id="map_approved" value="1" <?php checked($approved, '1'); ?>>
                        <strong><?php esc_html_e('Approve portal access', 'modern-auth-portal'); ?></strong>
                    </label>
                    <p class="description">
                        <?php esc_html_e('Check this box to allow this user to access the portal.', 'modern-auth-portal'); ?>
                    </p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Save approval status
     */
    public static function save_approval($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return;
        }
        
        $approved = isset($_POST['map_approved']) ? '1' : '0';
        update_user_meta($user_id, 'map_approved', $approved);
    }
}
