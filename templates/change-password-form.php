<?php
/**
 * Change Password Form Template
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
                                <path d="M40 28v-8m-12 20h24m-24 12h24" stroke="#D4FF00" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <h1 class="map-title"><?php esc_html_e('Security', 'modern-auth-portal'); ?></h1>
                    <p class="map-subtitle"><?php esc_html_e('Update your password', 'modern-auth-portal'); ?></p>
                    <div class="map-decorative-line"></div>
                </div>
            </div>
            
            <div class="map-right">
                <div class="map-form-wrapper">
                    <h2><?php esc_html_e('Change Password', 'modern-auth-portal'); ?></h2>
                    <div id="mapChgPwdMsg_<?php echo esc_attr($unique_id); ?>"></div>
                    <form id="mapChgPwdForm_<?php echo esc_attr($unique_id); ?>">
                        <?php wp_nonce_field('map_change_password', 'map_change_password_nonce'); ?>
                        <div class="map-field">
                            <label for="current_password_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Current Password', 'modern-auth-portal'); ?>
                            </label>
                            <input type="password" name="current_password" id="current_password_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Enter current password', 'modern-auth-portal'); ?>">
                        </div>
                        <div class="map-field">
                            <label for="new_password_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('New Password', 'modern-auth-portal'); ?>
                            </label>
                            <input type="password" name="new_password" id="new_password_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Min 8 characters', 'modern-auth-portal'); ?>" minlength="8">
                        </div>
                        <div class="map-field">
                            <label for="confirm_password_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Confirm New Password', 'modern-auth-portal'); ?>
                            </label>
                            <input type="password" name="confirm_password" id="confirm_password_<?php echo esc_attr($unique_id); ?>" required placeholder="<?php esc_attr_e('Re-enter new password', 'modern-auth-portal'); ?>">
                        </div>
                        <button type="submit" class="map-btn"><?php esc_html_e('CHANGE PASSWORD', 'modern-auth-portal'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
