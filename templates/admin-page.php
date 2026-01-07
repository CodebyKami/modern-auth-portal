<?php
/**
 * Admin Settings Page Template
 *
 * @package ModernAuthSystem
 */

if (!defined('ABSPATH')) {
    exit;
}

$settings = array(
    'enable_reg' => get_option('map_enable_registration', '1'),
    'require_approval' => get_option('map_require_approval', '0'),
    'redirect' => get_option('map_redirect_after_login', home_url()),
    'primary' => get_option('map_primary_color', '#D4FF00'),
    'secondary' => get_option('map_secondary_color', '#000000'),
    'restricted' => get_option('map_restricted_pages', array()),
    'logo' => get_option('map_logo_url', ''),
    'brand' => get_option('map_brand_name', __('Welcome', 'modern-auth-system')),
    'tagline' => get_option('map_tagline', __('Sign in to continue', 'modern-auth-system')),
    'login_attempts' => get_option('map_login_attempts', '5'),
    'lockout_duration' => get_option('map_lockout_duration', '15'),
    'user_role' => get_option('map_user_role', 'subscriber'),
    'user_role_name' => get_option('map_user_role_name', __('Member', 'modern-auth-system')),
    'allow_backend_users' => get_option('map_allow_backend_users', '1')
);

$all_pages = get_pages();

// Get all WordPress roles
$wp_roles = wp_roles();
$available_roles = $wp_roles->get_names();

// Count users with selected role
$user_role = $settings['user_role'];
$role_users = count(get_users(array('role' => $user_role)));
?>

<div class="wrap map-admin">
    <h1><?php esc_html_e('Authentication System - Settings', 'modern-auth-system'); ?></h1>
    
    <div class="map-stats">
        <div class="stat-box">
            <div class="stat-number"><?php echo esc_html($role_users); ?></div>
            <div class="stat-label"><?php echo esc_html($settings['user_role_name']); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?php echo esc_html(count($settings['restricted'])); ?></div>
            <div class="stat-label"><?php esc_html_e('Protected Pages', 'modern-auth-system'); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-number">7</div>
            <div class="stat-label"><?php esc_html_e('Shortcodes Available', 'modern-auth-system'); ?></div>
        </div>
    </div>
    
    <form method="post" enctype="multipart/form-data" class="map-form">
        <?php wp_nonce_field('map_settings', 'map_nonce'); ?>
        
        <!-- Branding Section -->
        <div class="map-section">
            <h2><?php esc_html_e('Branding', 'modern-auth-system'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="logo_upload"><?php esc_html_e('Logo', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <?php if ($settings['logo']): ?>
                            <img src="<?php echo esc_url($settings['logo']); ?>" class="map-logo-preview" alt="<?php esc_attr_e('Current Logo', 'modern-auth-system'); ?>">
                        <?php endif; ?>
                        <input type="file" name="logo_upload" id="logo_upload" accept="image/*">
                        <p class="map-help-text"><?php esc_html_e('Upload your logo (recommended size: 200x200px)', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="brand_name"><?php esc_html_e('Brand Name', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr($settings['brand']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Displayed as the main title on authentication pages', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="tagline"><?php esc_html_e('Tagline', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="tagline" id="tagline" value="<?php echo esc_attr($settings['tagline']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Subtitle text below the brand name', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
            </table>
            
            <h3><?php esc_html_e('Colors', 'modern-auth-system'); ?></h3>
            <div class="color-grid">
                <div class="color-item">
                    <label for="primary_color"><?php esc_html_e('Primary Color', 'modern-auth-system'); ?></label>
                    <input type="color" name="primary_color" id="primary_color" value="<?php echo esc_attr($settings['primary']); ?>">
                    <span><?php echo esc_html($settings['primary']); ?></span>
                </div>
                <div class="color-item">
                    <label for="secondary_color"><?php esc_html_e('Secondary Color', 'modern-auth-system'); ?></label>
                    <input type="color" name="secondary_color" id="secondary_color" value="<?php echo esc_attr($settings['secondary']); ?>">
                    <span><?php echo esc_html($settings['secondary']); ?></span>
                </div>
            </div>
            
            <p style="margin-top:20px;">
                <button type="submit" name="map_reset_colors" class="button" style="background:#dc3545;color:white;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;">
                    <?php esc_html_e('Reset Colors to Default', 'modern-auth-system'); ?>
                </button>
            </p>
        </div>
        
        <!-- User Role Settings -->
        <div class="map-section">
            <h2><?php esc_html_e('User Role Settings', 'modern-auth-system'); ?></h2>
            <p class="description"><?php esc_html_e('Configure which WordPress role will be assigned to new registrations and which roles can access the login system.', 'modern-auth-system'); ?></p>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="user_role"><?php esc_html_e('Default User Role', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <select name="user_role" id="user_role" class="regular-text">
                            <?php foreach ($available_roles as $role_slug => $role_name): ?>
                                <option value="<?php echo esc_attr($role_slug); ?>" <?php selected($settings['user_role'], $role_slug); ?>>
                                    <?php echo esc_html($role_name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="map-help-text"><?php esc_html_e('WordPress role assigned to new user registrations', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="user_role_name"><?php esc_html_e('Role Display Name', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="user_role_name" id="user_role_name" value="<?php echo esc_attr($settings['user_role_name']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Friendly name displayed in admin statistics (e.g., "Members", "Customers", "Students")', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Allow Backend Users', 'modern-auth-system'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="allow_backend_users" value="1" <?php checked($settings['allow_backend_users'], '1'); ?>>
                            <?php esc_html_e('Allow users created from WordPress admin panel to login', 'modern-auth-system'); ?>
                        </label>
                        <p class="map-help-text"><?php esc_html_e('When enabled, any user with a standard WordPress role (Subscriber, Contributor, Author, Editor, Administrator) can login through the authentication system.', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Authentication Settings -->
        <div class="map-section">
            <h2><?php esc_html_e('Authentication Settings', 'modern-auth-system'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e('Enable Registration', 'modern-auth-system'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_registration" value="1" <?php checked($settings['enable_reg'], '1'); ?>>
                            <?php esc_html_e('Allow new users to register', 'modern-auth-system'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Require Approval', 'modern-auth-system'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="require_approval" value="1" <?php checked($settings['require_approval'], '1'); ?>>
                            <?php esc_html_e('New registrations require admin approval', 'modern-auth-system'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="redirect_url"><?php esc_html_e('Redirect After Login', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <input type="url" name="redirect_url" id="redirect_url" value="<?php echo esc_attr($settings['redirect']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Where to redirect users after successful login', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Security Settings -->
        <div class="map-section">
            <h2><?php esc_html_e('Security Settings', 'modern-auth-system'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="login_attempts"><?php esc_html_e('Max Login Attempts', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <input type="number" name="login_attempts" id="login_attempts" value="<?php echo esc_attr($settings['login_attempts']); ?>" min="3" max="10" class="small-text">
                        <p class="map-help-text"><?php esc_html_e('Maximum failed login attempts before lockout (3-10)', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="lockout_duration"><?php esc_html_e('Lockout Duration', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <input type="number" name="lockout_duration" id="lockout_duration" value="<?php echo esc_attr($settings['lockout_duration']); ?>" min="5" max="60" class="small-text">
                        <?php esc_html_e('minutes', 'modern-auth-system'); ?>
                        <p class="map-help-text"><?php esc_html_e('How long to lock out users after max attempts (5-60 minutes)', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Page Protection -->
        <div class="map-section">
            <h2><?php esc_html_e('Page Protection', 'modern-auth-system'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="restricted_pages"><?php esc_html_e('Protected Pages', 'modern-auth-system'); ?></label>
                    </th>
                    <td>
                        <select name="restricted_pages[]" id="restricted_pages" multiple size="8" style="width:100%;max-width:400px;">
                            <?php foreach ($all_pages as $page): ?>
                                <option value="<?php echo esc_attr($page->ID); ?>" <?php echo in_array($page->ID, $settings['restricted']) ? 'selected' : ''; ?>>
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="map-help-text"><?php esc_html_e('Hold Ctrl/Cmd to select multiple pages. Selected pages will only be accessible to logged-in users.', 'modern-auth-system'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Shortcodes -->
        <div class="map-section">
            <h2><?php esc_html_e('Available Shortcodes', 'modern-auth-system'); ?></h2>
            <p><?php esc_html_e('Copy and paste these shortcodes into your pages:', 'modern-auth-system'); ?></p>
            <div class="shortcode-grid">
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Login Form', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_login]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Profile Editor', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_profile]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Change Password', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_change_password]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Reset Password', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_reset_password]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Logout Button', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_logout]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Welcome Message', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_welcome]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Login Status', 'modern-auth-system'); ?></strong>
                    <code>[modern_auth_status]</code>
                </div>
            </div>
        </div>
        
        <p class="submit">
            <button type="submit" name="map_save" class="button button-primary button-hero">
                <?php esc_html_e('Save All Settings', 'modern-auth-system'); ?>
            </button>
        </p>
    </form>
</div>
