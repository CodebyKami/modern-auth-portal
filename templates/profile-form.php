<?php
/**
 * Profile Form Template
 *
 * @package ModernAuthPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

$user = wp_get_current_user();
$avatar = get_user_meta($user->ID, 'map_avatar', true);
if (empty($avatar)) {
    $avatar = get_avatar_url($user->ID);
}
$brand = get_option('map_brand_name', __('Profile', 'modern-auth-portal'));
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
                                <path d="M40 20v20m0 0l15 15M40 40L25 55" stroke="#D4FF00" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <h1 class="map-title"><?php esc_html_e('Edit Profile', 'modern-auth-portal'); ?></h1>
                    <p class="map-subtitle"><?php esc_html_e('Update your information', 'modern-auth-portal'); ?></p>
                    <div class="map-decorative-line"></div>
                </div>
            </div>
            
            <div class="map-right">
                <div class="map-form-wrapper">
                    <h2><?php esc_html_e('Your Profile', 'modern-auth-portal'); ?></h2>
                    <div id="mapProfileMsg_<?php echo esc_attr($unique_id); ?>"></div>
                    <form id="mapProfileForm_<?php echo esc_attr($unique_id); ?>" enctype="multipart/form-data">
                        <?php wp_nonce_field('map_profile', 'map_profile_nonce'); ?>
                        
                        <div class="avatar-upload-wrapper">
                            <img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e('Avatar', 'modern-auth-portal'); ?>" class="current-avatar" id="avatarPreview_<?php echo esc_attr($unique_id); ?>">
                            <div class="avatar-upload-info">
                                <label for="avatar_<?php echo esc_attr($unique_id); ?>">
                                    <?php esc_html_e('Change Avatar', 'modern-auth-portal'); ?>
                                </label>
                                <input type="file" name="avatar" id="avatar_<?php echo esc_attr($unique_id); ?>" accept="image/*">
                            </div>
                        </div>
                        
                        <div class="map-field">
                            <label for="profile_name_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Full Name', 'modern-auth-portal'); ?>
                            </label>
                            <input type="text" name="name" id="profile_name_<?php echo esc_attr($unique_id); ?>" required value="<?php echo esc_attr($user->display_name); ?>" placeholder="<?php esc_attr_e('Your name', 'modern-auth-portal'); ?>">
                        </div>
                        <div class="map-field">
                            <label for="profile_email_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Email', 'modern-auth-portal'); ?>
                            </label>
                            <input type="email" name="email" id="profile_email_<?php echo esc_attr($unique_id); ?>" required value="<?php echo esc_attr($user->user_email); ?>" placeholder="<?php esc_attr_e('your@email.com', 'modern-auth-portal'); ?>">
                        </div>
                        <div class="map-field">
                            <label for="profile_bio_<?php echo esc_attr($unique_id); ?>">
                                <?php esc_html_e('Bio', 'modern-auth-portal'); ?>
                            </label>
                            <textarea name="bio" id="profile_bio_<?php echo esc_attr($unique_id); ?>" placeholder="<?php esc_attr_e('Tell us about yourself...', 'modern-auth-portal'); ?>"><?php echo esc_textarea($user->description); ?></textarea>
                        </div>
                        <button type="submit" class="map-btn"><?php esc_html_e('UPDATE PROFILE', 'modern-auth-portal'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
