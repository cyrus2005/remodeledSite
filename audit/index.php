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
    
    // Basic validation
    if (empty($name) || empty($email) || empty($website)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
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
        $body .= "Goals: " . ($goals ? $goals : 'Not specified') . "\n\n";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Website Audit - Cyrus Wilburn</title>
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section with Gradient */
        .audit-hero {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 50%, #2c1810 100%);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 120px;
        }

        .audit-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 50%, #2c1810 100%);
            z-index: 1;
        }

        .audit-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .audit-hero h1 {
            font-size: 5rem;
            font-weight: 800;
            margin-bottom: 2rem;
            line-height: 1.1;
            text-shadow: 0 6px 30px rgba(0, 0, 0, 0.4);
            letter-spacing: -0.02em;
            position: relative;
        }

        .audit-hero h1::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--white), transparent);
            border-radius: 2px;
        }

        .audit-hero .highlight {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 50%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            position: relative;
            display: inline-block;
        }

        .audit-hero .highlight::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--white), transparent);
            border-radius: 2px;
        }

        .audit-subtitle {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            line-height: 1.6;
            font-weight: 400;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .audit-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 4rem;
        }

        .audit-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 20px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            min-width: 280px;
            justify-content: center;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .audit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .audit-btn:hover::before {
            left: 100%;
        }

        .audit-btn-primary {
            background: var(--white);
            color: var(--maroon);
            border-color: var(--white);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        .audit-btn-primary:hover {
            background: #f8f9fa;
            color: var(--maroon-dark);
            border-color: #f8f9fa;
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 255, 255, 0.4);
        }

        .audit-btn-secondary {
            background: transparent;
            color: var(--white);
            border-color: var(--white);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        .audit-btn-secondary:hover {
            background: var(--white);
            color: var(--maroon);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 255, 255, 0.3);
        }

        /* Features Section */
        .audit-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 4rem;
        }

        .audit-feature {
            background: rgba(255, 255, 255, 0.1);
            padding: 2.5rem 2rem;
            border-radius: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .audit-feature::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--white), rgba(255, 255, 255, 0.5), var(--white));
        }

        .audit-feature:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .audit-feature-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--white);
            transition: all 0.3s ease;
        }

        .audit-feature:hover .audit-feature-icon {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .audit-feature h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--white);
            font-weight: 600;
        }

        .audit-feature p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* Stats Section */
        .audit-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .audit-stat {
            text-align: center;
            padding: 1rem;
        }

        .audit-stat h3 {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .audit-stat p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            font-weight: 500;
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
            background: rgba(255, 255, 255, 0.9);
            color: var(--maroon);
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            background: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .audit-hero {
                padding-top: 100px;
            }
            
            .audit-hero h1 {
                font-size: 3.5rem;
            }

            .audit-subtitle {
                font-size: 1.2rem;
            }

            .audit-buttons {
                flex-direction: column;
                align-items: center;
            }

            .audit-btn {
                min-width: 280px;
                padding: 18px 35px;
            }

            .audit-features {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .audit-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .audit-hero {
                padding-top: 80px;
            }
            
            .audit-hero h1 {
                font-size: 3rem;
            }

            .audit-subtitle {
                font-size: 1rem;
            }

            .audit-btn {
                min-width: 250px;
                padding: 15px 30px;
                font-size: 1rem;
            }

            .audit-stats {
                grid-template-columns: 1fr;
            }

            .back-to-home {
                top: 1rem;
                left: 1rem;
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
            <div class="audit-content">
                <h1>Get Your <span class="highlight">Free Website Audit</span></h1>
                <p class="audit-subtitle">Discover exactly what's holding your website back and get actionable insights to boost your conversions, traffic, and revenue.</p>
                
                <div class="audit-buttons">
                    <a href="audit-form.php" class="audit-btn audit-btn-primary">
                        <i class="fas fa-search"></i>
                        Get Free Audit Now
                    </a>
                    <a href="quiz.php" class="audit-btn audit-btn-secondary">
                        <i class="fas fa-question-circle"></i>
                        Ready for a site? Take this quiz
                    </a>
                </div>

                <div class="audit-features">
                    <div class="audit-feature">
                        <div class="audit-feature-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <h3>Performance Analysis</h3>
                        <p>Get detailed insights into your website's speed, SEO, and user experience metrics.</p>
                    </div>
                    <div class="audit-feature">
                        <div class="audit-feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Mobile Optimization</h3>
                        <p>Ensure your site works perfectly on all devices and screen sizes.</p>
                    </div>
                    <div class="audit-feature">
                        <div class="audit-feature-icon">
                            <i class="fas fa-target"></i>
                        </div>
                        <h3>Conversion Optimization</h3>
                        <p>Identify opportunities to turn more visitors into customers.</p>
                    </div>
                </div>

                <div class="audit-stats">
                    <div class="audit-stat">
                        <h3>50+</h3>
                        <p>Websites Audited</p>
                    </div>
                    <div class="audit-stat">
                        <h3>95%</h3>
                        <p>Client Satisfaction</p>
                    </div>
                    <div class="audit-stat">
                        <h3>24hrs</h3>
                        <p>Report Delivery</p>
                    </div>
                    <div class="audit-stat">
                        <h3>100%</h3>
                        <p>Free & No Obligation</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../assets/js/script.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
