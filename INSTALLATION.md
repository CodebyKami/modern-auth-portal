# Installation Guide - Modern Auth Portal

This guide will walk you through the complete installation and setup process for Modern Auth Portal.

## Table of Contents

1. [Requirements](#requirements)
2. [Installation Methods](#installation-methods)
3. [Initial Configuration](#initial-configuration)
4. [Creating Pages](#creating-pages)
5. [Testing](#testing)
6. [Troubleshooting](#troubleshooting)

## Requirements

Before installing Modern Auth Portal, ensure your server meets these requirements:

- **WordPress**: 5.8 or higher
- **PHP**: 7.4 or higher
- **MySQL**: 5.6 or higher
- **HTTPS**: Recommended for security

## Installation Methods

### Method 1: WordPress Plugin Directory (Recommended)

1. Log in to your WordPress admin dashboard
2. Navigate to **Plugins → Add New**
3. Search for "Modern Auth Portal"
4. Click **Install Now**
5. Click **Activate**

### Method 2: Manual Upload

1. Download the plugin ZIP file
2. Log in to your WordPress admin dashboard
3. Navigate to **Plugins → Add New → Upload Plugin**
4. Click **Choose File** and select the downloaded ZIP
5. Click **Install Now**
6. Click **Activate Plugin**

### Method 3: FTP Upload

1. Download and extract the plugin ZIP file
2. Connect to your server via FTP
3. Upload the `modern-auth-portal` folder to `/wp-content/plugins/`
4. Log in to WordPress admin
5. Navigate to **Plugins**
6. Find "Modern Auth Portal" and click **Activate**

### Method 4: From GitHub

```bash
cd /path/to/wordpress/wp-content/plugins/
git clone https://github.com/CodebyKami/modern-auth-portal.git
```

Then activate from WordPress admin panel.

## Initial Configuration

### Step 1: Access Settings

After activation, you'll see a welcome notice. Click on **Auth Portal Settings** or navigate to **Auth Portal** in the admin menu.

### Step 2: Configure Branding

1. **Upload Logo** (optional)
   - Click "Choose File" under Logo
   - Select your logo image (recommended: 200x200px)
   - Supported formats: JPG, PNG, GIF

2. **Set Brand Name**
   - Enter your site or company name
   - This appears as the main title on auth pages
   - Default: "Welcome"

3. **Set Tagline**
   - Enter a subtitle or welcome message
   - Default: "Sign in to continue your session"

4. **Customize Colors**
   - **Primary Color**: Main accent color (default: #D4FF00)
   - **Secondary Color**: Background color (default: #000000)
   - Click the color picker to choose your colors
   - Click "Reset Colors to Default" to restore defaults

### Step 3: Authentication Settings

1. **Enable Registration**
   - Check to allow new user signups
   - Uncheck to disable registration

2. **Require Approval**
   - Check to require admin approval for new users
   - Unchecked: Users can login immediately after registration
   - Checked: Admin must approve before user can login

3. **Redirect After Login**
   - Enter the URL where users should go after login
   - Default: Your homepage
   - Example: `https://yoursite.com/dashboard`

### Step 4: Security Settings

1. **Max Login Attempts**
   - Set maximum failed login attempts (3-10)
   - Default: 5 attempts
   - After max attempts, user is locked out

2. **Lockout Duration**
   - Set lockout duration in minutes (5-60)
   - Default: 15 minutes
   - User must wait this long after being locked out

### Step 5: Page Protection (Optional)

1. Select pages that should only be accessible to logged-in users
2. Hold Ctrl/Cmd to select multiple pages
3. Non-logged-in users will see the login form instead

### Step 6: Save Settings

Click **Save All Settings** at the bottom of the page.

## Creating Pages

### Create Login Page

1. Go to **Pages → Add New**
2. Title: "Login" (or your preferred title)
3. In the content editor, add: `[modern_auth_login]`
4. Click **Publish**
5. Note the page URL for later use

### Create Profile Page

1. Go to **Pages → Add New**
2. Title: "My Profile"
3. Add shortcode: `[modern_auth_profile]`
4. Click **Publish**

### Create Change Password Page

1. Go to **Pages → Add New**
2. Title: "Change Password"
3. Add shortcode: `[modern_auth_change_password]`
4. Click **Publish**

### Create Password Reset Page (Optional)

1. Go to **Pages → Add New**
2. Title: "Reset Password"
3. Add shortcode: `[modern_auth_reset_password]`
4. Click **Publish**

### Add Navigation Menu Items

1. Go to **Appearance → Menus**
2. Add your newly created pages to the menu
3. For logged-in users, add:
   - Profile page
   - Change Password page
   - Logout link (use shortcode in a custom link)

## Testing

### Test Registration (if enabled)

1. Open your login page in an incognito/private browser window
2. Click "Create one" to access registration form
3. Fill in all fields:
   - Full Name
   - Username (min 3 characters)
   - Email
   - Password (min 8 characters)
4. Click "CREATE ACCOUNT"
5. Verify success message appears

### Test Login

1. Use the credentials you just created
2. Enter username or email
3. Enter password
4. Optionally check "Remember me"
5. Click "SIGN IN"
6. Verify redirect to configured URL

### Test Profile Edit

1. While logged in, visit your Profile page
2. Try uploading an avatar
3. Update your name, email, or bio
4. Click "UPDATE PROFILE"
5. Verify success message

### Test Password Change

1. Visit Change Password page
2. Enter current password
3. Enter new password (min 8 characters)
4. Confirm new password
5. Click "CHANGE PASSWORD"
6. Verify you remain logged in

### Test Password Reset

1. Log out
2. Visit Reset Password page
3. Enter your email address
4. Click "SEND RESET LINK"
5. Check your email for reset link

### Test User Approval (if enabled)

1. Register a new user
2. As admin, go to **Users**
3. Edit the new user
4. Scroll to "Portal Access"
5. Check "Approve portal access"
6. Click "Update User"
7. User can now login

## Troubleshooting

### Plugin Won't Activate

**Problem**: Error message during activation

**Solutions**:
- Check PHP version (must be 7.4+)
- Check WordPress version (must be 5.8+)
- Deactivate conflicting plugins
- Check error logs

### Forms Not Submitting

**Problem**: Nothing happens when clicking submit

**Solutions**:
- Check browser console for JavaScript errors
- Disable other plugins temporarily
- Try a different theme
- Clear browser cache
- Check if AJAX is working

### Styles Look Broken

**Problem**: Forms don't look right

**Solutions**:
- Clear browser cache
- Check for theme CSS conflicts
- Try adding `!important` to custom CSS
- Contact support with theme name

### Email Not Sending

**Problem**: Password reset emails not received

**Solutions**:
- Install WP Mail SMTP plugin
- Configure SMTP settings
- Check spam folder
- Verify server can send emails
- Test with different email address

### Login Attempts Lockout

**Problem**: Locked out after failed attempts

**Solutions**:
- Wait for lockout duration to expire
- Or, as admin, go to database
- Delete transients: `map_locked_out_*` and `map_login_attempts_*`

### Avatar Upload Fails

**Problem**: Can't upload profile picture

**Solutions**:
- Check file size (max 2MB recommended)
- Check file format (JPG, PNG, GIF)
- Verify upload directory permissions
- Check PHP upload_max_filesize setting

### Page Protection Not Working

**Problem**: Non-logged-in users can still access protected pages

**Solutions**:
- Verify pages are selected in settings
- Clear cache (if using caching plugin)
- Check if page is actually published
- Try different page

## Getting Help

If you're still having issues:

1. **Check Documentation**: Review README.md
2. **Search Issues**: Check [GitHub Issues](https://github.com/CodebyKami/modern-auth-portal/issues)
3. **WordPress Forum**: Post in [support forum](https://wordpress.org/support/plugin/modern-auth-portal/)
4. **Contact Developer**: Email kamranrasool0045@gmail.com

## Next Steps

After successful installation:

1. Customize colors to match your brand
2. Add pages to your navigation menu
3. Test all functionality
4. Configure email settings (if needed)
5. Set up user approval workflow (if needed)
6. Add custom CSS for further customization

## Security Recommendations

1. Always use HTTPS
2. Keep WordPress and plugins updated
3. Use strong passwords
4. Enable two-factor authentication (separate plugin)
5. Regular backups
6. Monitor user registrations
7. Review login attempts regularly

## Performance Tips

1. Use a caching plugin (but exclude auth pages)
2. Optimize images before uploading
3. Use a CDN for static assets
4. Keep database optimized
5. Limit login attempts appropriately

---

**Need more help?** Contact: kamranrasool0045@gmail.com
