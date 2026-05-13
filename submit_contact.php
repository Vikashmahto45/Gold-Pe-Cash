<?php
// submit_contact.php — Save contact form to database
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($pdo && $name && $phone) {
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, phone, email, service, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $email, $service, $message]);
    }

    // Redirect back with a thank you parameter
    header('Location: about.php?submitted=1');
    exit;
}

header('Location: index.php');
exit;
?>