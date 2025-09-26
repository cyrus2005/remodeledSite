<?php
// Database configuration
$host = 'localhost';
$dbname = 'cyruwjtb_main';
$username = 'cyruwjtb_admin';
$password = 'Pjah6966!$';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>✅ Database Connection Successful!</h2>";
    echo "<p>Connected to database: <strong>$dbname</strong></p>";
    echo "<p>Host: <strong>$host</strong></p>";
    echo "<p>User: <strong>$username</strong></p>";
    
    // Test table structure
    $stmt = $pdo->query("DESCRIBE contact_submissions");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>📋 Table Structure (contact_submissions):</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($column['Field']) . "</td>";
        echo "<td>" . htmlspecialchars($column['Type']) . "</td>";
        echo "<td>" . htmlspecialchars($column['Null']) . "</td>";
        echo "<td>" . htmlspecialchars($column['Key']) . "</td>";
        echo "<td>" . htmlspecialchars($column['Default']) . "</td>";
        echo "<td>" . htmlspecialchars($column['Extra']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Count existing submissions
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM contact_submissions");
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>Total submissions in database:</strong> " . $count['count'] . "</p>";
    
} catch (PDOException $e) {
    echo "<h2>❌ Database Connection Failed!</h2>";
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Please check your database credentials and ensure the database exists.</p>";
}
?>
