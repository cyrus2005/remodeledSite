<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database configuration
$host = 'localhost';
$dbname = 'cyruwjtb_main';
$username = 'cyruwjtb_admin';
$password = 'Pjah6966!$';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
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
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    // Prepare SQL statement
    $sql = "INSERT INTO contact_submissions (name, email, company, budget, timeline, message, ip_address, user_agent) 
            VALUES (:name, :email, :company, :budget, :timeline, :message, :ip_address, :user_agent)";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':company', $company);
    $stmt->bindParam(':budget', $budget);
    $stmt->bindParam(':timeline', $timeline);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':ip_address', $ip_address);
    $stmt->bindParam(':user_agent', $user_agent);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Send success response
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your message! I\'ll get back to you within 24 hours.'
        ]);
    } else {
        throw new Exception('Failed to save submission');
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
