<?php
include 'includes/db.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h1>❌ Connection Failed</h1>";
    echo "<p><b>Error Message:</b> " . $e->getMessage() . "</p>";
    echo "<p>Please check your credentials in <b>includes/db.php</b>.</p>";
    exit;
}

$new_pass = 'admin@789';
$hash = password_hash($new_pass, PASSWORD_DEFAULT);

try {
    // Try to update existing user
    $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
    $stmt->execute([$hash]);

    if ($stmt->rowCount() > 0) {
        echo "<h1>✅ Success!</h1>";
        echo "<p>Your live admin password has been reset to: <b>admin@789</b></p>";
        echo "<p><a href='admin/'>Click here to login</a></p>";
    } else {
        // If user doesn't exist, try to create it
        $stmt = $pdo->prepare("REPLACE INTO admin_users (username, password) VALUES ('admin', ?)");
        $stmt->execute([$hash]);
        echo "<h1>✅ Admin Created</h1>";
        echo "<p>The 'admin' user was not found, so it has been created with password: <b>admin@789</b></p>";
        echo "<p><a href='admin/'>Click here to login</a></p>";
    }
} catch (PDOException $e) {
    echo "<h1>❌ Database Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
