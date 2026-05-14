<?php
// setup_database.php — Run once to create tables and seed content
// Visit: http://localhost/Gold Pe Cash/setup_database.php

include 'includes/db.php';

if (!$pdo) {
    try {
        $pdo_temp = new PDO("mysql:host=localhost;charset=utf8mb4", 'root', '');
        $pdo_temp->exec("CREATE DATABASE IF NOT EXISTS goldpecash CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo = new PDO("mysql:host=localhost;dbname=goldpecash;charset=utf8mb4", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p>✅ Database 'goldpecash' created.</p>";
    } catch (PDOException $e) {
        die("❌ Cannot create database: " . $e->getMessage());
    }
}

// Create or update settings table
$pdo->exec("CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_group VARCHAR(50) DEFAULT 'general',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Add setting_group column if doesn't exist
try {
    $pdo->exec("ALTER TABLE settings ADD COLUMN setting_group VARCHAR(50) DEFAULT 'general' AFTER setting_value");
} catch (PDOException $e) {
}
try {
    $pdo->exec("ALTER TABLE settings ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
} catch (PDOException $e) {
}

echo "<p>✅ Table 'settings' ready.</p>";

// Create admin_users table
$pdo->exec("CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
echo "<p>✅ Table 'admin_users' created.</p>";

// Create contact_submissions table
$pdo->exec("CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    service VARCHAR(50),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
echo "<p>✅ Table 'contact_submissions' created.</p>";

// Seed default admin user (password: admin@789)
$hash = password_hash('admin@789', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT IGNORE INTO admin_users (username, password) VALUES (?, ?)");
$stmt->execute(['admin', $hash]);
echo "<p>✅ Admin user: <b>admin</b> / <b>admin@789</b></p>";

// Seed all settings
$settings = [
    // ─── URL Slugs ───
    ['slug_home', 'home', 'slugs'],
    ['slug_about', 'about-us', 'slugs'],
    ['slug_services', 'services', 'slugs'],
    ['slug_gold', 'cash-on-gold', 'slugs'],
    ['slug_silver', 'cash-on-silver', 'slugs'],
    ['slug_diamond', 'cash-on-diamond', 'slugs'],
    ['slug_bailout', 'gold-bailout', 'slugs'],
    ['slug_contact', 'contact-us', 'slugs'],

    // ─── Hero Section ───
    ['hero_tagline', "Ranchi's Most Trusted Gold Buyers", 'hero'],
    ['hero_heading', 'Get Cash for Your Gold,', 'hero'],
    ['hero_heading_gold', 'Anytime, Anywhere', 'hero'],
    ['hero_text', 'Get instant cash for your precious items — gold, diamonds, silver, and stones. We offer fair, accurate, and hassle-free appraisals. Turn your valuables into cash — anytime, anywhere.', 'hero'],

    // ─── Rates ───
    ['gold_rate', '6,250', 'rates'],
    ['silver_rate', '74.50', 'rates'],
    ['diamond_rate', '3,601', 'rates'],

    // ─── Trusted Buyers Section ───
    ['trusted_heading', 'Trusted Buyers of Gold, Silver & Diamonds — Instant Cash, Maximum Value', 'trusted'],
    ['trusted_text1', 'At Gold Pe Cash, we offer a fair and transparent gold evaluation process. Our experienced appraisers provide accurate assessments using state-of-the-art karatmeter testing. We give you the highest value for your gold, ensuring instant cash on the spot.', 'trusted'],
    ['trusted_text2', 'Whether you walk in or we come to you, the experience is dignified, private, and professional. We have served 1,000+ happy customers across Ranchi.', 'trusted'],

    // ─── Services ───
    ['service1_title', 'Leading Gold Buyer In Ranchi', 'services'],
    ['service1_text', 'Best rates using precision karatmeter testing. Instant cash payment guaranteed.', 'services'],
    ['service2_title', 'Release Pledged Gold Service', 'services'],
    ['service2_text', 'We release gold from bank loans and settle the balance to you in cash.', 'services'],
    ['service3_title', 'Doorstep Gold Selling Service', 'services'],
    ['service3_text', 'Sell gold from the comfort of your home. Secure, private, convenient.', 'services'],
    ['service4_title', 'Sell Gold for Instant Cash', 'services'],
    ['service4_text', 'Walk in, get evaluated, walk out with cash. Simple, fast, transparent.', 'services'],

    // ─── Why Choose Us ───
    ['feature1_title', 'Expert Appraisal', 'features'],
    ['feature1_text', 'Our certified experts use karatmeter to determine exact purity. Fair price guaranteed.', 'features'],
    ['feature2_title', 'Fair Prices', 'features'],
    ['feature2_text', 'We offer the best competitive market rates. 100% transparent pricing with no hidden charges.', 'features'],
    ['feature3_title', 'Convenient Locations', 'features'],
    ['feature3_text', '6 branches across Ranchi for easy access. Plus doorstep pickup available.', 'features'],
    ['feature4_title', 'Transparent Process', 'features'],
    ['feature4_text', 'Testing done in front of you. No hidden charges. Full documentation provided.', 'features'],

    // ─── Testimonials ───
    ['testi1_text', 'Highly recommend Gold Pe Cash. They are trustworthy buyers who gave me maximum value. The evaluation was fair and completely transparent.', 'testimonials'],
    ['testi1_name', 'Puja Kumari', 'testimonials'],
    ['testi1_location', 'Ranchi, India', 'testimonials'],
    ['testi2_text', 'I was impressed with their honest evaluation and fast payment. Very reliable service with no hidden charges.', 'testimonials'],
    ['testi2_name', 'Reena Rao', 'testimonials'],
    ['testi2_location', 'Satisfied Customer', 'testimonials'],
    ['testi3_text', 'No hidden charges, fair value, and instant cash on the spot. I felt completely safe and satisfied throughout the process.', 'testimonials'],
    ['testi3_name', 'Vikash', 'testimonials'],
    ['testi3_location', 'Loyal Client', 'testimonials'],

    // ─── Stats ───
    ['stat1_number', '1,000+', 'stats'],
    ['stat1_label', 'Happy Customers', 'stats'],
    ['stat2_number', '10+', 'stats'],
    ['stat2_label', 'Services', 'stats'],
    ['stat3_number', '4.8', 'stats'],
    ['stat3_label', 'Rating', 'stats'],

    // ─── Contact Info ───
    ['phone', '+91-9576889595', 'contact'],
    ['email', 'info@goldpecash.com', 'contact'],
    ['whatsapp', '+91-9576889595', 'contact'],
    ['address1', 'Kishor Ganj, Harmu Road, beside Premsons Honda Showroom, Ranchi, 834001', 'contact'],
    ['address2', 'Opposite Health Point Hospital, Indraprastha Colony, Sarhul Nagar, Ranchi, Jharkhand – 834009', 'contact'],
    ['address3', 'Ratu Road, Near Mall of Ranchi, Ranchi 834001', 'contact'],
    ['address4', 'Piska More Chowk, Beside Gurdwara, Ranchi, Jharkhand 835102', 'contact'],
    ['address5', 'Kanta toli Chowk, Beside BOI and SBI ATM, Ranchi, Jharkhand 834001', 'contact'],
    ['address6', 'Ground floor, beside Lakshmi Narsing Home, Kilburn Colony, Shukla Colony, Ranchi, Jharkhand 834002', 'contact'],

    // ─── Social Media Links ───
    ['social_facebook', 'https://facebook.com/goldpecash', 'social'],
    ['social_instagram', 'https://instagram.com/goldpecash', 'social'],
    ['social_youtube', 'https://youtube.com/@goldpecash', 'social'],
    ['social_whatsapp', 'https://wa.me/919576889595', 'social'],
    ['social_google_maps', 'https://maps.google.com/?q=Gold+Pe+Cash+Ranchi', 'social'],

    // ─── Footer ───
    ['footer_text', "At Gold Pe Cash, we specialize in providing a secure and transparent process for selling your old gold jewelry for instant cash. Whether you're looking to sell gold online or visit us in person, our seamless experience guarantees 100% satisfaction and peace of mind.", 'footer'],

    // ─── About Page ───
    ['about_heading', 'Trusted Buyers of Gold, Silver & Diamonds – Instant Cash, Maximum Value', 'about'],
    ['about_text1', "At Gold Pe Cash, we believe in providing a fair and transparent gold evaluation process. Our team of experienced appraisers provides accurate assessments every single time, using state-of-the-art karatmeter technology. We ensure you receive the highest value for your gold. Trust, transparency and excellence — that's our promise.", 'about'],
    ['about_text2', 'Whether you are looking to sell old jewelry or release pledged ornaments from a bank, we make the entire process seamless, dignified, and instant. With us, you get instant cash on the spot — no delays, no paperwork hassle, no middle-men.', 'about'],
    ['about_feature1_title', 'Trusted Experts', 'about'],
    ['about_feature1_text', 'Our registered experts provide reliable and fair gold evaluations based on certified testing and market knowledge.', 'about'],
    ['about_feature2_title', 'Instant Cash Facility', 'about'],
    ['about_feature2_text', 'Get instant cash, bank transfer, or cheque. Payment is made on the spot within minutes of verification and testing.', 'about'],
    ['about_feature3_title', 'Secure & Transparent Process', 'about'],
    ['about_feature3_text', 'Every transaction is conducted in front of you. Your gold is tested openly with full transparency. No hidden deductions.', 'about'],
    ['about_feature4_title', 'Best Value Guaranteed', 'about'],
    ['about_feature4_text', 'We offer the highest market rates. Compare with any other buyer in Ranchi — we guarantee you will get more value from us.', 'about'],

    // ─── FAQ ───
    ['faq1_q', 'What documents do I need to sell my gold or silver?', 'faq'],
    ['faq1_a', 'You just need a valid government ID — Aadhar Card, PAN Card, or Voter ID — for verification as per government regulations.', 'faq'],
    ['faq2_q', 'How quickly will I get cash for my jewelry?', 'faq'],
    ['faq2_a', 'The process is instant. Once your items are verified and valued by our experts, you receive cash or bank transfer within 15 minutes.', 'faq'],
    ['faq3_q', 'Do you buy silver and diamonds as well?', 'faq'],
    ['faq3_a', 'Yes! We accept Gold, Silver, and Diamonds. We offer the best competitive market rates for all three precious metals.', 'faq'],
    ['faq4_q', 'Is the evaluation process safe and transparent?', 'faq'],
    ['faq4_a', 'Absolutely. We use non-destructive advanced karatmeters for testing. Your jewelry is tested in front of you — fully safe and transparent.', 'faq'],
    ['faq5_q', 'Do I need the original bill to sell my gold?', 'faq'],
    ['faq5_a', 'No, original bills are not required. However, we do require a valid government ID proof for the transaction.', 'faq'],

    // ─── SEO: Per-Page Meta Tags ───
    ['seo_home_title', 'Gold Pe Cash — Instant Cash for Gold in Ranchi | Best Rates', 'seo'],
    ['seo_home_desc', 'Get instant cash for gold, silver & diamonds in Ranchi. Best rates, transparent process, 6 branches. Call us today!', 'seo'],
    ['seo_home_keywords', 'cash for gold ranchi, sell gold ranchi, gold buyers ranchi, instant cash gold, gold pe cash', 'seo'],

    ['seo_about_title', 'About Gold Pe Cash | Trusted Gold Buyers in Ranchi', 'seo'],
    ['seo_about_desc', 'Learn about Gold Pe Cash — Ranchi\'s most trusted gold buyer. Expert appraisers, fair rates, instant cash, 6 branches.', 'seo'],
    ['seo_about_keywords', 'about gold pe cash, trusted gold buyer ranchi, gold appraisers ranchi', 'seo'],

    ['seo_services_title', 'Gold, Silver & Diamond Buying Services | Gold Pe Cash Ranchi', 'seo'],
    ['seo_services_desc', 'Cash on Gold, Silver, Diamond and Gold Bailout services. Expert valuation, best rates, instant payment in Ranchi.', 'seo'],
    ['seo_services_keywords', 'gold buying services ranchi, silver buyer, diamond buyer ranchi, gold bailout ranchi', 'seo'],

    ['seo_gold_title', 'Cash on Gold in Ranchi — Best Gold Rates | Gold Pe Cash', 'seo'],
    ['seo_gold_desc', 'Sell your gold jewelry, coins or bars at the best live market rate in Ranchi. Instant cash, no hidden charges.', 'seo'],
    ['seo_gold_keywords', 'cash on gold ranchi, sell gold jewelry ranchi, best gold rate ranchi', 'seo'],

    ['seo_silver_title', 'Cash on Silver in Ranchi — Best Silver Rates | Gold Pe Cash', 'seo'],
    ['seo_silver_desc', 'Sell silver utensils, coins, ornaments at best market price in Ranchi. Transparent weighing, instant cash payment.', 'seo'],
    ['seo_silver_keywords', 'cash on silver ranchi, sell silver ranchi, silver buyer ranchi', 'seo'],

    ['seo_diamond_title', 'Cash on Diamond in Ranchi — Expert 4C Valuation | Gold Pe Cash', 'seo'],
    ['seo_diamond_desc', 'Expert diamond valuation using 4C method. Best price for diamonds and diamond jewelry in Ranchi.', 'seo'],
    ['seo_diamond_keywords', 'cash on diamond ranchi, diamond buyer ranchi, sell diamond ranchi', 'seo'],

    ['seo_bailout_title', 'Gold Bailout & Release Service Ranchi | Gold Pe Cash', 'seo'],
    ['seo_bailout_desc', 'Release pledged gold from bank loans (Muthoot, Manappuram, SBI, HDFC) and get instant surplus cash in Ranchi.', 'seo'],
    ['seo_bailout_keywords', 'gold bailout ranchi, gold release service, release pledged gold ranchi, muthoot gold release', 'seo'],

    ['seo_contact_title', 'Contact Gold Pe Cash | Ranchi Gold Buyers — Call Now', 'seo'],
    ['seo_contact_desc', 'Contact Gold Pe Cash in Ranchi. 6 branches, instant cash, best rates. Call, WhatsApp or visit us today.', 'seo'],
    ['seo_contact_keywords', 'contact gold pe cash, gold buyers ranchi contact, cash for gold ranchi phone', 'seo'],
];

$stmt = $pdo->prepare("INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES (?, ?, ?)");
foreach ($settings as $s) {
    $stmt->execute($s);
}
echo "<p>✅ All settings seeded (" . count($settings) . " items)</p>";

echo "<br><h2>✅ Setup Complete!</h2>";
echo "<p><a href='admin/index.php'>🔐 Go to Admin Panel →</a></p>";
echo "<p><a href='index.php'>🏠 Go to Homepage →</a></p>";
?>