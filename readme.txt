=== Modern Auth Portal ===
Contributors: kamranrasool
Donate link: https://github.com/CodebyKami/modern-auth-portal
Tags: login, registration, authentication, user management, security, custom login, user profile
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 2.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Complete authentication system with stunning modern UI - Login, Register, Profile Management, Password Reset & Change with enterprise-grade security.

== Description ==

**Modern Auth Portal** is a comprehensive WordPress authentication plugin that provides a complete user management system with a beautiful, modern interface. Perfect for membership sites, client portals, and any WordPress site requiring custom authentication.

= Key Features =

* **Beautiful Modern UI** - Stunning gradient designs with animated backgrounds
* **Complete Authentication System** - Login, Registration, Profile Editing, Password Management
* **7 Powerful Shortcodes** - Easy integration anywhere on your site
* **Page Protection** - Restrict access to specific pages for logged-in users only
* **User Approval System** - Optional admin approval for new registrations
* **Custom Branding** - Upload your logo, customize colors, brand name, and tagline
* **Avatar Management** - Users can upload custom profile pictures
* **Fully Responsive** - Perfect on desktop, tablet, and mobile devices
* **Enterprise Security** - Nonce verification, SQL injection protection, XSS prevention
* **AJAX-Powered** - Smooth user experience without page reloads
* **Translation Ready** - Fully internationalized and ready for translation
* **Developer Friendly** - Clean, well-documented code following WordPress standards

= Available Shortcodes =

1. `[modern_auth_login]` - Login and registration form
2. `[modern_auth_profile]` - Edit profile page
3. `[modern_auth_change_password]` - Change password form
4. `[modern_auth_reset_password]` - Password reset form
5. `[modern_auth_logout]` - Logout button
6. `[modern_auth_welcome]` - Welcome message for logged-in users
7. `[modern_auth_status]` - Display login status badge

= Perfect For =

* Membership websites
* Client portals
* Online communities
* Educational platforms
* Business directories
* Any site requiring custom authentication

= Security Features =

* Nonce verification on all forms
* SQL injection protection
* XSS (Cross-Site Scripting) prevention
* CSRF (Cross-Site Request Forgery) protection
* Secure password hashing
* Rate limiting on login attempts
* Sanitized and validated user inputs

= Customization Options =

* Custom logo upload
* Brand name and tagline
* Primary and secondary color customization
* Redirect URL after login
* Enable/disable registration
* Require admin approval for new users
* Select pages to protect

== Installation ==

= Automatic Installation =

1. Log in to your WordPress admin panel
2. Navigate to Plugins > Add New
3. Search for "Modern Auth Portal"
4. Click "Install Now" and then "Activate"

= Manual Installation =

1. Download the plugin ZIP file
2. Log in to your WordPress admin panel
3. Navigate to Plugins > Add New > Upload Plugin
4. Choose the downloaded ZIP file and click "Install Now"
5. Activate the plugin

= Configuration =

1. Go to **Auth Portal** in your WordPress admin menu
2. Configure your branding (logo, colors, brand name)
3. Set up authentication options (registration, approval, redirect)
4. Select pages to protect (optional)
5. Create pages and add shortcodes where needed

= Basic Setup Example =

1. Create a new page called "Login"
2. Add the shortcode: `[modern_auth_login]`
3. Create a page called "Profile"
4. Add the shortcode: `[modern_auth_profile]`
5. Create a page called "Change Password"
6. Add the shortcode: `[modern_auth_change_password]`

== Frequently Asked Questions ==

= How do I add a login form to my site? =

Simply create a new page and add the shortcode `[modern_auth_login]`. This will display both login and registration forms.

= Can I customize the colors? =

Yes! Go to Auth Portal settings in your WordPress admin and use the color pickers to customize primary and secondary colors.

= How do I protect specific pages? =

In the Auth Portal settings, scroll to "Protected Pages" and select which pages should only be accessible to logged-in users.

= Can I disable registration? =

Yes, in the Auth Portal settings, uncheck "Enable Registration" to disable new user signups.

= How does the approval system work? =

When "Require Approval" is enabled, new registrations will be pending until an admin approves them. Admins can approve users by editing their profile in WordPress Users section.

= Can users upload profile pictures? =

Yes! The profile edit page includes avatar upload functionality. Users can upload custom profile pictures.

= Is this plugin translation ready? =

Yes! The plugin is fully internationalized and ready for translation into any language.

= Where can I get support? =

For support, please visit the [plugin support forum](https://wordpress.org/support/plugin/modern-auth-portal/) or [GitHub repository](https://github.com/CodebyKami/modern-auth-portal).

= Can I use this on multiple sites? =

Yes! This plugin is licensed under GPL v2, so you can use it on as many sites as you want.

== Screenshots ==

1. Beautiful login and registration form with animated background
2. Admin settings panel with branding options
3. User profile edit page with avatar upload
4. Change password form with security validation
5. Password reset form
6. Admin dashboard showing user statistics
7. Mobile responsive design
8. Page protection settings

== Changelog ==

= 2.1.0 - 2024-01-05 =
* Enhanced security with comprehensive input validation
* Added proper WordPress coding standards compliance
* Improved responsive design for all screen sizes
* Added translation support (i18n)
* Enhanced AJAX error handling
* Added rate limiting for login attempts
* Improved avatar upload functionality
* Better code organization with separate class files
* Added admin notices for better user feedback
* Enhanced documentation and inline comments
* Fixed minor CSS conflicts with themes
* Improved accessibility features
* Added proper escaping for all outputs
* Enhanced nonce verification
* Better error messages for users

= 2.0.1 =
* Initial public release
* Complete authentication system
* 7 powerful shortcodes
* Custom branding options
* Page protection feature
* User approval system
* Modern animated UI

== Upgrade Notice ==

= 2.1.0 =
Major security and stability update. Enhanced WordPress standards compliance, improved responsive design, and better internationalization support. Recommended for all users.

= 2.0.1 =
Initial release of Modern Auth Portal with complete authentication features.

== Developer Notes ==

= Hooks & Filters =

The plugin provides several hooks for developers:

**Actions:**
* `map_after_login` - Fires after successful login
* `map_after_registration` - Fires after successful registration
* `map_after_profile_update` - Fires after profile update
* `map_after_password_change` - Fires after password change

**Filters:**
* `map_login_redirect` - Filter the redirect URL after login
* `map_registration_fields` - Filter registration form fields
* `map_profile_fields` - Filter profile form fields

= Code Example =

```php
// Customize redirect after login
add_filter('map_login_redirect', function($redirect_url, $user) {
    if (in_array('administrator', $user->roles)) {
        return admin_url();
    }
    return $redirect_url;
}, 10, 2);
```

= Contributing =

Contributions are welcome! Please visit our [GitHub repository](https://github.com/CodebyKami/modern-auth-portal) to contribute.

== Privacy Policy ==

Modern Auth Portal does not collect, store, or share any user data outside of your WordPress installation. All user data is stored in your WordPress database and follows WordPress privacy standards.

== Credits ==

* Developed by Kamran Rasool
* Email: kamranrasool0045@gmail.com
* Phone: +92 324 1657670

== Support ==

For support, feature requests, or bug reports:
* WordPress Support Forum: https://wordpress.org/support/plugin/modern-auth-portal/
* GitHub Issues: https://github.com/CodebyKami/modern-auth-portal/issues
* Email: kamranrasool0045@gmail.com
