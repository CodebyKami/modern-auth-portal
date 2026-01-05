<?php
/**
 * Admin Settings Page Template
 *
 * @package ModernAuthPortal
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
    'brand' => get_option('map_brand_name', __('Welcome', 'modern-auth-portal')),
    'tagline' => get_option('map_tagline', __('Sign in to continue', 'modern-auth-portal')),
    'login_attempts' => get_option('map_login_attempts', '5'),
    'lockout_duration' => get_option('map_lockout_duration', '15')
);

$all_pages = get_pages();
$portal_users = count(get_users(array('role' => MAP_ROLE)));
?>

<div class="wrap map-admin">
    <h1><?php esc_html_e('Modern Auth Portal - Settings', 'modern-auth-portal'); ?></h1>
    
    <div class="map-stats">
        <div class="stat-box">
            <div class="stat-number"><?php echo esc_html($portal_users); ?></div>
            <div class="stat-label"><?php esc_html_e('Dashboard Users', 'modern-auth-portal'); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?php echo esc_html(count($settings['restricted'])); ?></div>
            <div class="stat-label"><?php esc_html_e('Protected Pages', 'modern-auth-portal'); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-number">7</div>
            <div class="stat-label"><?php esc_html_e('Shortcodes Available', 'modern-auth-portal'); ?></div>
        </div>
    </div>
    
    <form method="post" enctype="multipart/form-data" class="map-form">
        <?php wp_nonce_field('map_settings', 'map_nonce'); ?>
        
        <!-- Branding Section -->
        <div class="map-section">
            <h2><?php esc_html_e('Branding', 'modern-auth-portal'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="logo_upload"><?php esc_html_e('Logo', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <?php if ($settings['logo']): ?>
                            <img src="<?php echo esc_url($settings['logo']); ?>" class="map-logo-preview" alt="<?php esc_attr_e('Current Logo', 'modern-auth-portal'); ?>">
                        <?php endif; ?>
                        <input type="file" name="logo_upload" id="logo_upload" accept="image/*">
                        <p class="map-help-text"><?php esc_html_e('Upload your logo (recommended size: 200x200px)', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="brand_name"><?php esc_html_e('Brand Name', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr($settings['brand']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Displayed as the main title on auth pages', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="tagline"><?php esc_html_e('Tagline', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="tagline" id="tagline" value="<?php echo esc_attr($settings['tagline']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Subtitle text below the brand name', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
            </table>
            
            <h3><?php esc_html_e('Colors', 'modern-auth-portal'); ?></h3>
            <div class="color-grid">
                <div class="color-item">
                    <label for="primary_color"><?php esc_html_e('Primary Color', 'modern-auth-portal'); ?></label>
                    <input type="color" name="primary_color" id="primary_color" value="<?php echo esc_attr($settings['primary']); ?>">
                    <span><?php echo esc_html($settings['primary']); ?></span>
                </div>
                <div class="color-item">
                    <label for="secondary_color"><?php esc_html_e('Secondary Color', 'modern-auth-portal'); ?></label>
                    <input type="color" name="secondary_color" id="secondary_color" value="<?php echo esc_attr($settings['secondary']); ?>">
                    <span><?php echo esc_html($settings['secondary']); ?></span>
                </div>
            </div>
            
            <p style="margin-top:20px;">
                <button type="submit" name="map_reset_colors" class="button" style="background:#dc3545;color:white;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;">
                    <?php esc_html_e('Reset Colors to Default', 'modern-auth-portal'); ?>
                </button>
            </p>
        </div>
        
        <!-- Authentication Settings -->
        <div class="map-section">
            <h2><?php esc_html_e('Authentication Settings', 'modern-auth-portal'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e('Enable Registration', 'modern-auth-portal'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_registration" value="1" <?php checked($settings['enable_reg'], '1'); ?>>
                            <?php esc_html_e('Allow new users to register', 'modern-auth-portal'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Require Approval', 'modern-auth-portal'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="require_approval" value="1" <?php checked($settings['require_approval'], '1'); ?>>
                            <?php esc_html_e('New registrations require admin approval', 'modern-auth-portal'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="redirect_url"><?php esc_html_e('Redirect After Login', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <input type="url" name="redirect_url" id="redirect_url" value="<?php echo esc_attr($settings['redirect']); ?>" class="regular-text">
                        <p class="map-help-text"><?php esc_html_e('Where to redirect users after successful login', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Security Settings -->
        <div class="map-section">
            <h2><?php esc_html_e('Security Settings', 'modern-auth-portal'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="login_attempts"><?php esc_html_e('Max Login Attempts', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <input type="number" name="login_attempts" id="login_attempts" value="<?php echo esc_attr($settings['login_attempts']); ?>" min="3" max="10" class="small-text">
                        <p class="map-help-text"><?php esc_html_e('Maximum failed login attempts before lockout (3-10)', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="lockout_duration"><?php esc_html_e('Lockout Duration', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <input type="number" name="lockout_duration" id="lockout_duration" value="<?php echo esc_attr($settings['lockout_duration']); ?>" min="5" max="60" class="small-text">
                        <?php esc_html_e('minutes', 'modern-auth-portal'); ?>
                        <p class="map-help-text"><?php esc_html_e('How long to lock out users after max attempts (5-60 minutes)', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Page Protection -->
        <div class="map-section">
            <h2><?php esc_html_e('Page Protection', 'modern-auth-portal'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="restricted_pages"><?php esc_html_e('Protected Pages', 'modern-auth-portal'); ?></label>
                    </th>
                    <td>
                        <select name="restricted_pages[]" id="restricted_pages" multiple size="8" style="width:100%;max-width:400px;">
                            <?php foreach ($all_pages as $page): ?>
                                <option value="<?php echo esc_attr($page->ID); ?>" <?php echo in_array($page->ID, $settings['restricted']) ? 'selected' : ''; ?>>
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="map-help-text"><?php esc_html_e('Hold Ctrl/Cmd to select multiple pages. Selected pages will only be accessible to logged-in users.', 'modern-auth-portal'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Shortcodes -->
        <div class="map-section">
            <h2><?php esc_html_e('Available Shortcodes', 'modern-auth-portal'); ?></h2>
            <p><?php esc_html_e('Copy and paste these shortcodes into your pages:', 'modern-auth-portal'); ?></p>
            <div class="shortcode-grid">
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Login Form', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_login]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Profile Editor', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_profile]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Change Password', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_change_password]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Reset Password', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_reset_password]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Logout Button', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_logout]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Welcome Message', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_welcome]</code>
                </div>
                <div class="shortcode-card">
                    <strong><?php esc_html_e('Login Status', 'modern-auth-portal'); ?></strong>
                    <code>[modern_auth_status]</code>
                </div>
            </div>
        </div>
        
        <p class="submit">
            <button type="submit" name="map_save" class="button button-primary button-hero">
                <?php esc_html_e('Save All Settings', 'modern-auth-portal'); ?>
            </button>
        </p>
    </form>
</div>
