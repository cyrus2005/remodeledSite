<?php
// Quiz form handling
$quiz_result = '';
$quiz_score = 0;
$quiz_feedback = '';
$message = '';
$error = '';

if ($_POST && isset($_POST['submit_quiz'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $goal = $_POST['goal'] ?? '';
    $timeline = $_POST['timeline'] ?? '';
    $content = $_POST['content'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $features = $_POST['features'] ?? '';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($phone)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Calculate readiness score based on answers
        $quiz_score = 0;
        
        // Goal scoring
        if ($goal === 'presence') $quiz_score += 10;
        elseif ($goal === 'leads') $quiz_score += 20;
        elseif ($goal === 'bookings') $quiz_score += 25;
        elseif ($goal === 'ecommerce') $quiz_score += 30;
        
        // Timeline scoring
        if ($timeline === 'exploring') $quiz_score += 5;
        elseif ($timeline === '1-3months') $quiz_score += 15;
        elseif ($timeline === '30days') $quiz_score += 25;
        elseif ($timeline === 'asap') $quiz_score += 30;
        
        // Content readiness scoring
        if ($content === 'nothing') $quiz_score += 5;
        elseif ($content === 'some') $quiz_score += 15;
        elseif ($content === 'most') $quiz_score += 25;
        elseif ($content === 'ready') $quiz_score += 30;
        
        // Generate feedback based on score
        if ($quiz_score >= 70) {
            $quiz_feedback = 'Excellent! You\'re well-prepared for a website project. Based on your answers, you\'re ready to move forward with development.';
        } else if ($quiz_score >= 50) {
            $quiz_feedback = 'Good foundation! You have most elements in place but may need some preparation before starting your website project.';
        } else if ($quiz_score >= 30) {
            $quiz_feedback = 'Getting started! You have some elements ready but may need more preparation and planning before beginning your website project.';
        } else {
            $quiz_feedback = 'Early stage! Consider spending more time planning and preparing content before starting your website project.';
        }
        
        // Send email with quiz results
        $to = 'leads@cyruswilburn.dev';
        $subject = 'New "Ready for a Website?" Quiz Submission - ' . $name;
        
        $body = "New 'Ready for a Website?' quiz submission:\n\n";
        $body .= "CONTACT INFORMATION:\n";
        $body .= "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Phone: " . $phone . "\n\n";
        
        $body .= "QUIZ ANSWERS:\n";
        $body .= "1. Primary Goal: " . $goal . "\n";
        $body .= "2. Timeline: " . $timeline . "\n";
        $body .= "3. Content Readiness: " . $content . "\n";
        $body .= "4. Budget Range: " . $budget . "\n";
        $body .= "5. Features Needed: " . $features . "\n\n";
        
        $body .= "READINESS SCORE: " . $quiz_score . "/100\n";
        $body .= "FEEDBACK: " . $quiz_feedback . "\n\n";
        
        $body .= "Submitted on: " . date('Y-m-d H:i:s') . "\n";
        $body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
        
        $headers = "From: noreply@cyruswilburn.dev\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $body, $headers)) {
            $message = 'Thank you for completing the quiz!';
        } else {
            $error = 'Sorry, there was an error processing your quiz. Please try again.';
        }
        
        $quiz_result = 'Your Website Readiness Score: ' . $quiz_score . '/100';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ready for a Website? Quiz - Cyrus Wilburn</title>
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
        .quiz-hero {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 50%, #2c1810 100%);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 120px;
        }

        .quiz-hero::before {
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

        .quiz-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .quiz-hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 2rem;
            line-height: 1.1;
            text-shadow: 0 6px 30px rgba(0, 0, 0, 0.4);
            letter-spacing: -0.02em;
            position: relative;
        }

        .quiz-hero h1::before {
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

        .quiz-hero .highlight {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 50%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            position: relative;
            display: inline-block;
        }

        .quiz-hero .highlight::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--white), transparent);
            border-radius: 2px;
        }

        .quiz-subtitle {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            line-height: 1.6;
            font-weight: 400;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .quiz-btn {
            background: linear-gradient(135deg, var(--white) 0%, #f8f9fa 100%);
            color: var(--maroon);
            border: 3px solid var(--white);
            padding: 20px 40px;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .quiz-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(128, 0, 32, 0.1), transparent);
            transition: left 0.5s;
        }

        .quiz-btn:hover::before {
            left: 100%;
        }

        .quiz-btn:hover {
            background: #f8f9fa;
            color: var(--maroon-dark);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 255, 255, 0.4);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--white);
            margin: 2rem;
            padding: 0;
            border-radius: 20px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: var(--white);
            padding: 2rem;
            border-radius: 20px 20px 0 0;
            text-align: center;
            position: relative;
        }

        .modal-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .modal-header p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            margin-top: 1rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--white);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            color: var(--white);
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close:hover {
            transform: scale(1.1);
            opacity: 0.8;
        }

        .modal-body {
            padding: 3rem;
        }

        .quiz-step {
            display: none;
        }

        .quiz-step.active {
            display: block;
        }

        .quiz-step h3 {
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            font-size: 1.4rem;
            font-weight: 600;
            text-align: center;
        }

        .quiz-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quiz-option {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .quiz-option:hover {
            border-color: var(--maroon);
            background: rgba(128, 0, 32, 0.05);
        }

        .quiz-option input {
            margin-right: 1rem;
            transform: scale(1.2);
        }

        .quiz-option input:checked + span {
            font-weight: 600;
            color: var(--maroon);
        }

        .quiz-option:has(input:checked) {
            border-color: var(--maroon);
            background: rgba(128, 0, 32, 0.1);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-group input {
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        }

        .quiz-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }

        .nav-btn {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(128, 0, 32, 0.3);
        }

        .nav-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .nav-btn.secondary {
            background: transparent;
            color: var(--maroon);
            border: 2px solid var(--maroon);
        }

        .nav-btn.secondary:hover {
            background: var(--maroon);
            color: var(--white);
        }

        .quiz-result {
            display: none;
            padding: 3rem;
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: var(--white);
            border-radius: 20px;
            margin-top: 2rem;
            text-align: center;
        }

        .quiz-result.show {
            display: block;
        }

        .quiz-result h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--white);
        }

        .quiz-score {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .quiz-feedback {
            font-size: 1.2rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .success-message,
        .error-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
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
            .quiz-hero {
                padding-top: 100px;
            }
            
            .quiz-hero h1 {
                font-size: 3rem;
            }

            .quiz-subtitle {
                font-size: 1.2rem;
            }

            .modal-content {
                margin: 1rem;
            }

            .modal-body {
                padding: 2rem;
            }
        }

        @media (max-width: 480px) {
            .quiz-hero {
                padding-top: 80px;
            }
            
            .quiz-hero h1 {
                font-size: 2.5rem;
            }

            .quiz-subtitle {
                font-size: 1rem;
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
    <section class="quiz-hero">
        <div class="container">
            <div class="quiz-content">
                <h1>Ready for a <span class="highlight">Website?</span></h1>
                <p class="quiz-subtitle">Take this quick 5-question quiz to discover what type of website you need and get personalized recommendations.</p>
                
                <button class="quiz-btn" onclick="openModal()">
                    <i class="fas fa-question-circle"></i>
                    Start Quiz Now
                </button>
            </div>
        </div>
    </section>

    <!-- Quiz Modal -->
    <div id="quizModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Ready for a Website? Quiz</h2>
                <p>Answer 5 quick questions to discover what type of website you need</p>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
            </div>
            <div class="modal-body">
                <form class="quiz-form" method="POST" action="">
                    <!-- Step 1: Contact Information -->
                    <div class="quiz-step active" id="step1">
                        <h3>Let's start with your information</h3>
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="John Doe" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required placeholder="john@company.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="(555) 123-4567" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        <div class="quiz-navigation">
                            <div></div>
                            <button type="button" class="nav-btn" onclick="nextStep()">Next</button>
                        </div>
                    </div>

                    <!-- Step 2: Primary Goal -->
                    <div class="quiz-step" id="step2">
                        <h3>1. What's your primary goal for the site?</h3>
                        <div class="quiz-options">
                            <label class="quiz-option">
                                <input type="radio" name="goal" value="presence" <?php echo (isset($_POST['goal']) && $_POST['goal'] == 'presence') ? 'checked' : ''; ?>>
                                <span>A. Just have an online presence</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="goal" value="leads" <?php echo (isset($_POST['goal']) && $_POST['goal'] == 'leads') ? 'checked' : ''; ?>>
                                <span>B. Collect leads/inquiries (forms, calls)</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="goal" value="bookings" <?php echo (isset($_POST['goal']) && $_POST['goal'] == 'bookings') ? 'checked' : ''; ?>>
                                <span>C. Take bookings or appointments</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="goal" value="ecommerce" <?php echo (isset($_POST['goal']) && $_POST['goal'] == 'ecommerce') ? 'checked' : ''; ?>>
                                <span>D. Sell products/services online</span>
                            </label>
                        </div>
                        <div class="quiz-navigation">
                            <button type="button" class="nav-btn secondary" onclick="prevStep()">Previous</button>
                            <button type="button" class="nav-btn" onclick="nextStep()">Next</button>
                        </div>
                    </div>

                    <!-- Step 3: Timeline -->
                    <div class="quiz-step" id="step3">
                        <h3>2. What's your timeline?</h3>
                        <div class="quiz-options">
                            <label class="quiz-option">
                                <input type="radio" name="timeline" value="exploring" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == 'exploring') ? 'checked' : ''; ?>>
                                <span>A. Just exploring / no rush</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="timeline" value="1-3months" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == '1-3months') ? 'checked' : ''; ?>>
                                <span>B. 1–3 months</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="timeline" value="30days" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == '30days') ? 'checked' : ''; ?>>
                                <span>C. Within the next 30 days</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="timeline" value="asap" <?php echo (isset($_POST['timeline']) && $_POST['timeline'] == 'asap') ? 'checked' : ''; ?>>
                                <span>D. ASAP</span>
                            </label>
                        </div>
                        <div class="quiz-navigation">
                            <button type="button" class="nav-btn secondary" onclick="prevStep()">Previous</button>
                            <button type="button" class="nav-btn" onclick="nextStep()">Next</button>
                        </div>
                    </div>

                    <!-- Step 4: Content Readiness -->
                    <div class="quiz-step" id="step4">
                        <h3>3. How ready is your content (text, images, branding)?</h3>
                        <div class="quiz-options">
                            <label class="quiz-option">
                                <input type="radio" name="content" value="nothing" <?php echo (isset($_POST['content']) && $_POST['content'] == 'nothing') ? 'checked' : ''; ?>>
                                <span>A. I have nothing yet</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="content" value="some" <?php echo (isset($_POST['content']) && $_POST['content'] == 'some') ? 'checked' : ''; ?>>
                                <span>B. I have some rough text or photos</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="content" value="most" <?php echo (isset($_POST['content']) && $_POST['content'] == 'most') ? 'checked' : ''; ?>>
                                <span>C. I have most text and images ready</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="content" value="ready" <?php echo (isset($_POST['content']) && $_POST['content'] == 'ready') ? 'checked' : ''; ?>>
                                <span>D. Everything's ready (brand/logo/photos/copy)</span>
                            </label>
                        </div>
                        <div class="quiz-navigation">
                            <button type="button" class="nav-btn secondary" onclick="prevStep()">Previous</button>
                            <button type="button" class="nav-btn" onclick="nextStep()">Next</button>
                        </div>
                    </div>

                    <!-- Step 5: Budget Range -->
                    <div class="quiz-step" id="step5">
                        <h3>4. What budget range feels comfortable right now?</h3>
                        <div class="quiz-options">
                            <label class="quiz-option">
                                <input type="radio" name="budget" value="under300" <?php echo (isset($_POST['budget']) && $_POST['budget'] == 'under300') ? 'checked' : ''; ?>>
                                <span>A. <$300</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="budget" value="300-800" <?php echo (isset($_POST['budget']) && $_POST['budget'] == '300-800') ? 'checked' : ''; ?>>
                                <span>B. $300–$800</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="budget" value="800-2000" <?php echo (isset($_POST['budget']) && $_POST['budget'] == '800-2000') ? 'checked' : ''; ?>>
                                <span>C. $800–$2,000</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="budget" value="over2000" <?php echo (isset($_POST['budget']) && $_POST['budget'] == 'over2000') ? 'checked' : ''; ?>>
                                <span>D. $2,000+</span>
                            </label>
                        </div>
                        <div class="quiz-navigation">
                            <button type="button" class="nav-btn secondary" onclick="prevStep()">Previous</button>
                            <button type="button" class="nav-btn" onclick="nextStep()">Next</button>
                        </div>
                    </div>

                    <!-- Step 6: Features Needed -->
                    <div class="quiz-step" id="step6">
                        <h3>5. Which best describes the features you need?</h3>
                        <div class="quiz-options">
                            <label class="quiz-option">
                                <input type="radio" name="features" value="brochure" <?php echo (isset($_POST['features']) && $_POST['features'] == 'brochure') ? 'checked' : ''; ?>>
                                <span>A. Simple brochure (home, about, contact)</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="features" value="leadgen" <?php echo (isset($_POST['features']) && $_POST['features'] == 'leadgen') ? 'checked' : ''; ?>>
                                <span>B. Lead-gen site (forms, click-to-call, basic analytics)</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="features" value="booking" <?php echo (isset($_POST['features']) && $_POST['features'] == 'booking') ? 'checked' : ''; ?>>
                                <span>C. Booking/scheduling with confirmations</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="features" value="ecommerce" <?php echo (isset($_POST['features']) && $_POST['features'] == 'ecommerce') ? 'checked' : ''; ?>>
                                <span>D. E-commerce (products, payments, inventory)</span>
                            </label>
                            <label class="quiz-option">
                                <input type="radio" name="features" value="other" <?php echo (isset($_POST['features']) && $_POST['features'] == 'other') ? 'checked' : ''; ?>>
                                <span>E. Other</span>
                            </label>
                        </div>
                        <div class="quiz-navigation">
                            <button type="button" class="nav-btn secondary" onclick="prevStep()">Previous</button>
                            <button type="submit" name="submit_quiz" class="nav-btn">Get Results</button>
                        </div>
                    </div>

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

                    <?php if ($quiz_result): ?>
                        <div class="quiz-result show">
                            <h3>Your Website Readiness Score</h3>
                            <div class="quiz-score"><?php echo $quiz_score; ?>/100</div>
                            <p class="quiz-feedback"><?php echo htmlspecialchars($quiz_feedback); ?></p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        let currentStep = 1;
        const totalSteps = 6;

        // Modal functions
        function openModal() {
            document.getElementById('quizModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            currentStep = 1;
            showStep(1);
        }

        function closeModal() {
            document.getElementById('quizModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Step navigation
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.quiz-step').forEach(step => {
                step.classList.remove('active');
            });
            
            // Show current step
            document.getElementById('step' + step).classList.add('active');
            
            // Update progress bar
            const progress = (step / totalSteps) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }

        function nextStep() {
            if (validateCurrentStep()) {
                currentStep++;
                if (currentStep <= totalSteps) {
                    showStep(currentStep);
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function validateCurrentStep() {
            const currentStepElement = document.getElementById('step' + currentStep);
            const requiredInputs = currentStepElement.querySelectorAll('input[required]');
            
            for (let input of requiredInputs) {
                if (!input.value.trim()) {
                    alert('Please fill in all required fields before continuing.');
                    input.focus();
                    return false;
                }
            }
            
            // For radio button steps, check if at least one is selected
            if (currentStep > 1) {
                const radioInputs = currentStepElement.querySelectorAll('input[type="radio"]');
                const radioGroup = radioInputs[0].name;
                const selectedRadio = currentStepElement.querySelector(`input[name="${radioGroup}"]:checked`);
                
                if (!selectedRadio) {
                    alert('Please select an answer before continuing.');
                    return false;
                }
            }
            
            return true;
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('quizModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Add hover effects to quiz options
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selection from other options in the same group
                const groupName = this.querySelector('input').name;
                document.querySelectorAll(`input[name="${groupName}"]`).forEach(input => {
                    input.closest('.quiz-option').classList.remove('selected');
                });
                
                // Style selected option
                this.classList.add('selected');
            });
        });

        // Auto-open modal if there are results
        <?php if ($quiz_result): ?>
            document.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        <?php endif; ?>
    </script>
</body>
</html>