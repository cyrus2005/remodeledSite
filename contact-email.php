<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Email configuration
$to_email = 'leads@cyruswilburn.dev';
$from_email = 'leads@cyruswilburn.dev';
$subject = 'New Project Inquiry from Cyrus Wilburn Portfolio';

try {
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST requests are allowed');
    }
    
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $budget = trim($_POST['budget'] ?? '');
    $timeline = trim($_POST['timeline'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        throw new Exception('Name, email, and message are required');
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }
    
    // Validate message length
    if (strlen($message) > 500) {
        throw new Exception('Message is too long (max 500 characters)');
    }
    
    // Get client IP and user agent
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $timestamp = date('Y-m-d H:i:s');
    
    // Create email content
    $email_body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: #7f1d1d; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #7f1d1d; }
            .value { margin-top: 5px; }
            .footer { background: #f5f5f5; padding: 15px; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>New Project Inquiry</h2>
            <p>From Cyrus Wilburn Portfolio Website</p>
        </div>
        
        <div class='content'>
            <div class='field'>
                <div class='label'>Name:</div>
                <div class='value'>" . htmlspecialchars($name) . "</div>
            </div>
            
            <div class='field'>
                <div class='label'>Email:</div>
                <div class='value'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></div>
            </div>
            
            <div class='field'>
                <div class='label'>Company:</div>
                <div class='value'>" . htmlspecialchars($company ?: 'Not provided') . "</div>
            </div>
            
            <div class='field'>
                <div class='label'>Budget:</div>
                <div class='value'>" . htmlspecialchars($budget ?: 'Not specified') . "</div>
            </div>
            
            <div class='field'>
                <div class='label'>Timeline:</div>
                <div class='value'>" . htmlspecialchars($timeline ?: 'Not specified') . "</div>
            </div>
            
            <div class='field'>
                <div class='label'>Project Details:</div>
                <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
        </div>
        
        <div class='footer'>
            <p><strong>Submission Details:</strong></p>
            <p>Date: " . $timestamp . "</p>
            <p>IP Address: " . htmlspecialchars($ip_address) . "</p>
            <p>User Agent: " . htmlspecialchars($user_agent) . "</p>
        </div>
    </body>
    </html>
    ";
    
    // Email headers
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: ' . $from_email,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion()
    ];
    
    // Send email
    if (mail($to_email, $subject, $email_body, implode("\r\n", $headers))) {
        // Send success response
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your message! I\'ll get back to you within 24 hours.'
        ]);
    } else {
        throw new Exception('Failed to send email. Please try again or contact me directly.');
    }
    
} catch (Exception $e) {
    // Send error response
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
