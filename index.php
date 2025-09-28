<?php
// Contact form handling
$message = '';
$error = '';

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company = trim($_POST['company'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $budget = trim($_POST['budget'] ?? '');
    $timeline = trim($_POST['timeline'] ?? '');
    $message_text = trim($_POST['message']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message_text)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Email configuration
        $to = 'leads@cyruswilburn.dev';
        $subject = 'New Lead from Portfolio Website - ' . $name;
        
        $body = "New lead submission from your portfolio website:\n\n";
        $body .= "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Phone: " . ($phone ? $phone : 'Not provided') . "\n";
        $body .= "Company: " . ($company ? $company : 'Not provided') . "\n";
        $body .= "Budget: " . ($budget ? $budget : 'Not specified') . "\n";
        $body .= "Timeline: " . ($timeline ? $timeline : 'Not specified') . "\n";
        $body .= "Message:\n" . $message_text . "\n\n";
        $body .= "Submitted on: " . date('Y-m-d H:i:s') . "\n";
        $body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
        
        $headers = "From: noreply@cyruswilburn.dev\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $body, $headers)) {
            $message = 'Thank you for your message! I\'ll get back to you within 24 hours.';
            
            // Clear form data
            $_POST = array();
        } else {
            $error = 'Sorry, there was an error sending your message. Please try again or contact me directly at leads@cyruswilburn.dev';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyrus Wilburn - Web Developer & Digital Solutions Expert</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fontawesome/all.css">
    <link rel="stylesheet" href="assets/css/local-fonts.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2>Cyrus Wilburn</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="nav-cta">
                <a href="#contact" class="btn btn-primary">Get Started</a>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background">
            <img src="assets/images/backgroundimagehero.jpg" alt="Background" class="hero-bg-image">
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Building Websites That <span class="highlight">Drive Results</span></h1>
                    <p class="hero-subtitle">I'm Cyrus Wilburn, a web developer who creates high-converting websites that turn visitors into customers. Let's transform your digital presence.</p>
                    <div class="hero-cta">
                        <a href="#portfolio" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                            View My Work
                        </a>
                        <a href="#contact" class="btn btn-secondary">
                            <i class="fas fa-folder"></i>
                            Start Your Project
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <h3>150+</h3>
                    <p>Projects Completed</p>
                </div>
                <div class="stat">
                    <h3>98%</h3>
                    <p>Client Satisfaction</p>
                </div>
                <div class="stat">
                    <h3>5+</h3>
                    <p>Years Experience</p>
                </div>
                <div class="stat">
                    <h3>24/7</h3>
                    <p>Support Available</p>
                </div>
            </div>
                <div class="scroll-indicator" onclick="document.querySelector('#about').scrollIntoView({behavior: 'smooth'})">
                    <i class="fas fa-chevron-down"></i>
                </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Hi, I'm <span class="highlight">Cyrus</span></h2>
                    <p class="about-intro">With over 5 years of experience in web development, I specialize in creating websites that don't just look great – they convert visitors into customers and drive real business results.</p>
                    <p>I combine cutting-edge technology with proven conversion strategies to build websites that work as hard as you do. Every project is crafted with precision, optimized for performance, and designed to achieve your business goals.</p>
                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Clean Code</h4>
                                <p>Maintainable & Scalable</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Fast Delivery</h4>
                                <p>On Time, Every Time</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Quality Assured</h4>
                                <p>Tested & Optimized</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-content">
                                <h4>24/7 Support</h4>
                                <p>Always Here to Help</p>
                            </div>
                        </div>
                    </div>
                    <div class="about-cta">
                        <a href="#contact" class="btn btn-primary">
                            <i class="fas fa-comments"></i>
                            Let's Work Together
                        </a>
                    </div>
                </div>
                <div class="about-image">
                    <img src="assets/images/personalImage.png" alt="Cyrus Wilburn" class="profile-image">
                    <div class="experience-badge">
                        <span class="years">5+</span>
                        <span class="text">Years of Excellence</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="services-header">
                <h2>Services That Drive <span class="highlight">Growth</span></h2>
                <p class="section-subtitle">From concept to launch and beyond, I provide comprehensive web development services designed to help your business thrive online.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3>Custom Web Development</h3>
                    <p>Tailored websites built from scratch to match your unique business needs and brand identity.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Responsive Design</li>
                        <li><i class="fas fa-check"></i> SEO Optimized</li>
                        <li><i class="fas fa-check"></i> Fast Loading</li>
                        <li><i class="fas fa-check"></i> Mobile First</li>
                    </ul>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3>E-commerce Solutions</h3>
                    <p>Complete online stores that convert browsers into buyers with seamless checkout experiences.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Payment Integration</li>
                        <li><i class="fas fa-check"></i> Inventory Management</li>
                        <li><i class="fas fa-check"></i> Analytics</li>
                        <li><i class="fas fa-check"></i> Security</li>
                    </ul>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Conversion Optimization</h3>
                    <p>Data-driven improvements to increase your website's conversion rates and ROI.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> A/B Testing</li>
                        <li><i class="fas fa-check"></i> User Analytics</li>
                        <li><i class="fas fa-check"></i> Performance Audit</li>
                        <li><i class="fas fa-check"></i> CRO Strategy</li>
                    </ul>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile Optimization</h3>
                    <p>Ensure your website looks and performs perfectly on all devices and screen sizes.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Mobile Responsive</li>
                        <li><i class="fas fa-check"></i> Touch Friendly</li>
                        <li><i class="fas fa-check"></i> Fast Loading</li>
                        <li><i class="fas fa-check"></i> App-like Feel</li>
                    </ul>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>SEO Optimization</h3>
                    <p>Get found on Google with websites optimized for search engines from day one.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Technical SEO</li>
                        <li><i class="fas fa-check"></i> Content Strategy</li>
                        <li><i class="fas fa-check"></i> Local SEO</li>
                        <li><i class="fas fa-check"></i> Performance</li>
                    </ul>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Maintenance & Support</h3>
                    <p>Keep your website running smoothly with ongoing maintenance and technical support.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Regular Updates</li>
                        <li><i class="fas fa-check"></i> Security Monitoring</li>
                        <li><i class="fas fa-check"></i> Backup Service</li>
                        <li><i class="fas fa-check"></i> 24/7 Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Transform Your Online Presence?</h2>
                <p>Let's discuss your project and create a website that drives real results for your business.</p>
                <div class="cta-buttons">
                    <a href="#contact" class="btn btn-secondary">
                        <i class="fas fa-calendar"></i>
                        Schedule a Call
                    </a>
                    <a href="#portfolio" class="btn btn-secondary">
                        <i class="fas fa-folder"></i>
                        View Portfolio
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <h2>Sites I Can <span class="highlight">Build For You</span></h2>
            <p class="section-subtitle">Here are examples of the type of websites I can create for your business. Each one is custom-built with clean code and optimized for performance.</p>
            
            <div class="portfolio-filters">
                <button class="filter-btn active" data-filter="all">All Projects</button>
                <button class="filter-btn" data-filter="business">Business</button>
                <button class="filter-btn" data-filter="ecommerce">E-commerce</button>
                <button class="filter-btn" data-filter="nonprofit">Nonprofit</button>
            </div>

            <div class="portfolio-grid">
                <div class="portfolio-item" data-category="nonprofit">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="assets/images/ambassadorsEX.PNG" alt="Ambassadors Motorcycle Ministry">
                        </div>
                        <div class="portfolio-content">
                            <h3>Ambassadors Motorcycle Ministry</h3>
                            <p>Christian motorcycle ministry website with event management and community features</p>
                            <div class="portfolio-tech">
                                <span class="tech-tag">WordPress</span>
                                <span class="tech-tag">PHP</span>
                                <span class="tech-tag">MySQL</span>
                            </div>
                            <a href="#" class="portfolio-link">View Live Site <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                </div>
                <div class="portfolio-item" data-category="business">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="assets/images/trevorssite.PNG" alt="Trevor's Real Estate">
                        </div>
                        <div class="portfolio-content">
                            <h3>Trevor's Real Estate</h3>
                            <p>Professional real estate agent website with property listings and lead generation</p>
                            <div class="portfolio-tech">
                                <span class="tech-tag">React</span>
                                <span class="tech-tag">Node.js</span>
                                <span class="tech-tag">MongoDB</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-item" data-category="business">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="assets/images/nexussite.PNG" alt="Nexus Tech Agency">
                        </div>
                        <div class="portfolio-content">
                            <h3>Nexus Tech Agency</h3>
                            <p>Startup tech agency website with modern design and service showcase</p>
                            <div class="portfolio-tech">
                                <span class="tech-tag">Next.js</span>
                                <span class="tech-tag">Tailwind CSS</span>
                                <span class="tech-tag">TypeScript</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-item" data-category="business">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="assets/images/DDD site example.PNG" alt="DDD Detailing Business">
                        </div>
                        <div class="portfolio-content">
                            <h3>DDD Detailing Business</h3>
                            <p>Auto detailing business website with service booking and gallery</p>
                            <div class="portfolio-tech">
                                <span class="tech-tag">HTML5</span>
                                <span class="tech-tag">CSS3</span>
                                <span class="tech-tag">JavaScript</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-item" data-category="ecommerce">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="assets/images/Chronos Site Example.PNG" alt="Chronos Watch Company">
                        </div>
                        <div class="portfolio-content">
                            <h3>Chronos Watch Company</h3>
                            <p>International watch company e-commerce site with luxury product showcase</p>
                            <div class="portfolio-tech">
                                <span class="tech-tag">Vue.js</span>
                                <span class="tech-tag">PHP</span>
                                <span class="tech-tag">Stripe API</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info-card">
                    <h2>Get In Touch</h2>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <span class="contact-label">Email</span>
                                <span class="contact-value">c.wilburn@cyruswilburn.dev</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-text">
                                <span class="contact-label">Phone</span>
                                <span class="contact-value">270 801 9780</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <span class="contact-label">Location</span>
                                <span class="contact-value">Houston, Texas</span>
                            </div>
                        </div>
                    </div>

                    <div class="separator"></div>

                    <div class="benefits-section">
                        <h3>Why Choose Me?</h3>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check"></i> Fast response within 24 hours</li>
                            <li><i class="fas fa-check"></i> Free consultation & project estimate</li>
                            <li><i class="fas fa-check"></i> 100% satisfaction guarantee</li>
                            <li><i class="fas fa-check"></i> Secure & encrypted communication</li>
                            <li><i class="fas fa-check"></i> Licensed & insured professional</li>
                        </ul>
                    </div>

                    <div class="separator"></div>

                    <div class="trust-signals">
                        <div class="trust-item ssl">
                            <i class="fas fa-shield-alt"></i>
                            <span>SSL Secured</span>
                        </div>
                        <div class="trust-item data">
                            <i class="fas fa-lock"></i>
                            <span>Data Protected</span>
                        </div>
                        <div class="trust-item est">
                            <i class="fas fa-calendar"></i>
                            <span>Est. 2020</span>
                        </div>
                        <div class="trust-item rating">
                            <i class="fas fa-star"></i>
                            <span>5.0 Rating</span>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container">
                    <h2>Start Your Project</h2>
                    <p>Ready to transform your online presence? Let's discuss your project and bring your vision to life.</p>
                    
                    <?php if ($message): ?>
                        <div class="success-message">
                            <i class="fas fa-check-circle"></i>
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="POST" action="">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" required placeholder="John Doe" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required placeholder="john@company.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="company">Company Name</label>
                            <input type="text" id="company" name="company" placeholder="Your Company" value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="(555) 123-4567" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="budget">Project Budget</label>
                                <select id="budget" name="budget">
                                    <option value="">Select budget range</option>
                                    <option value="under-5k" <?php echo (isset($_POST['budget']) && $_POST['budget'] == 'under-5k') ? 'selected' : ''; ?>>Under $5,000</option>
                                    <option value="5k-10k" <?php echo (isset($_POST['budget']) && $_POST['budget'] == '5k-10k') ? 'selected' : ''; ?>>$5,000 - $10,000</option>
                                    <option value="10k-25k" <?php echo (isset($_POST['budget']) && $_POST['budget'] == '10k-25k') ? 'selected' : ''; ?>>$10,000 - $25,000</option>
                                    <option value="25k-plus" <?php echo (isset($_POST['budget']) && $_POST['budget'] == '25k-plus') ? 'selected' : ''; ?>>$25,000+</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="timeline">Timeline</label>
                                <select id="timeline" name="timeline">
                                    <option value="">Select timeline</option>
                                    <option value="asap" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == 'asap') ? 'selected' : ''; ?>>ASAP</option>
                                    <option value="1-month" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == '1-month') ? 'selected' : ''; ?>>Within 1 Month</option>
                                    <option value="2-3-months" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == '2-3-months') ? 'selected' : ''; ?>>2-3 Months</option>
                                    <option value="flexible" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == 'flexible') ? 'selected' : ''; ?>>Flexible</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Project Details *</label>
                            <textarea id="message" name="message" rows="4" required placeholder="Tell me about your project, goals, and any specific requirements..." maxlength="500"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            <div class="form-helper">Share your vision and requirements</div>
                            <div class="char-counter">0/500 characters</div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Signals Section -->
    <section class="trust-signals-section">
        <div class="container">
            <div class="trust-header">
                <h2>Trusted by Businesses Nationwide</h2>
                <p>Professional web development with verified credentials</p>
            </div>
            <div class="trust-cards">
                <div class="trust-card">
                    <div class="trust-icon ssl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="trust-content">
                        <h4>SSL Secured</h4>
                        <p>256-bit Encryption</p>
                    </div>
                </div>
                <div class="trust-card">
                    <div class="trust-icon support">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="trust-content">
                        <h4>24/7 Support</h4>
                        <p>Always Available</p>
                    </div>
                </div>
                <div class="trust-card">
                    <div class="trust-icon certified">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="trust-content">
                        <h4>Certified Pro</h4>
                        <p>Industry Verified</p>
                    </div>
                </div>
                <div class="trust-card">
                    <div class="trust-icon money">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="trust-content">
                        <h4>Money Back</h4>
                        <p>Satisfaction Guarantee</p>
                    </div>
                </div>
                <div class="trust-card">
                    <div class="trust-icon est">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="trust-content">
                        <h4>Est. 2020</h4>
                        <p>4+ Years Experience</p>
                    </div>
                </div>
                <div class="trust-card">
                    <div class="trust-icon rating">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="trust-content">
                        <h4>5.0 Rating</h4>
                        <p>100+ Projects</p>
                    </div>
                </div>
            </div>
            <div class="trust-disclaimer">
                <i class="fas fa-shield-alt"></i>
                <span>All client data is encrypted and protected. Licensed professional with full business insurance.</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>Cyrus Wilburn</h3>
                    <p>Building high-converting websites that drive real business results. Let's transform your online presence together.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-services">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#services">Web Development</a></li>
                        <li><a href="#services">E-commerce Solutions</a></li>
                        <li><a href="#services">SEO Optimization</a></li>
                        <li><a href="#services">Mobile Optimization</a></li>
                        <li><a href="#services">Maintenance & Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-left">
                    <p>&copy; 2024 Cyrus Wilburn. All rights reserved.</p>
                </div>
                <div class="footer-bottom-right">
                    <a href="#privacy">Privacy Policy</a>
                    <a href="#terms">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>

