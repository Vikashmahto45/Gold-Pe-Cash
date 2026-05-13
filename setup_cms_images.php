<?php
// setup_cms_images.php - Injects all image keys into the database for the Universal CMS

include 'includes/db.php';

$cms_keys = [
    // ── Global Images ──
    ['general_logo_img', 'assets/images/Logo.webp', 'general'],

    // ── Homepage Features ──
    ['home_story_img', 'assets/images/comic-story.png', 'hero'],
    ['home_freedom_img', 'assets/images/financial-freedom.png', 'hero'],
    ['home_feat_gold_img', 'assets/images/service-gold-final.png', 'services'],
    ['home_feat_silver_img', 'assets/images/service-silver-final.png', 'services'],
    ['home_feat_diamond_img', 'assets/images/service-diamond-final.png', 'services'],

    // ── Services Page Images ──
    ['service_gold_img', 'assets/images/service-gold-buying.png', 'services'],
    ['service_silver_img', 'assets/images/service-silver.png', 'services'],
    ['service_diamond_img', 'assets/images/service-diamond.png', 'services'],
    ['service_bailout_img', 'assets/images/service-bailout.png', 'services'],

    // ── About Page Images ──
    ['about_team_img', 'assets/images/support-team.png', 'about'],
    ['about_trusted_img', 'assets/images/trusted-appraisal.png', 'about']
];

try {
    $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value, setting_group) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
    foreach ($cms_keys as $key) {
        $stmt->execute([$key[0], $key[1], $key[2]]);
    }
    echo "Image Keys successfully injected into the Database.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>