<?php
// admin/delete_page.php — Delete a dynamic page
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

include '../includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM dynamic_pages WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: dashboard.php?success=' . urlencode('Page deleted successfully!'));
        exit;
    } catch (PDOException $e) {
        header('Location: dashboard.php?error=' . urlencode('Delete failed: ' . $e->getMessage()));
        exit;
    }
}

header('Location: dashboard.php');
exit;
