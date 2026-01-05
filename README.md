# Modern Auth Portal

![Version](https://img.shields.io/badge/version-2.1.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-5.8%2B-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)
![License](https://img.shields.io/badge/license-GPL%20v2%2B-green.svg)

Complete WordPress authentication system with stunning modern UI - Login, Register, Profile Management, Password Reset & Change with enterprise-grade security.

## 🌟 Features

### Complete Authentication System
- **Login & Registration** - Beautiful forms with smooth animations
- **Profile Management** - Users can edit their profile and upload avatars
- **Password Management** - Change password and reset password functionality
- **User Approval System** - Optional admin approval for new registrations
- **Page Protection** - Restrict access to specific pages

### Modern UI/UX
- ✨ Stunning gradient designs with animated backgrounds
- 📱 Fully responsive (mobile, tablet, desktop)
- 🎨 Customizable colors and branding
- ⚡ AJAX-powered for smooth user experience
- 🎯 Clean, modern interface

### Security Features
- 🔒 Nonce verification on all forms
- 🛡️ SQL injection protection
- 🔐 XSS (Cross-Site Scripting) prevention
- 🚫 CSRF (Cross-Site Request Forgery) protection
- 🔑 Secure password hashing
- ⏱️ Rate limiting on login attempts
- ✅ Input sanitization and validation

### Developer Friendly
- 📝 Clean, well-documented code
- 🎣 WordPress coding standards compliant
- 🌍 Translation ready (i18n)
- 🔌 Hooks and filters for customization
- 📦 Modular architecture

## 📋 Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher
- MySQL 5.6 or higher

## 🚀 Installation

### Automatic Installation

1. Log in to your WordPress admin panel
2. Navigate to **Plugins > Add New**
3. Search for "Modern Auth Portal"
4. Click **Install Now** and then **Activate**

### Manual Installation

1. Download the plugin ZIP file from [GitHub](https://github.com/CodebyKami/modern-auth-portal)
2. Log in to your WordPress admin panel
3. Navigate to **Plugins > Add New > Upload Plugin**
4. Choose the downloaded ZIP file and click **Install Now**
5. Click **Activate Plugin**

### From GitHub

```bash
cd wp-content/plugins/
git clone https://github.com/CodebyKami/modern-auth-portal.git
```

Then activate the plugin from WordPress admin panel.

## ⚙️ Configuration

1. Go to **Auth Portal** in your WordPress admin menu
2. Configure your branding:
   - Upload your logo
   - Set brand name and tagline
   - Customize primary and secondary colors
3. Set up authentication options:
   - Enable/disable registration
   - Require admin approval
   - Set redirect URL after login
4. Configure security settings:
   - Max login attempts
   - Lockout duration
5. Select pages to protect (optional)

## 📝 Usage

### Available Shortcodes

#### 1. Login Form
```
[modern_auth_login]
```
Displays login and registration forms with beautiful UI.

#### 2. Profile Editor
```
[modern_auth_profile]
```
Allows logged-in users to edit their profile and upload avatar.

#### 3. Change Password
```
[modern_auth_change_password]
```
Lets users change their password securely.

#### 4. Reset Password
```
[modern_auth_reset_password]
```
Password reset form for forgotten passwords.

#### 5. Logout Button
```
[modern_auth_logout]
```
Displays a styled logout button.

#### 6. Welcome Message
```
[modern_auth_welcome]
```
Shows a welcome message for logged-in users.

#### 7. Login Status
```
[modern_auth_status]
```
Displays current login status badge.

### Basic Setup Example

1. Create a new page called "Login"
2. Add the shortcode: `[modern_auth_login]`
3. Create a page called "Profile"
4. Add the shortcode: `[modern_auth_profile]`
5. Create a page called "Change Password"
6. Add the shortcode: `[modern_auth_change_password]`

## 🎨 Customization

### Colors

You can customize colors from the admin panel:
- **Primary Color**: Main accent color (default: #D4FF00)
- **Secondary Color**: Background color (default: #000000)

### Branding

- Upload your custom logo
- Set your brand name
- Customize tagline

### Hooks & Filters

#### Actions

```php
// After successful login
add_action('map_after_login', function($user) {
    // Your code here
});

// After successful registration
add_action('map_after_registration', function($user, $approved) {
    // Your code here
}, 10, 2);

// After profile update
add_action('map_after_profile_update', function($user_id) {
    // Your code here
});

// After password change
add_action('map_after_password_change', function($user_id) {
    // Your code here
});
```

#### Filters

```php
// Customize redirect after login
add_filter('map_login_redirect', function($redirect_url, $user) {
    if (in_array('administrator', $user->roles)) {
        return admin_url();
    }
    return $redirect_url;
}, 10, 2);
```

## 🔒 Security

Modern Auth Portal implements multiple security layers:

- **Nonce Verification**: All forms use WordPress nonces
- **Input Sanitization**: All user inputs are sanitized
- **SQL Injection Protection**: Uses WordPress database API
- **XSS Prevention**: All outputs are escaped
- **Rate Limiting**: Prevents brute force attacks
- **Secure Password Storage**: Uses WordPress password hashing

## 🌍 Translation

The plugin is translation-ready. To translate:

1. Use a translation plugin like Loco Translate
2. Or create a `.po` file in `/languages/` directory
3. Text domain: `modern-auth-portal`

## 📸 Screenshots

1. Beautiful login and registration form with animated background
2. Admin settings panel with branding options
3. User profile edit page with avatar upload
4. Change password form with security validation
5. Password reset form
6. Admin dashboard showing user statistics
7. Mobile responsive design
8. Page protection settings

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This plugin is licensed under the GPL v2 or later.

```
Modern Auth Portal
Copyright (C) 2024 Kamran Rasool

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## 👨‍💻 Author

**Kamran Rasool**
- Email: kamranrasool0045@gmail.com
- Phone: +92 324 1657670
- GitHub: [@CodebyKami](https://github.com/CodebyKami)

## 📞 Support

For support, feature requests, or bug reports:

- **WordPress Support Forum**: [Plugin Support](https://wordpress.org/support/plugin/modern-auth-portal/)
- **GitHub Issues**: [Report Issue](https://github.com/CodebyKami/modern-auth-portal/issues)
- **Email**: kamranrasool0045@gmail.com

## 🎯 Roadmap

- [ ] Social login integration (Google, Facebook)
- [ ] Two-factor authentication (2FA)
- [ ] Email verification
- [ ] Custom registration fields
- [ ] User dashboard widget
- [ ] Activity log
- [ ] Export user data
- [ ] More customization options

## 📊 Changelog

### Version 2.1.0 (2024-01-05)
- ✨ Enhanced security with comprehensive input validation
- ✅ Added proper WordPress coding standards compliance
- 📱 Improved responsive design for all screen sizes
- 🌍 Added translation support (i18n)
- ⚡ Enhanced AJAX error handling
- 🔒 Added rate limiting for login attempts
- 🖼️ Improved avatar upload functionality
- 📦 Better code organization with separate class files
- 📢 Added admin notices for better user feedback
- 📝 Enhanced documentation and inline comments
- 🎨 Fixed minor CSS conflicts with themes
- ♿ Improved accessibility features
- 🔐 Added proper escaping for all outputs
- ✅ Enhanced nonce verification
- 💬 Better error messages for users

### Version 2.0.1
- 🎉 Initial public release
- ✨ Complete authentication system
- 🎯 7 powerful shortcodes
- 🎨 Custom branding options
- 🔒 Page protection feature
- ✅ User approval system
- 🌟 Modern animated UI

## ⭐ Show Your Support

If you find this plugin helpful, please:
- ⭐ Star this repository
- 🐛 Report bugs
- 💡 Suggest new features
- 📢 Share with others
- ✍️ Write a review on WordPress.org

## 🙏 Acknowledgments

- WordPress community for excellent documentation
- All contributors and testers
- Users who provide valuable feedback

---

Made with ❤️ by [Kamran Rasool](https://github.com/CodebyKami)
