<?php
// Contact form handling
$message = '';
$error = '';

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $website = trim($_POST['website']);
    $business = trim($_POST['business'] ?? '');
    $goals = trim($_POST['goals'] ?? '');
    $problems = trim($_POST['problems'] ?? '');
    $improvement = trim($_POST['improvement'] ?? '');
    $budget = trim($_POST['budget'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($website)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Add https:// if not present
        if (!preg_match('/^https?:\/\//', $website)) {
            $website = 'https://' . $website;
        }
        
        // Validate the URL after adding https://
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $error = 'Please enter a valid website URL.';
        } else {
        // Email configuration
        $to = 'leads@cyruswilburn.dev';
        $subject = 'New Website Audit Request - ' . $name;
        
        $body = "New website audit request from your portfolio website:\n\n";
        $body .= "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Website: " . $website . "\n";
        $body .= "Business Type: " . ($business ? $business : 'Not specified') . "\n";
        $body .= "Goals: " . ($goals ? $goals : 'Not specified') . "\n";
        $body .= "Problems: " . ($problems ? $problems : 'Not specified') . "\n";
        $body .= "Improvement Focus: " . ($improvement ? $improvement : 'Not specified') . "\n";
        $body .= "Budget: " . ($budget ? $budget : 'Not specified') . "\n\n";
        $body .= "Submitted on: " . date('Y-m-d H:i:s') . "\n";
        $body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
        
        $headers = "From: noreply@cyruswilburn.dev\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $body, $headers)) {
            $message = 'Thank you for your audit request! I\'ll analyze your website and send you a detailed report within 24 hours.';
            
            // Clear form data
            $_POST = array();
        } else {
            $error = 'Sorry, there was an error sending your request. Please try again or contact me directly at leads@cyruswilburn.dev';
        }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Free Website Audit - Cyrus Wilburn</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.css">
    <link rel="stylesheet" href="../assets/css/local-fonts.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --maroon: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #a0002a;
            --white: #ffffff;
            --light-gray: #f8f9fa;
            --gray: #6c757d;
            --dark-gray: #2c2c2c;
            --text-dark: #2c2c2c;
            --text-light: #666666;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Back to Home Button */
        .back-to-home {
            position: fixed;
            top: 2rem;
            left: 2rem;
            z-index: 1000;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.95);
            color: var(--maroon);
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(128, 0, 32, 0.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            background: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Hero Section */
        .audit-hero {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: var(--white);
            padding: 120px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .audit-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .audit-hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .audit-hero p {
            font-size: 1.4rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }

        /* Form Section */
        .form-section {
            background: var(--white);
            padding: 80px 0;
            min-height: 100vh;
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 30px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(128, 0, 32, 0.1);
        }

        .form-header {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: var(--white);
            padding: 3rem;
            text-align: center;
        }

        .form-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .form-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .form-content {
            padding: 3rem;
        }

        .audit-form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .form-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--maroon);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--maroon);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section-title i {
            font-size: 1.3rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group label i {
            color: var(--maroon);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 18px 24px;
            border: 2px solid #e5e7eb;
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            font-family: inherit;
            color: var(--text-dark);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--maroon);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(128, 0, 32, 0.1);
            transform: translateY(-2px);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group select {
            cursor: pointer;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: var(--white);
            border: none;
            padding: 20px 50px;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 30px rgba(128, 0, 32, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            align-self: center;
            min-width: 300px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(128, 0, 32, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .success-message,
        .error-message {
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .success-message {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border: 2px solid #10b981;
        }

        .error-message {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            border: 2px solid #ef4444;
        }

        .success-message i,
        .error-message i {
            font-size: 1.3rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .audit-hero h1 {
                font-size: 2.5rem;
            }

            .audit-hero p {
                font-size: 1.1rem;
            }

            .form-container {
                margin: 0 1rem;
                border-radius: 20px;
            }

            .form-header,
            .form-content {
                padding: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .form-section-title {
                font-size: 1.3rem;
            }

            .submit-btn {
                min-width: auto;
                width: 100%;
                padding: 18px 30px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .audit-hero {
                padding: 100px 0 60px;
            }

            .audit-hero h1 {
                font-size: 2rem;
            }

            .form-header h2 {
                font-size: 2rem;
            }

            .form-header,
            .form-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Back to Home Button -->
    <div class="back-to-home">
        <a href="../index.php" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
    </div>

    <!-- Hero Section -->
    <section class="audit-hero">
        <div class="container">
            <h1>Get Your Free Website Audit</h1>
            <p>Discover exactly what's holding your website back and get actionable insights to boost your conversions, traffic, and revenue.</p>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h2>Request Your Free Audit</h2>
                    <p>Tell me about your website and I'll provide you with a detailed analysis within 24 hours.</p>
                </div>

                <div class="form-content">
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
                    
                    <form class="audit-form" method="POST" action="">
                        <!-- Basic Information Section -->
                        <div class="form-section-title">
                            <i class="fas fa-user"></i>
                            Basic Information
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Full Name *</label>
                                <input type="text" id="name" name="name" required placeholder="John Doe" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email Address *</label>
                                <input type="email" id="email" name="email" required placeholder="john@company.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="website"><i class="fas fa-globe"></i> Website URL *</label>
                            <input type="text" id="website" name="website" required placeholder="yourwebsite.com or https://yourwebsite.com" value="<?php echo isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="business"><i class="fas fa-building"></i> Business Type</label>
                            <select id="business" name="business">
                                <option value="">Select business type</option>
                                <option value="ecommerce" <?php echo (isset($_POST['business']) && $_POST['business'] == 'ecommerce') ? 'selected' : ''; ?>>E-commerce</option>
                                <option value="service" <?php echo (isset($_POST['business']) && $_POST['business'] == 'service') ? 'selected' : ''; ?>>Service Business</option>
                                <option value="nonprofit" <?php echo (isset($_POST['business']) && $_POST['business'] == 'nonprofit') ? 'selected' : ''; ?>>Non-profit</option>
                                <option value="blog" <?php echo (isset($_POST['business']) && $_POST['business'] == 'blog') ? 'selected' : ''; ?>>Blog/Content</option>
                                <option value="other" <?php echo (isset($_POST['business']) && $_POST['business'] == 'other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <!-- Website Goals Section -->
                        <div class="form-section-title">
                            <i class="fas fa-target"></i>
                            Website Goals
                        </div>
                        
                        <div class="form-group">
                            <label for="goals"><i class="fas fa-bullseye"></i> What are your main goals for your website?</label>
                            <textarea id="goals" name="goals" rows="3" placeholder="e.g., Increase sales, generate leads, improve user experience..."><?php echo isset($_POST['goals']) ? htmlspecialchars($_POST['goals']) : ''; ?></textarea>
                        </div>

                        <!-- New Questions Section -->
                        <div class="form-section-title">
                            <i class="fas fa-question-circle"></i>
                            Additional Questions
                        </div>
                        
                        <div class="form-group">
                            <label for="problems"><i class="fas fa-exclamation-triangle"></i> What do you think your problems are?</label>
                            <textarea id="problems" name="problems" rows="3" placeholder="e.g., Slow loading times, poor mobile experience, low conversion rates..."><?php echo isset($_POST['problems']) ? htmlspecialchars($_POST['problems']) : ''; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="improvement"><i class="fas fa-chart-line"></i> Where do you want the most improvement?</label>
                            <textarea id="improvement" name="improvement" rows="3" placeholder="e.g., SEO rankings, user experience, conversion rates, mobile optimization..."><?php echo isset($_POST['improvement']) ? htmlspecialchars($_POST['improvement']) : ''; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget"><i class="fas fa-dollar-sign"></i> Do you have a specific budget?</label>
                            <textarea id="budget" name="budget" rows="2" placeholder="e.g., $500-1000, $1000-5000, or just exploring options..."><?php echo isset($_POST['budget']) ? htmlspecialchars($_POST['budget']) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-search"></i>
                            Get My Free Audit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../assets/js/script.js"></script>
</body>
</html>
