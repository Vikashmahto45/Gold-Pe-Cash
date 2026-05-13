<?php
// setup_cms_keys.php - Injects all text/image keys into the database for the Universal CMS

include 'includes/db.php';

$cms_keys = [
    // ── Homepage Hero ──
    ['hero_badge', 'DIAMOND BUYING SERVICE', 'hero'],
    ['hero_h1', 'Cash for Diamond', 'hero'],
    ['hero_text', 'Sell your diamond jewelry and loose stones at the highest live market rate. Expert 4C valuation, zero hassle, 100% transparent process.', 'hero'],
    ['hero_btn', 'Get Free Valuation', 'hero'],
    // ── About Page ──
    ['about_hero_h1', 'About Gold Pe Cash', 'about'],
    ['about_hero_p', 'Ranchi\'s most trusted gold buying company.', 'about'],
    ['about_intro_h2', 'Who We Are', 'about'],
    ['about_intro_p', 'Gold Pe Cash is the premier gold buying service in Ranchi...', 'about'],
    ['about_trusted_h2', 'Why We Are The Trusted Buyers', 'about'],
    // You'd add hundreds here
];

try {
    $stmt = $pdo->prepare("INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES (?, ?, ?)");
    foreach ($cms_keys as $key) {
        $stmt->execute([$key[0], $key[1], $key[2]]);
    }
    echo "CMS Keys successfully injected into the Database.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>