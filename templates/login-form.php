<?php
/**
 * Login Form Template
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

$logo = get_option('map_logo_url', '');
$brand = get_option('map_brand_name', __('Welcome', 'modern-auth-portal'));
$tagline = get_option('map_tagline', __('Sign in to continue', 'modern-auth-portal'));
$enable_reg = get_option('map_enable_registration', '1');
$ajax_url = admin_url('admin-ajax.php');
?>

<div class="map-wrapper-<?php echo esc_attr($unique_id); ?>" id="<?php echo esc_attr($unique_id); ?>">
    <div class="map-container">
        <div class="map-card">
            <div class="map-left">
                <div class="map-bg-pattern">
                    <div class="particle particle-1"></div>
                    <div class="particle particle-2"></div>
                    <div class="particle particle-3"></div>
                    <div class="particle particle-4"></div>
                    <div class="pattern-circle circle-1"></div>
                    <div class="pattern-circle circle-2"></div>
                    <div class="animated-line line-1"></div>
                </div>
                
                <div class="map-content">
                    <?php if ($logo): ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr_e('Logo', 'modern-auth-portal'); ?>" class="map-logo">
                    <?php else: ?>
                        <div class="map-brand-icon">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="40" cy="40" r="35" stroke="#D4FF00" stroke-width="3"/>
                                <path d="M40 25V40L50 50" stroke="#D4FF00" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <h1 class="map-title"><?php echo esc_html($brand); ?></h1>
                    <p class="map-subtitle"><?php echo esc_html($tagline); ?></p>
                    <div class="map-decorative-line"></div>
                </div>
            </div>
            
            <div class="map-right">
                <div class="map-form-wrapper">
                    <div id="loginFormContainer_<?php echo esc_attr($unique_id); ?>" style="display: block;">
                        <h2><?php esc_html_e('Sign In', 'modern-auth-portal'); ?></h2>
                        <div id="mapLoginMsg_<?php echo esc_attr($unique_id); ?>"></div>
                        <form id="mapLoginForm_<?php echo esc_attr($unique_id); ?>">
                            <?php wp_nonce_field('map_login', 'map_login_nonce'); ?>
                            <div class="map-field">
                                <label for="login_username_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Username or Email', 'modern-auth-portal'); ?>
                                </label>
                                <input type="text" name="username" id="login_username_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Enter username or email', 'modern-auth-portal'); ?>">
                            </div>
                            <div class="map-field">
                                <label for="login_password_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Password', 'modern-auth-portal'); ?>
                                </label>
                                <input type="password" name="password" id="login_password_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Enter password', 'modern-auth-portal'); ?>">
                            </div>
                            <label class="map-check">
                                <input type="checkbox" name="remember">
                                <span><?php esc_html_e('Remember me', 'modern-auth-portal'); ?></span>
                            </label>
                            <button type="submit" class="map-btn"><?php esc_html_e('SIGN IN', 'modern-auth-portal'); ?></button>
                        </form>
                        <?php if ($enable_reg == '1'): ?>
                        <div class="toggle-link">
                            <?php esc_html_e("Don't have an account?", 'modern-auth-portal'); ?> 
                            <a href="#" class="toggle-register-link" data-unique="<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Create one', 'modern-auth-portal'); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($enable_reg == '1'): ?>
                    <div id="registerFormContainer_<?php echo esc_attr($unique_id); ?>" style="display: none;">
                        <h2><?php esc_html_e('Create Account', 'modern-auth-portal'); ?></h2>
                        <div id="mapRegMsg_<?php echo esc_attr($unique_id); ?>"></div>
                        <form id="mapRegForm_<?php echo esc_attr($unique_id); ?>">
                            <?php wp_nonce_field('map_register', 'map_register_nonce'); ?>
                            <div class="map-field">
                                <label for="reg_name_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Full Name', 'modern-auth-portal'); ?>
                                </label>
                                <input type="text" name="name" id="reg_name_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('John Doe', 'modern-auth-portal'); ?>">
                            </div>
                            <div class="map-field">
                                <label for="reg_username_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Username', 'modern-auth-portal'); ?>
                                </label>
                                <input type="text" name="username" id="reg_username_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Choose username', 'modern-auth-portal'); ?>" minlength="3">
                            </div>
                            <div class="map-field">
                                <label for="reg_email_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Email', 'modern-auth-portal'); ?>
                                </label>
                                <input type="email" name="email" id="reg_email_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('your@email.com', 'modern-auth-portal'); ?>">
                            </div>
                            <div class="map-field">
                                <label for="reg_password_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Password', 'modern-auth-portal'); ?>
                                </label>
                                <input type="password" name="password" id="reg_password_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Min 8 characters', 'modern-auth-portal'); ?>" minlength="8">
                            </div>
                            <button type="submit" class="map-btn"><?php esc_html_e('CREATE ACCOUNT', 'modern-auth-portal'); ?></button>
                        </form>
                        <div class="toggle-link">
                            <?php esc_html_e('Already have an account?', 'modern-auth-portal'); ?> 
                            <a href="#" class="toggle-login-link" data-unique="<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Sign in', 'modern-auth-portal'); ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
