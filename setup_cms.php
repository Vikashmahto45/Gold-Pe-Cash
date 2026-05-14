<?php
include 'includes/db.php';

if (!$pdo) {
    die("❌ Connection failed. Check includes/db.php");
}

try {
    // 1. Create dynamic_pages table
    $pdo->exec("CREATE TABLE IF NOT EXISTS dynamic_pages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        content LONGTEXT,
        meta_title VARCHAR(255),
        meta_desc TEXT,
        meta_keywords TEXT,
        featured_image VARCHAR(255),
        template VARCHAR(50) DEFAULT 'default',
        status ENUM('draft', 'published') DEFAULT 'published',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✅ Table 'dynamic_pages' created/ready.<br>";

    // 2. Add settings for the Gold Rate page
    $gold_rate_content = <<<EOD
<h2>Understanding the Today Gold Rate in Ranchi</h2>
<p>Gold has always been more than just a metal in the heart of Jharkhand. It is a symbol of prosperity, security, and tradition. If you are a resident of the capital city searching for the **Today Gold Rate in Ranchi**, you know how volatile the market can be.</p>

<h3>Why the Today Gold Price in Ranchi Matters to You</h3>
<p>The **Today Gold Price in Ranchi** serves as a benchmark for thousands of transactions happening across the city. From the bustling shops of Upper Bazar to the modern showrooms in Ratu Road, every seller and buyer keeps an eye on the **Today Ranchi Gold Rate**.</p>
EOD;

    $stmt = $pdo->prepare("INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES (?, ?, ?)");
    $stmt->execute(['gold_rate_h1', 'Today Gold Rate in Ranchi 22k and 24k', 'gold_rate_page']);
    $stmt->execute(['gold_rate_content', $gold_rate_content, 'gold_rate_page']);
    
    echo "✅ Gold Rate settings seeded.<br>";
    echo "<h2>CMS Setup Complete!</h2>";
} catch (PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}
