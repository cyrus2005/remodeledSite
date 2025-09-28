# Cyrus Wilburn Portfolio Website - cPanel Setup

Complete portfolio website with audit functionality for Cyrus Wilburn.

## 🚀 Site Structure

### Main Portfolio Site
- `index.php` - Main portfolio homepage with hero, about, services, portfolio, contact sections
- `assets/css/styles.css` - Global styles and responsive design
- `assets/js/script.js` - Interactive functionality and animations
- `assets/images/` - Portfolio images and graphics

### Audit Pages (`/audit/`)
- `index.php` - Audit landing page with hero and quiz button
- `audit-form.php` - Detailed audit request form
- `quiz.php` - Step-by-step website readiness quiz

## 📁 Configuration Files

### Root Directory Files
- `.htaccess` - Apache configuration for security and performance
- `php.ini` - PHP settings for form handling and email
- `robots.txt` - Search engine optimization
- `sitemap.xml` - XML sitemap for search engines
- `README.md` - This documentation

### Audit Directory Files
- `audit/.htaccess` - Audit-specific Apache configuration
- `audit/php.ini` - Audit-specific PHP settings
- `audit/robots.txt` - Audit-specific SEO settings
- `audit/README.md` - Audit setup documentation

## 🛠️ cPanel Setup Instructions

### 1. File Upload
1. Upload all files to your cPanel `public_html/` directory
2. Maintain the folder structure:
   ```
   public_html/
   ├── index.php
   ├── .htaccess
   ├── php.ini
   ├── robots.txt
   ├── sitemap.xml
   ├── assets/
   │   ├── css/
   │   ├── js/
   │   └── images/
   └── audit/
       ├── index.php
       ├── audit-form.php
       ├── quiz.php
       ├── .htaccess
       ├── php.ini
       └── robots.txt
   ```

### 2. File Permissions
Set the following permissions:
- **Files**: 644 (rw-r--r--)
- **Directories**: 755 (rwxr-xr-x)
- **PHP files**: 644
- **Images**: 644

### 3. Email Configuration
- All forms send emails to `leads@cyruswilburn.dev`
- Ensure your cPanel email is properly configured
- Test email functionality after setup

### 4. Domain Configuration
Update the following files with your actual domain:
- `robots.txt` - Update sitemap URL
- `sitemap.xml` - Update all URLs
- `audit/robots.txt` - Update sitemap URL

### 5. SSL Certificate (Recommended)
1. Enable SSL in cPanel
2. Uncomment HTTPS redirect lines in `.htaccess`
3. Update `session.cookie_secure = 1` in `php.ini`

## 🎨 Features

### Main Portfolio Site
- **Responsive Design** - Mobile-first approach
- **Interactive Elements** - Smooth scrolling, animations, hover effects
- **Contact Form** - PHP-powered with email validation
- **Portfolio Gallery** - Filterable project showcase
- **SEO Optimized** - Meta tags, structured data, sitemap

### Audit Pages
- **Hero Landing** - Compelling call-to-action
- **Detailed Form** - Comprehensive audit request with sections:
  - Basic Information
  - Website Goals  
  - Additional Questions
- **Interactive Quiz** - 5-question step-by-step process
- **Email Integration** - All submissions sent to leads@cyruswilburn.dev

## 📧 Email Integration

### Contact Form (Main Site)
- Sends to: `leads@cyruswilburn.dev`
- Includes: Name, email, message, timestamp, IP

### Audit Form
- Sends to: `leads@cyruswilburn.dev`
- Includes: All form fields, website details, goals, problems, improvements, budget

### Quiz Form
- Sends to: `leads@cyruswilburn.dev`
- Includes: Contact info, all quiz answers, readiness score

## 🔒 Security Features

### Apache Security (.htaccess)
- **Security Headers** - XSS protection, content type options
- **File Protection** - Blocks access to sensitive files
- **Bot Protection** - Blocks malicious user agents
- **Directory Protection** - Prevents directory browsing

### PHP Security (php.ini)
- **Error Handling** - Disabled display, enabled logging
- **Function Restrictions** - Disabled dangerous functions
- **Session Security** - HTTP-only cookies, strict mode
- **Input Validation** - Enhanced input limits

## 🚀 Performance Optimization

### Caching
- **Static Assets** - 1-month cache for CSS, JS, images
- **Compression** - Gzip compression for text files
- **OPcache** - PHP bytecode caching enabled

### File Optimization
- **Image Optimization** - WebP support, proper sizing
- **CSS/JS Minification** - Compressed assets
- **CDN Ready** - External font and icon loading

## 🧪 Testing Checklist

### Functionality Tests
- [ ] Main site loads correctly
- [ ] All navigation links work
- [ ] Contact form submits successfully
- [ ] Audit pages load correctly
- [ ] Audit form submits successfully
- [ ] Quiz works step-by-step
- [ ] All emails are received at leads@cyruswilburn.dev

### Security Tests
- [ ] Sensitive files are protected
- [ ] Error pages redirect correctly
- [ ] HTTPS redirect works (if enabled)
- [ ] Bot protection is active

### Performance Tests
- [ ] Site loads quickly
- [ ] Images are optimized
- [ ] CSS/JS files are cached
- [ ] Mobile responsiveness works

## 📞 Support

For technical support or modifications:
- **Email**: leads@cyruswilburn.dev
- **Website**: cyruswilburn.dev

## 📝 Changelog

### Version 1.0 (January 2024)
- Initial portfolio website
- Audit functionality
- cPanel configuration files
- Security and performance optimization
