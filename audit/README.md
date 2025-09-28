# Website Audit Pages - cPanel Setup

This directory contains the audit pages for Cyrus Wilburn's portfolio website.

## Files Included

### Core Pages
- `index.php` - Main audit landing page with hero section and quiz button
- `audit-form.php` - Detailed audit request form
- `quiz.php` - Step-by-step website readiness quiz

### Configuration Files
- `.htaccess` - Apache configuration for security and performance
- `php.ini` - PHP settings for proper form handling and email
- `robots.txt` - Search engine optimization settings
- `README.md` - This documentation file

## cPanel Setup Instructions

### 1. Upload Files
1. Upload all files to your cPanel public_html/audit/ directory
2. Ensure file permissions are set correctly (644 for files, 755 for directories)

### 2. Email Configuration
- The forms are configured to send emails to `leads@cyruswilburn.dev`
- Ensure your cPanel email is properly configured
- Test email functionality after setup

### 3. PHP Settings
- The included `php.ini` file will configure PHP settings
- If you need to modify settings, edit the `php.ini` file
- Restart Apache if needed

### 4. Security
- The `.htaccess` file includes security headers and file protection
- Sensitive files are protected from direct access
- Error pages redirect to the main audit page

### 5. Testing
1. Visit `yourdomain.com/audit/` to test the main page
2. Test the audit form at `yourdomain.com/audit/audit-form.php`
3. Test the quiz at `yourdomain.com/audit/quiz.php`
4. Submit test forms to verify email delivery

## Features

### Main Audit Page (`index.php`)
- Hero section with call-to-action
- Feature highlights
- Statistics display
- Quiz button

### Audit Form (`audit-form.php`)
- Comprehensive form with sections:
  - Basic Information
  - Website Goals
  - Additional Questions
- Email validation and URL processing
- Professional styling with icons

### Quiz (`quiz.php`)
- 5-question step-by-step quiz
- Progress tracking
- Contact information collection
- Email submission to leads@cyruswilburn.dev

## Email Integration
All forms send emails to `leads@cyruswilburn.dev` with:
- Contact information
- Website details
- Quiz answers (if applicable)
- Timestamp and IP address

## Support
For technical support or modifications, contact Cyrus Wilburn.
