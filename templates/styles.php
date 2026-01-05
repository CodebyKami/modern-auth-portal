<style>
    .map-wrapper-<?php echo esc_attr($unique_id); ?> * {
        box-sizing: border-box !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
        width: 100% !important;
        max-width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: transparent !important;
        padding: 20px !important;
        margin: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-container {
        width: 100% !important;
        max-width: 1000px !important;
        margin: 0 auto !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-card {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        min-height: 500px !important;
        background: white !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2) !important;
        border-radius: 16px !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-left {
        background: linear-gradient(135deg, <?php echo esc_attr($secondary_color); ?> 0%, #1a1a1a 100%) !important;
        position: relative !important;
        overflow: hidden !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 40px 30px !important;
        margin: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-bg-pattern {
        position: absolute !important;
        width: 100% !important;
        height: 100% !important;
        top: 0 !important;
        left: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-bg-pattern::before {
        content: '' !important;
        position: absolute !important;
        width: 200% !important;
        height: 200% !important;
        top: -50% !important;
        left: -50% !important;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 15px,
            rgba(212, 255, 0, 0.08) 15px,
            rgba(212, 255, 0, 0.08) 30px
        ) !important;
        animation: gridMove-<?php echo esc_attr($unique_id); ?> 25s linear infinite !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    @keyframes gridMove-<?php echo esc_attr($unique_id); ?> {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(40px, 40px) rotate(360deg); }
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .particle {
        position: absolute !important;
        background: <?php echo esc_attr($primary_color); ?> !important;
        border-radius: 50% !important;
        opacity: 0.6 !important;
        animation: particleFloat-<?php echo esc_attr($unique_id); ?> 15s infinite ease-in-out !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .particle-1 { width: 8px !important; height: 8px !important; top: 10% !important; left: 15% !important; animation-delay: 0s !important; }
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .particle-2 { width: 6px !important; height: 6px !important; top: 25% !important; left: 80% !important; animation-delay: 2s !important; }
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .particle-3 { width: 10px !important; height: 10px !important; top: 60% !important; left: 10% !important; animation-delay: 4s !important; }
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .particle-4 { width: 7px !important; height: 7px !important; top: 80% !important; left: 70% !important; animation-delay: 6s !important; }
    
    @keyframes particleFloat-<?php echo esc_attr($unique_id); ?> {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
        25% { transform: translate(50px, -80px) scale(1.3); opacity: 0.9; }
        50% { transform: translate(-40px, -150px) scale(0.8); opacity: 0.4; }
        75% { transform: translate(30px, -100px) scale(1.1); opacity: 0.7; }
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .pattern-circle {
        position: absolute !important;
        border-radius: 50% !important;
        background: radial-gradient(circle, rgba(212, 255, 0, 0.4), rgba(212, 255, 0, 0.2) 50%, transparent 70%) !important;
        animation: float-<?php echo esc_attr($unique_id); ?> 18s infinite ease-in-out !important;
        filter: blur(50px) !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .circle-1 {
        width: 350px !important;
        height: 350px !important;
        top: -100px !important;
        left: -100px !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .circle-2 {
        width: 280px !important;
        height: 280px !important;
        bottom: -80px !important;
        right: -80px !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .animated-line {
        position: absolute !important;
        height: 2px !important;
        background: linear-gradient(90deg, transparent, <?php echo esc_attr($primary_color); ?>, transparent) !important;
        opacity: 0.4 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .line-1 {
        width: 200px !important;
        top: 20% !important;
        left: -100px !important;
        animation: lineMove1-<?php echo esc_attr($unique_id); ?> 8s infinite ease-in-out !important;
    }
    
    @keyframes lineMove1-<?php echo esc_attr($unique_id); ?> {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(300px); }
    }
    
    @keyframes float-<?php echo esc_attr($unique_id); ?> {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
        50% { transform: translate(-40px, 40px) scale(0.8); opacity: 0.6; }
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-content {
        position: relative !important;
        z-index: 10 !important;
        text-align: center !important;
        color: white !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-logo {
        max-width: 120px !important;
        margin: 0 auto 25px !important;
        padding: 0 !important;
        filter: drop-shadow(0 10px 30px rgba(0,0,0,0.4)) !important;
        display: block !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-brand-icon {
        margin: 0 auto 25px !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-brand-icon svg {
        filter: drop-shadow(0 0 25px rgba(212, 255, 0, 0.9)) !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-title {
        font-size: 42px !important;
        font-weight: 900 !important;
        margin: 0 0 12px 0 !important;
        padding: 0 !important;
        color: <?php echo esc_attr($primary_color); ?> !important;
        text-shadow: 0 0 50px rgba(212, 255, 0, 0.9) !important;
        letter-spacing: -1px !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-subtitle {
        font-size: 16px !important;
        opacity: 0.95 !important;
        color: #ffffff !important;
        font-weight: 300 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-decorative-line {
        width: 80px !important;
        height: 4px !important;
        background: linear-gradient(90deg, transparent, <?php echo esc_attr($primary_color); ?>, transparent) !important;
        margin: 25px auto 0 !important;
        padding: 0 !important;
        border-radius: 2px !important;
        box-shadow: 0 0 25px rgba(212, 255, 0, 0.7) !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-right {
        background: white !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 40px 30px !important;
        margin: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-form-wrapper {
        width: 100% !important;
        max-width: 380px !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-right h2 {
        font-size: 28px !important;
        font-weight: 800 !important;
        margin: 0 0 25px 0 !important;
        padding: 0 !important;
        color: <?php echo esc_attr($secondary_color); ?> !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field { 
        margin: 0 0 18px 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field label {
        display: block !important;
        font-weight: 700 !important;
        margin: 0 0 6px 0 !important;
        padding: 0 !important;
        color: <?php echo esc_attr($secondary_color); ?> !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field input,
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field textarea {
        width: 100% !important;
        padding: 13px 15px !important;
        margin: 0 !important;
        border: 2px solid #e0e0e0 !important;
        border-radius: 8px !important;
        font-size: 15px !important;
        transition: all 0.3s !important;
        background: #fafafa !important;
        color: #333333 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field textarea {
        resize: vertical !important;
        min-height: 100px !important;
        font-family: inherit !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field input:focus,
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field textarea:focus {
        outline: none !important;
        border-color: <?php echo esc_attr($primary_color); ?> !important;
        background: white !important;
        box-shadow: 0 0 0 4px rgba(212, 255, 0, 0.2) !important;
        transform: translateY(-2px) !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-check {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 15px 0 !important;
        padding: 0 !important;
        font-size: 14px !important;
        cursor: pointer !important;
        color: #666 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-check input[type='checkbox'] {
        width: auto !important;
        cursor: pointer !important;
        accent-color: <?php echo esc_attr($primary_color); ?> !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-btn {
        width: 100% !important;
        padding: 15px !important;
        margin: 15px 0 0 0 !important;
        background: <?php echo esc_attr($secondary_color); ?> !important;
        color: <?php echo esc_attr($primary_color); ?> !important;
        border: none !important;
        border-radius: 8px !important;
        font-size: 15px !important;
        font-weight: 900 !important;
        cursor: pointer !important;
        transition: all 0.3s !important;
        letter-spacing: 1px !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-btn:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 12px 30px rgba(0,0,0,0.25) !important;
        background: #1a1a1a !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-btn:disabled {
        opacity: 0.6 !important;
        cursor: not-allowed !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .toggle-link {
        text-align: center !important;
        margin: 20px 0 0 0 !important;
        padding: 0 !important;
        font-size: 14px !important;
        color: #666 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .toggle-link a {
        color: <?php echo esc_attr($secondary_color); ?> !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        cursor: pointer !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .toggle-link a:hover {
        color: <?php echo esc_attr($primary_color); ?> !important;
        text-decoration: underline !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-notice {
        padding: 12px 14px !important;
        border-radius: 8px !important;
        margin: 0 0 15px 0 !important;
        font-weight: 600 !important;
        font-size: 14px !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-notice.map-error {
        background: #ffebee !important;
        color: #c62828 !important;
        border-left: 4px solid #d32f2f !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-notice.map-success {
        background: #e8f5e9 !important;
        color: #2e7d32 !important;
        border-left: 4px solid #388e3c !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .avatar-upload-wrapper {
        display: flex !important;
        align-items: center !important;
        gap: 18px !important;
        margin: 0 0 20px 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .current-avatar {
        width: 90px !important;
        height: 90px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        border: 3px solid <?php echo esc_attr($primary_color); ?> !important;
        box-shadow: 0 5px 20px rgba(212,255,0,0.3) !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .avatar-upload-info {
        flex: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> .avatar-upload-info label {
        display: block !important;
        font-weight: 700 !important;
        margin: 0 0 6px 0 !important;
        padding: 0 !important;
        color: <?php echo esc_attr($secondary_color); ?> !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
    }
    
    .map-wrapper-<?php echo esc_attr($unique_id); ?> input[type='file'] {
        width: 100% !important;
        padding: 8px !important;
        margin: 0 !important;
        border: 2px dashed #e0e0e0 !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        font-size: 13px !important;
    }
    
    /* Logout Button Styles */
    .map-logout-btn {
        display: inline-block !important;
        padding: 13px 26px !important;
        background: <?php echo esc_attr($secondary_color); ?> !important;
        color: <?php echo esc_attr($primary_color); ?> !important;
        border-radius: 10px !important;
        text-decoration: none !important;
        font-weight: 700 !important;
        transition: all 0.3s !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
    }
    
    .map-logout-btn:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3) !important;
        color: <?php echo esc_attr($primary_color); ?> !important;
    }
    
    /* Welcome Box Styles */
    .map-welcome-box {
        background: <?php echo esc_attr($secondary_color); ?> !important;
        color: <?php echo esc_attr($primary_color); ?> !important;
        padding: 20px 30px !important;
        border-radius: 12px !important;
        border: 2px solid <?php echo esc_attr($primary_color); ?> !important;
        font-weight: 700 !important;
        font-size: 18px !important;
        box-shadow: 0 10px 30px rgba(212,255,0,0.2) !important;
    }
    
    /* Status Badge Styles */
    .map-status-badge {
        display: inline-block !important;
        padding: 8px 16px !important;
        border-radius: 20px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
    }
    
    .map-status-logged-in {
        background: #4CAF50 !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(76,175,80,0.3) !important;
    }
    
    .map-status-logged-out {
        background: #ff9800 !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(255,152,0,0.3) !important;
    }
    
    /* RESPONSIVE DESIGN */
    @media (max-width: 768px) {
        .map-wrapper-<?php echo esc_attr($unique_id); ?> {
            padding: 15px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-card {
            grid-template-columns: 1fr !important;
            min-height: auto !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-left {
            padding: 30px 20px !important;
            min-height: 250px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-right {
            padding: 30px 20px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-title {
            font-size: 32px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-subtitle {
            font-size: 14px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-logo {
            max-width: 100px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-right h2 {
            font-size: 24px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .current-avatar {
            width: 70px !important;
            height: 70px !important;
        }
    }
    
    @media (max-width: 480px) {
        .map-wrapper-<?php echo esc_attr($unique_id); ?> {
            padding: 10px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-left {
            padding: 25px 15px !important;
            min-height: 200px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-right {
            padding: 25px 15px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-title {
            font-size: 28px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-right h2 {
            font-size: 22px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field input,
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-field textarea {
            padding: 12px !important;
            font-size: 14px !important;
        }
        
        .map-wrapper-<?php echo esc_attr($unique_id); ?> .map-btn {
            padding: 14px !important;
            font-size: 14px !important;
        }
    }
</style>
