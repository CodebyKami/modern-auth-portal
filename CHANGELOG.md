# Changelog

All notable changes to Modern Auth Portal will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.0] - 2024-01-05

### Added
- Comprehensive input validation and sanitization
- Rate limiting for login attempts to prevent brute force attacks
- Lockout system with configurable duration
- Translation support (i18n) with text domain
- Admin activation notice
- User approval field in user profile
- Security settings in admin panel (max attempts, lockout duration)
- Proper WordPress coding standards compliance
- Enhanced documentation and inline comments
- Hooks and filters for developers
- Email notifications for new registrations
- Welcome email for approved users

### Improved
- Responsive design for all screen sizes (mobile, tablet, desktop)
- AJAX error handling with better user feedback
- Avatar upload functionality with proper validation
- Code organization with separate class files
- Admin interface with better UX
- Form validation with clear error messages
- Security with multiple layers of protection
- Accessibility features
- CSS to prevent theme conflicts

### Fixed
- Minor CSS conflicts with some themes
- Avatar preview not updating immediately
- Form submission issues on some servers
- Nonce verification edge cases
- Email validation edge cases

### Security
- Added proper escaping for all outputs
- Enhanced nonce verification
- SQL injection protection using WordPress database API
- XSS prevention with proper sanitization
- CSRF protection on all forms
- Secure password storage using WordPress functions

## [2.0.1] - 2024-01-01

### Added
- Initial public release
- Complete authentication system
- Login and registration forms
- Profile edit functionality
- Change password feature
- Reset password feature
- 7 powerful shortcodes
- Custom branding options (logo, colors, brand name)
- Page protection feature
- User approval system
- Modern animated UI with gradient backgrounds
- AJAX-powered forms
- Admin settings panel
- Custom user role (Dashboard User)

### Features
- Beautiful modern UI with animations
- Fully responsive design
- Customizable colors
- Logo upload
- Brand name and tagline customization
- Redirect URL configuration
- Enable/disable registration
- Require admin approval option
- Page restriction functionality
- Avatar upload for users
- Bio field in profile

[2.1.0]: https://github.com/CodebyKami/modern-auth-portal/compare/v2.0.1...v2.1.0
[2.0.1]: https://github.com/CodebyKami/modern-auth-portal/releases/tag/v2.0.1
