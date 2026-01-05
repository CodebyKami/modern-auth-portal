<?php
/**
 * Reset Password Form Template
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

$logo = get_option('map_logo_url', '');
$ajax_url = admin_url('admin-ajax.php');
?>

<div class="map-wrapper-<?php echo esc_attr($unique_id); ?>">
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
                                <path d="M50 35h-5v-5a5 5 0 00-10 0v5h-5a2 2 0 00-2 2v18a2 2 0 002 2h20a2 2 0 002-2V37a2 2 0 00-2-2z" stroke="#D4FF00" stroke-width="3"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <h1 class="map-title"><?php esc_html_e('Reset Password', 'modern-auth-portal'); ?></h1>
                    <p class="map-subtitle"><?php esc_html_e("We'll send you a reset link", 'modern-auth-portal'); ?></p>
                    <div class="map-decorative-line"></div>
                </div>
            </div>
            
            <div class="map-right">
                <div class="map-form-wrapper">
                    <h2><?php esc_html_e('Forgot Password?', 'modern-auth-portal'); ?></h2>
                    <div id="mapResetMsg_<?php echo esc_attr($unique_id); ?>"></div>
                    <form id="mapResetForm_<?php echo esc_attr($unique_id); ?>">
                        <?php wp_nonce_field('map_reset_password', 'map_reset_password_nonce'); ?>
                        <div class="map-field">
                            <label for="reset_email_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Email Address', 'modern-auth-portal'); ?>
                            </label>
                            <input type="email" name="email" id="reset_email_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('your@email.com', 'modern-auth-portal'); ?>">
                        </div>
                        <button type="submit" class="map-btn"><?php esc_html_e('SEND RESET LINK', 'modern-auth-portal'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
