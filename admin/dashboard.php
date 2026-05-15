<?php
// admin/dashboard.php — Full-Featured Admin Dashboard
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

include '../includes/db.php';
include '../includes/functions.php';

// Load all settings so s($S, ...) works in the page editor panels
$S = getAllSettings();


$success = '';
$error = '';

// ── Save Settings ────────────────────────────────────────────────
function getSettingGroup($key)
{
    if (preg_match('/^seo_/', $key))
        return 'seo';
    if (preg_match('/^social_/', $key))
        return 'social';
    if (preg_match('/^hero/', $key))
        return 'hero';
    if (preg_match('/^(gold|silver|diamond)_rate/', $key))
        return 'rates';
    if (preg_match('/^testi/', $key))
        return 'testimonials';
    if (preg_match('/^stat/', $key))
        return 'stats';
    if (preg_match('/^feature/', $key))
        return 'features';
    if (preg_match('/^service/', $key))
        return 'services';
    if (preg_match('/^(phone|email|whatsapp|address)/', $key))
        return 'contact';
    if (preg_match('/^footer/', $key))
        return 'footer';
    if (preg_match('/^about/', $key))
        return 'about';
    if (preg_match('/^faq/', $key))
        return 'faq';
    if (preg_match('/^trusted/', $key))
        return 'trusted';
    if (preg_match('/^gold_rate_page/', $key))
        return 'gold_rate_page';
    return 'general';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value, setting_group)
                               VALUES (?, ?, ?)
                               ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");

        // Handle Text Fields
        if (isset($_POST['settings'])) {
            foreach ($_POST['settings'] as $key => $value) {
                $group = getSettingGroup($key);
                $stmt->execute([$key, $value, $group]);
            }
        }

        // Handle Image Uploads
        if (isset($_FILES['settings_img'])) {
            $upload_dir = realpath(__DIR__ . '/../assets/img/');
            if (!$upload_dir) {
                // If img doesn't exist, try images
                $upload_dir = realpath(__DIR__ . '/../assets/images/');
            }
            if ($upload_dir) {
                $upload_dir .= DIRECTORY_SEPARATOR;

                foreach ($_FILES['settings_img']['name'] as $key => $filename) {
                    if ($_FILES['settings_img']['error'][$key] === UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES['settings_img']['tmp_name'][$key];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];

                        if (in_array($ext, $allowed)) {
                            // create safe filename
                            $safe_filename = $key . '_' . time() . '.' . $ext;
                            $dest = $upload_dir . $safe_filename;

                            if (move_uploaded_file($tmp_name, $dest)) {
                                // Determine matching asset path string
                                $rel_path = (strpos($upload_dir, 'images') !== false) ? 'assets/images/' : 'assets/img/';
                                $db_path = $rel_path . $safe_filename;

                                $group = getSettingGroup($key);
                                $stmt->execute([$key, $db_path, $group]);
                            }
                        }
                    }
                }
            }
        }
        $success = 'Settings saved successfully!';
    } catch (PDOException $e) {
        $error = 'Save failed: ' . $e->getMessage();
    }
}

// ── Fetch all settings ───────────────────────────────────────────
$stmt = $pdo->query("SELECT * FROM settings ORDER BY setting_group, id");
$all = $stmt->fetchAll();
$grouped = [];
foreach ($all as $row) {
    $grouped[$row['setting_group']][$row['setting_key']] = $row;
}

// ── Fetch contact submissions ────────────────────────────────────
$submissions = [];
try {
    $stmt = $pdo->query("SELECT * FROM contact_submissions ORDER BY created_at DESC LIMIT 50");
    $submissions = $stmt->fetchAll();
} catch (PDOException $e) {
}

// ── Tab config (order + labels) ──────────────────────────────────
$tabs = [
    'seo' => ['icon' => '🔍', 'label' => 'SEO — Per Page'],
    'hero' => ['icon' => '🏠', 'label' => 'Homepage Hero'],
    'rates' => ['icon' => '💰', 'label' => 'Gold/Silver/Diamond Rates'],
    'trusted' => ['icon' => '🤝', 'label' => 'Trusted Buyers Section'],
    'services' => ['icon' => '⚙️', 'label' => 'Services Section'],
    'features' => ['icon' => '✅', 'label' => 'Why Choose Us'],
    'testimonials' => ['icon' => '💬', 'label' => 'Testimonials'],
    'stats' => ['icon' => '📊', 'label' => 'Stats / Counters'],
    'contact' => ['icon' => '📞', 'label' => 'Contact Info & Branches'],
    'social' => ['icon' => '🌐', 'label' => 'Social Media Links'],
    'footer' => ['icon' => '📄', 'label' => 'Footer'],
    'about' => ['icon' => '📖', 'label' => 'About Page'],
    'faq' => ['icon' => '❓', 'label' => 'FAQ Section'],
    'gold_rate_page' => ['icon' => '📉', 'label' => 'Gold Rate Page Content'],
    'dynamic_pages' => ['icon' => '📝', 'label' => 'Dynamic Pages / Blog'],
];

// ── SEO field friendly labels ────────────────────────────────────
$seoPages = [
    'home' => '🏠 Homepage',
    'about' => '📖 About Us',
    'services' => '⚙️ Services',
    'gold' => '🥇 Cash on Gold',
    'silver' => '🥈 Cash on Silver',
    'diamond' => '💎 Cash on Diamond',
    'bailout' => '🔓 Gold Bailout',
    'contact' => '📞 Contact',
    'gold_rate_ranchi' => '📉 Gold Rate Page',
];
$seoFields = ['title' => 'Page Title', 'desc' => 'Meta Description', 'keywords' => 'Keywords'];

function fl($key)
{
    $key = str_replace(['_', '-'], ' ', $key);
    return ucwords($key);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Gold Pe Cash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        /* ── Top Bar ── */
        .topbar {
            background: linear-gradient(135deg, #1a0505, #4b0000);
            color: #fff;
            padding: 0 30px;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-left h2 {
            font-size: 1.1rem;
            color: #d4af37;
            letter-spacing: 0.5px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.82rem;
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.2s;
        }

        .topbar-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #d4af37;
            border-color: #d4af37;
        }

        /* ── Layout ── */
        .admin-layout {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 260px;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding: 20px 0;
            flex-shrink: 0;
            position: sticky;
            top: 60px;
            height: calc(100vh - 60px);
            overflow-y: auto;
            z-index: 50;
            pointer-events: auto;
        }

        .sidebar-heading {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #aaa;
            padding: 10px 20px 6px;
        }

        .sidebar-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 20px;
            background: none;
            border: none;
            text-align: left;
            font-family: 'Outfit', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            color: #555;
            cursor: pointer;
            transition: all 0.15s;
            border-left: 3px solid transparent;
        }

        .sidebar-btn:hover {
            background: #fef3f2;
            color: #4b0000;
            border-left-color: #d4af37;
        }

        .sidebar-btn.active {
            background: #fff9f0;
            color: #4b0000;
            border-left-color: #d4af37;
            font-weight: 700;
        }

        .sidebar-sep {
            height: 1px;
            background: #f0f0f0;
            margin: 10px 0;
        }

        /* ── Main Content ── */
        .main-content {
            flex: 1;
            padding: 30px;
            max-width: 900px;
            position: relative;
            z-index: 10;
            pointer-events: auto;
        }

        /* ── Alerts ── */
        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* ── Panels ── */
        .panel {
            background: #fff;
            border-radius: 14px;
            padding: 28px 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            margin-bottom: 20px;
            display: none;
        }

        .panel.active {
            display: block;
        }

        .panel-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a0505;
            margin-bottom: 6px;
        }

        .panel-subtitle {
            font-size: 0.83rem;
            color: #888;
            margin-bottom: 24px;
        }

        /* ── SEO sub-tabs ── */
        .seo-pages-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 24px;
        }

        .seo-page-btn {
            padding: 6px 14px;
            background: #f0f0f0;
            border: none;
            border-radius: 20px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .seo-page-btn:hover,
        .seo-page-btn.active {
            background: #4b0000;
            color: #fff;
        }

        .seo-page-panel {
            display: none;
        }

        .seo-page-panel.active {
            display: block;
        }

        /* ── Form elements ── */
        .field-group {
            margin-bottom: 20px;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field-group label {
            display: block;
            font-weight: 600;
            font-size: 0.82rem;
            color: #6b7280;
            margin-bottom: 5px;
            text-transform: capitalize;
        }

        .field-group label .badge {
            font-size: 0.65rem;
            background: #fef3f2;
            color: #4b0000;
            border: 1px solid #fca5a5;
            padding: 1px 6px;
            border-radius: 10px;
            margin-left: 6px;
            vertical-align: middle;
        }

        .field-group input[type="text"],
        .field-group input[type="url"],
        .field-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.88rem;
            transition: border 0.25s, box-shadow 0.25s;
            background: #fafafa;
        }

        .field-group input:focus,
        .field-group textarea:focus {
            outline: none;
            border-color: #4b0000;
            box-shadow: 0 0 0 3px rgba(75, 0, 0, 0.08);
            background: #fff;
        }

        .field-group textarea {
            min-height: 80px;
            resize: vertical;
        }

        .field-hint {
            font-size: 0.72rem;
            color: #aaa;
            margin-top: 3px;
        }

        .save-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #4b0000, #7a0000);
            color: #fff;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            transition: all 0.25s;
            margin-top: 8px;
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #6b0000, #9a0000);
            transform: translateY(-1px);
        }

        .section-divider {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 22px 0;
        }

        .group-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #4b0000;
            text-transform: uppercase;
            margin-bottom: 14px;
            padding-bottom: 6px;
            border-bottom: 1px solid #fca5a5;
        }

        /* ── Page Links Panel ── */
        .page-links-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .page-link-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fafafa;
            transition: all 0.2s;
        }

        .page-link-card:hover {
            border-color: #d4af37;
            background: #fffdf5;
        }

        .page-link-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #4b0000, #7a0000);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .page-link-info {
            flex: 1;
        }

        .page-link-info strong {
            display: block;
            font-size: 0.88rem;
            color: #1a0505;
        }

        .page-link-info span {
            font-size: 0.75rem;
            color: #888;
        }

        .page-link-actions {
            display: flex;
            gap: 6px;
        }

        .plc-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            transition: all 0.2s;
        }

        .plc-view {
            background: #ecfdf5;
            color: #065f46;
        }

        .plc-view:hover {
            background: #6ee7b7;
        }

        .plc-edit {
            background: #fef3f2;
            color: #4b0000;
            border: 1px solid #fca5a5;
        }

        .plc-edit:hover {
            background: #4b0000;
            color: #fff;
            border-color: #4b0000;
        }

        /* ── Per-page Editor Styles ── */
        .settings-section-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #4b0000;
            border-bottom: 2px solid #fde8c8;
            padding-bottom: 6px;
            margin: 24px 0 14px;
        }

        .badge {
            display: inline-block;
            background: #fef3f2;
            color: #7a0000;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
            border: 1px solid #fca5a5;
            vertical-align: middle;
            margin-left: 4px;
        }

        .field-hint {
            font-size: 0.72rem;
            color: #888;
            margin: 3px 0 0;
        }

        .field-hint strong {
            color: #4b0000;
        }


        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.83rem;
        }

        thead th {
            background: #fafafa;
            font-weight: 700;
            color: #555;
            padding: 10px 12px;
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
        }

        tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: top;
        }

        tbody tr:hover {
            background: #fffdf5;
        }

        .badge-service {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 700;
            background: #fef3f2;
            color: #4b0000;
            border: 1px solid #fca5a5;
        }

        @media (max-width: 768px) {
            .admin-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                position: static;
                height: auto;
            }

            .field-row {
                grid-template-columns: 1fr;
            }

            .page-links-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <div class="topbar">
        <div class="topbar-left">
            <i class="fas fa-crown" style="color:#d4af37;"></i>
            <h2>Gold Pe Cash — Admin Panel</h2>
        </div>
        <div class="topbar-right">
            <a href="file_manager.php" class="topbar-btn"
                style="background: #0e639c; color: white; border-color: #1177bb;"><i class="fas fa-code"></i> File
                Manager / Code Editor</a>
            <a href="../index.php" target="_blank" class="topbar-btn"><i class="fas fa-external-link-alt"></i> View
                Site</a>
            <a href="logout.php" class="topbar-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="admin-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <p class="sidebar-heading">Content</p>
            <button class="sidebar-btn active" onclick="showPanel('page-links', this)">🔗 All Pages &amp; Links</button>
            <button class="sidebar-btn" onclick="showPanel('slugs', this)">🌐 URL Slugs</button>
            <button class="sidebar-btn" onclick="showPanel('seo', this)">🔍 SEO Settings</button>
            <button class="sidebar-btn" onclick="showPanel('social', this)">📣 Social Media</button>

            <div class="sidebar-sep"></div>
            <p class="sidebar-heading">Per-Page Editor</p>
            <button class="sidebar-btn" onclick="showPanel('edit-gold', this)">🥇 Cash on Gold</button>
            <button class="sidebar-btn" onclick="showPanel('edit-silver', this)">🥈 Cash on Silver</button>
            <button class="sidebar-btn" onclick="showPanel('edit-diamond', this)">💎 Cash on Diamond</button>
            <button class="sidebar-btn" onclick="showPanel('edit-bailout', this)">🔓 Gold Bailout</button>
            <button class="sidebar-btn" onclick="showPanel('gold_rate_page', this)">📉 Gold Rate Page</button>

            <div class="sidebar-sep"></div>
            <p class="sidebar-heading">Content Management</p>
            <button class="sidebar-btn" onclick="showPanel('dynamic_pages', this)">📝 Dynamic Pages (Blog)</button>

            <div class="sidebar-sep"></div>
            <p class="sidebar-heading">Homepage</p>
            <button class="sidebar-btn" onclick="showPanel('hero', this)">🏠 Hero Section</button>
            <button class="sidebar-btn" onclick="showPanel('rates', this)">💰 Rates</button>
            <button class="sidebar-btn" onclick="showPanel('trusted', this)">🤝 Trusted Buyers</button>
            <button class="sidebar-btn" onclick="showPanel('services', this)">⚙️ Services</button>
            <button class="sidebar-btn" onclick="showPanel('features', this)">✅ Why Choose Us</button>
            <button class="sidebar-btn" onclick="showPanel('testimonials', this)">💬 Testimonials</button>
            <button class="sidebar-btn" onclick="showPanel('stats', this)">📊 Stats</button>

            <div class="sidebar-sep"></div>
            <p class="sidebar-heading">Settings</p>
            <button class="sidebar-btn" onclick="showPanel('contact', this)">📞 Contact &amp; Branches</button>
            <button class="sidebar-btn" onclick="showPanel('footer', this)">📄 Footer</button>
            <button class="sidebar-btn" onclick="showPanel('about', this)">📖 About Page</button>
            <button class="sidebar-btn" onclick="showPanel('faq', this)">❓ FAQ</button>

            <div class="sidebar-sep"></div>
            <button class="sidebar-btn" onclick="showPanel('submissions', this)">📩 Contact Submissions</button>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <?php if ($success): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" id="settingsForm" enctype="multipart/form-data">

                <!-- ── All Pages & Links ─────────────────────────────── -->
                <div class="panel active" id="panel-page-links">
                    <div class="panel-title">🔗 All Pages & Links</div>
                    <div class="panel-subtitle">View each page on the website or click <strong>Edit SEO</strong> to
                        manage its title, description & keywords.</div>
                    <div class="page-links-grid">
                        <?php
                        $pages = [
                            ['🏠 Homepage', '../index.php', 'home'],
                            ['📖 About Us', '../about.php', 'about'],
                            ['⚙️ Services', '../services.php', 'services'],
                            ['🥇 Cash on Gold', '../gold.php', 'gold'],
                            ['🥈 Cash on Silver', '../silver.php', 'silver'],
                            ['💎 Cash on Diamond', '../demo.php', 'diamond'],
                            ['📉 Today Gold Rate', '../today-gold-rate-in-ranchi.php', 'gold_rate_ranchi'],
                            ['🔓 Gold Bailout', '../gold-bailout.php', 'bailout'],
                            ['📞 Contact', '../contact.php', 'contact'],
                        ];
                        foreach ($pages as [$name, $url, $seoKey]): ?>
                            <div class="page-link-card">
                                <div class="page-link-icon">🌐</div>
                                <div class="page-link-info">
                                    <strong><?= $name ?></strong>
                                    <span><?= str_replace('../', '', $url) ?></span>
                                </div>
                                <div class="page-link-actions">
                                    <button type="button" class="plc-btn plc-edit" onclick="openSeoEdit('<?= $seoKey ?>')">
                                        <i class="fas fa-pen"></i> Edit SEO
                                    </button>
                                    <a href="<?= $url ?>" target="_blank" class="plc-btn plc-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ── URL Slugs ───────────────────────────────────────── -->
                <div class="panel" id="panel-slugs">
                    <div class="panel-title">🌐 URL Slug Management</div>
                    <div class="panel-subtitle">Control the URL path for each page. After saving, visit
                        <strong>setup_database.php</strong> once to apply. Slugs are used via the smart router —
                        original .php links still work.
                    </div>
                    <div class="field-row">
                        <?php
                        $slugDefs = [
                            'slug_home' => '🏠 Homepage',
                            'slug_about' => '📖 About Us',
                            'slug_services' => '⚙️ Services',
                            'slug_gold' => '🥇 Cash on Gold',
                            'slug_silver' => '🥈 Cash on Silver',
                            'slug_diamond' => '💎 Cash on Diamond',
                            'slug_bailout' => '🔓 Gold Bailout',
                            'slug_contact' => '📞 Contact',
                        ];
                        foreach ($slugDefs as $key => $label): ?>
                            <div class="field-group">
                                <label><?= $label ?> <span class="badge">URL Slug</span></label>
                                <input type="text" name="settings[<?= $key ?>]"
                                    value="<?= htmlspecialchars(s($S, $key, str_replace('slug_', '', $key))) ?>"
                                    placeholder="e.g. cash-on-gold">
                                <p class="field-hint">Used as:
                                    yourdomain.com/<strong><?= htmlspecialchars(s($S, $key, '...')) ?></strong></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save URL Slugs</button>
                </div>

                <!-- ── Per-Page Editor: Cash on Gold ───────────────────── -->
                <div class="panel" id="panel-edit-gold">
                    <div class="panel-title">🥇 Cash on Gold — Page Content Editor</div>
                    <div class="panel-subtitle">Edit all text content shown on the <strong>gold.php</strong> page from
                        here.</div>

                    <div class="settings-section-title">Hero Section</div>
                    <div class="field-row">
                        <div class="field-group"><label>Badge Text</label><input type="text"
                                name="settings[gold_hero_badge]"
                                value="<?= htmlspecialchars(s($S, 'gold_hero_badge', 'GOLD BUYING SERVICE')) ?>"></div>
                        <div class="field-group"><label>Hero Heading (H1)</label><input type="text"
                                name="settings[gold_hero_h1]"
                                value="<?= htmlspecialchars(s($S, 'gold_hero_h1', 'Cash for Gold')) ?>"></div>
                    </div>
                    <div class="field-group"><label>Hero Paragraph Text</label><textarea
                            name="settings[gold_hero_text]"><?= htmlspecialchars(s($S, 'gold_hero_text', '')) ?></textarea>
                    </div>
                    <div class="field-group"><label>Hero Button Text</label><input type="text"
                            name="settings[gold_hero_btn]"
                            value="<?= htmlspecialchars(s($S, 'gold_hero_btn', 'Get Free Valuation')) ?>"></div>

                    <div class="settings-section-title">What We Buy Section</div>
                    <div class="field-group"><label>Section Heading</label><input type="text"
                            name="settings[gold_what_heading]"
                            value="<?= htmlspecialchars(s($S, 'gold_what_heading', 'All Types of Gold Accepted')) ?>">
                    </div>
                    <div class="field-group"><label>Section Description</label><textarea
                            name="settings[gold_what_text]"><?= htmlspecialchars(s($S, 'gold_what_text', '')) ?></textarea>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 1 Title</label><input type="text"
                                name="settings[gold_item1_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_item1_title', 'Jewelry')) ?>"></div>
                        <div class="field-group"><label>Item 1 Text</label><input type="text"
                                name="settings[gold_item1_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_item1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 2 Title</label><input type="text"
                                name="settings[gold_item2_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_item2_title', 'Gold Coins & Bars')) ?>"></div>
                        <div class="field-group"><label>Item 2 Text</label><input type="text"
                                name="settings[gold_item2_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_item2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 3 Title</label><input type="text"
                                name="settings[gold_item3_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_item3_title', 'Scrap Gold')) ?>"></div>
                        <div class="field-group"><label>Item 3 Text</label><input type="text"
                                name="settings[gold_item3_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_item3_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">Technology Section</div>
                    <div class="field-group"><label>Section Heading</label><input type="text"
                            name="settings[gold_tech_heading]"
                            value="<?= htmlspecialchars(s($S, 'gold_tech_heading', 'How We Value Your Gold')) ?>"></div>
                    <div class="field-row">
                        <div class="field-group"><label>Feature 1 Title</label><input type="text"
                                name="settings[gold_tech1_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_tech1_title', 'XRF Testing')) ?>"></div>
                        <div class="field-group"><label>Feature 1 Text</label><textarea name="settings[gold_tech1_text]"
                                style="min-height:60px"><?= htmlspecialchars(s($S, 'gold_tech1_text', '')) ?></textarea>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Feature 2 Title</label><input type="text"
                                name="settings[gold_tech2_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_tech2_title', 'Precision Weighing')) ?>"></div>
                        <div class="field-group"><label>Feature 2 Text</label><textarea name="settings[gold_tech2_text]"
                                style="min-height:60px"><?= htmlspecialchars(s($S, 'gold_tech2_text', '')) ?></textarea>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Feature 3 Title</label><input type="text"
                                name="settings[gold_tech3_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_tech3_title', 'Live Market Rate')) ?>"></div>
                        <div class="field-group"><label>Feature 3 Text</label><textarea name="settings[gold_tech3_text]"
                                style="min-height:60px"><?= htmlspecialchars(s($S, 'gold_tech3_text', '')) ?></textarea>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Feature 4 Title</label><input type="text"
                                name="settings[gold_tech4_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_tech4_title', 'Instant Payment')) ?>"></div>
                        <div class="field-group"><label>Feature 4 Text</label><textarea name="settings[gold_tech4_text]"
                                style="min-height:60px"><?= htmlspecialchars(s($S, 'gold_tech4_text', '')) ?></textarea>
                        </div>
                    </div>

                    <div class="settings-section-title">Why Choose Us Section</div>
                    <div class="field-group"><label>Section Heading</label><input type="text"
                            name="settings[gold_why_heading]"
                            value="<?= htmlspecialchars(s($S, 'gold_why_heading', 'Why Sell Gold to Gold Pe Cash?')) ?>">
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 1 Title</label><input type="text"
                                name="settings[gold_why1_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_why1_title', 'Highest Payout')) ?>"></div>
                        <div class="field-group"><label>Reason 1 Text</label><input type="text"
                                name="settings[gold_why1_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_why1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 2 Title</label><input type="text"
                                name="settings[gold_why2_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_why2_title', 'No Damage Testing')) ?>"></div>
                        <div class="field-group"><label>Reason 2 Text</label><input type="text"
                                name="settings[gold_why2_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_why2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 3 Title</label><input type="text"
                                name="settings[gold_why3_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_why3_title', 'Same Day Payment')) ?>"></div>
                        <div class="field-group"><label>Reason 3 Text</label><input type="text"
                                name="settings[gold_why3_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_why3_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 4 Title</label><input type="text"
                                name="settings[gold_why4_title]"
                                value="<?= htmlspecialchars(s($S, 'gold_why4_title', '6 Ranchi Branches')) ?>"></div>
                        <div class="field-group"><label>Reason 4 Text</label><input type="text"
                                name="settings[gold_why4_text]"
                                value="<?= htmlspecialchars(s($S, 'gold_why4_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">CTA Section</div>
                    <div class="field-group"><label>CTA Heading</label><input type="text"
                            name="settings[gold_cta_heading]"
                            value="<?= htmlspecialchars(s($S, 'gold_cta_heading', 'Get the Best Price for Your Gold Today')) ?>">
                    </div>
                    <div class="field-group"><label>CTA Text</label><textarea
                            name="settings[gold_cta_text]"><?= htmlspecialchars(s($S, 'gold_cta_text', '')) ?></textarea>
                    </div>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Gold Page Content</button>
                </div>

                <!-- ── Per-Page Editor: Cash on Silver ─────────────────── -->
                <div class="panel" id="panel-edit-silver">
                    <div class="panel-title">🥈 Cash on Silver — Page Content Editor</div>
                    <div class="panel-subtitle">Edit all text content shown on the <strong>silver.php</strong> page.
                    </div>

                    <div class="settings-section-title">Hero Section</div>
                    <div class="field-row">
                        <div class="field-group"><label>Badge Text</label><input type="text"
                                name="settings[silver_hero_badge]"
                                value="<?= htmlspecialchars(s($S, 'silver_hero_badge', 'SILVER BUYING SERVICE')) ?>">
                        </div>
                        <div class="field-group"><label>Hero Heading (H1)</label><input type="text"
                                name="settings[silver_hero_h1]"
                                value="<?= htmlspecialchars(s($S, 'silver_hero_h1', 'Cash for Silver')) ?>"></div>
                    </div>
                    <div class="field-group"><label>Hero Paragraph Text</label><textarea
                            name="settings[silver_hero_text]"><?= htmlspecialchars(s($S, 'silver_hero_text', '')) ?></textarea>
                    </div>

                    <div class="settings-section-title">What We Buy Section</div>
                    <div class="field-group"><label>Section Heading</label><input type="text"
                            name="settings[silver_what_heading]"
                            value="<?= htmlspecialchars(s($S, 'silver_what_heading', 'All Types of Silver Accepted')) ?>">
                    </div>
                    <div class="field-group"><label>Section Text</label><textarea
                            name="settings[silver_what_text]"><?= htmlspecialchars(s($S, 'silver_what_text', '')) ?></textarea>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 1 Title</label><input type="text"
                                name="settings[silver_item1_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_item1_title', 'Silverware & Utensils')) ?>">
                        </div>
                        <div class="field-group"><label>Item 1 Text</label><input type="text"
                                name="settings[silver_item1_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_item1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 2 Title</label><input type="text"
                                name="settings[silver_item2_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_item2_title', 'Silver Coins')) ?>"></div>
                        <div class="field-group"><label>Item 2 Text</label><input type="text"
                                name="settings[silver_item2_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_item2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 3 Title</label><input type="text"
                                name="settings[silver_item3_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_item3_title', 'Silver Jewelry')) ?>"></div>
                        <div class="field-group"><label>Item 3 Text</label><input type="text"
                                name="settings[silver_item3_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_item3_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">Why Choose Us</div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 1 Title</label><input type="text"
                                name="settings[silver_why1_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_why1_title', 'Live MCX Rate')) ?>"></div>
                        <div class="field-group"><label>Reason 1 Text</label><input type="text"
                                name="settings[silver_why1_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_why1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 2 Title</label><input type="text"
                                name="settings[silver_why2_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_why2_title', 'Any Weight Accepted')) ?>">
                        </div>
                        <div class="field-group"><label>Reason 2 Text</label><input type="text"
                                name="settings[silver_why2_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_why2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 3 Title</label><input type="text"
                                name="settings[silver_why3_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_why3_title', 'Weighing Done Openly')) ?>">
                        </div>
                        <div class="field-group"><label>Reason 3 Text</label><input type="text"
                                name="settings[silver_why3_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_why3_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 4 Title</label><input type="text"
                                name="settings[silver_why4_title]"
                                value="<?= htmlspecialchars(s($S, 'silver_why4_title', 'Same-Day Payment')) ?>"></div>
                        <div class="field-group"><label>Reason 4 Text</label><input type="text"
                                name="settings[silver_why4_text]"
                                value="<?= htmlspecialchars(s($S, 'silver_why4_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">CTA Section</div>
                    <div class="field-group"><label>CTA Heading</label><input type="text"
                            name="settings[silver_cta_heading]"
                            value="<?= htmlspecialchars(s($S, 'silver_cta_heading', 'Get the Best Price for Your Silver Today')) ?>">
                    </div>
                    <div class="field-group"><label>CTA Text</label><textarea
                            name="settings[silver_cta_text]"><?= htmlspecialchars(s($S, 'silver_cta_text', '')) ?></textarea>
                    </div>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Silver Page Content</button>
                </div>

                <!-- ── Per-Page Editor: Cash on Diamond ────────────────── -->
                <div class="panel" id="panel-edit-diamond">
                    <div class="panel-title">💎 Cash on Diamond — Page Content Editor</div>
                    <div class="panel-subtitle">Edit all text content shown on the <strong>diamond.php</strong> page.
                    </div>

                    <div class="settings-section-title">Hero Section</div>
                    <div class="field-row">
                        <div class="field-group"><label>Badge Text</label><input type="text"
                                name="settings[diamond_hero_badge]"
                                value="<?= htmlspecialchars(s($S, 'diamond_hero_badge', 'DIAMOND BUYING SERVICE')) ?>">
                        </div>
                        <div class="field-group"><label>Hero Heading (H1)</label><input type="text"
                                name="settings[diamond_hero_h1]"
                                value="<?= htmlspecialchars(s($S, 'diamond_hero_h1', 'Cash for Diamonds')) ?>"></div>
                    </div>
                    <div class="field-group"><label>Hero Paragraph Text</label><textarea
                            name="settings[diamond_hero_text]"><?= htmlspecialchars(s($S, 'diamond_hero_text', '')) ?></textarea>
                    </div>
                    <div class="field-group"><label>Hero Button Text</label><input type="text"
                            name="settings[diamond_hero_btn]"
                            value="<?= htmlspecialchars(s($S, 'diamond_hero_btn', 'Get Free Diamond Valuation')) ?>">
                    </div>

                    <div class="settings-section-title">What We Buy</div>
                    <div class="field-group"><label>Section Heading</label><input type="text"
                            name="settings[diamond_what_heading]"
                            value="<?= htmlspecialchars(s($S, 'diamond_what_heading', 'All Types of Diamonds Accepted')) ?>">
                    </div>
                    <div class="field-group"><label>Section Text</label><textarea
                            name="settings[diamond_what_text]"><?= htmlspecialchars(s($S, 'diamond_what_text', '')) ?></textarea>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 1 Title</label><input type="text"
                                name="settings[diamond_item1_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_item1_title', 'Diamond Jewelry')) ?>"></div>
                        <div class="field-group"><label>Item 1 Text</label><input type="text"
                                name="settings[diamond_item1_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_item1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 2 Title</label><input type="text"
                                name="settings[diamond_item2_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_item2_title', 'Loose Diamonds')) ?>"></div>
                        <div class="field-group"><label>Item 2 Text</label><input type="text"
                                name="settings[diamond_item2_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_item2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Item 3 Title</label><input type="text"
                                name="settings[diamond_item3_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_item3_title', 'Solitaires')) ?>"></div>
                        <div class="field-group"><label>Item 3 Text</label><input type="text"
                                name="settings[diamond_item3_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_item3_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">4C Valuation Section</div>
                    <div class="field-group"><label>Section Heading</label><input type="text"
                            name="settings[diamond_4c_heading]"
                            value="<?= htmlspecialchars(s($S, 'diamond_4c_heading', 'Our 4C Diamond Valuation Method')) ?>">
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Cut Title</label><input type="text"
                                name="settings[diamond_4c1_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c1_title', 'Cut')) ?>"></div>
                        <div class="field-group"><label>Cut Text</label><input type="text"
                                name="settings[diamond_4c1_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Color Title</label><input type="text"
                                name="settings[diamond_4c2_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c2_title', 'Color')) ?>"></div>
                        <div class="field-group"><label>Color Text</label><input type="text"
                                name="settings[diamond_4c2_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Clarity Title</label><input type="text"
                                name="settings[diamond_4c3_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c3_title', 'Clarity')) ?>"></div>
                        <div class="field-group"><label>Clarity Text</label><input type="text"
                                name="settings[diamond_4c3_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c3_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Carat Title</label><input type="text"
                                name="settings[diamond_4c4_title]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c4_title', 'Carat')) ?>"></div>
                        <div class="field-group"><label>Carat Text</label><input type="text"
                                name="settings[diamond_4c4_text]"
                                value="<?= htmlspecialchars(s($S, 'diamond_4c4_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">CTA Section</div>
                    <div class="field-group"><label>CTA Heading</label><input type="text"
                            name="settings[diamond_cta_heading]"
                            value="<?= htmlspecialchars(s($S, 'diamond_cta_heading', 'Get Expert Diamond Valuation Today')) ?>">
                    </div>
                    <div class="field-group"><label>CTA Text</label><textarea
                            name="settings[diamond_cta_text]"><?= htmlspecialchars(s($S, 'diamond_cta_text', '')) ?></textarea>
                    </div>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Diamond Page
                        Content</button>
                </div>

                <!-- ── Per-Page Editor: Gold Bailout ───────────────────── -->
                <div class="panel" id="panel-edit-bailout">
                    <div class="panel-title">🔓 Gold Bailout — Page Content Editor</div>
                    <div class="panel-subtitle">Edit all text content shown on the <strong>gold-bailout.php</strong>
                        page.</div>

                    <div class="settings-section-title">Hero Section</div>
                    <div class="field-row">
                        <div class="field-group"><label>Badge Text</label><input type="text"
                                name="settings[bailout_hero_badge]"
                                value="<?= htmlspecialchars(s($S, 'bailout_hero_badge', 'GOLD BAILOUT SERVICE')) ?>">
                        </div>
                        <div class="field-group"><label>Hero H1 (Line 1)</label><input type="text"
                                name="settings[bailout_hero_h1]"
                                value="<?= htmlspecialchars(s($S, 'bailout_hero_h1', 'Release Your')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Hero H1 Gold Text (Line 2)</label><input type="text"
                                name="settings[bailout_hero_h1_gold]"
                                value="<?= htmlspecialchars(s($S, 'bailout_hero_h1_gold', 'Pledged Gold')) ?>"></div>
                        <div class="field-group"><label>Hero Paragraph</label><textarea
                                name="settings[bailout_hero_text]"
                                style="min-height:70px"><?= htmlspecialchars(s($S, 'bailout_hero_text', '')) ?></textarea>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Check Point 1</label><input type="text"
                                name="settings[bailout_check1]"
                                value="<?= htmlspecialchars(s($S, 'bailout_check1', 'Zero paperwork hassle — we handle everything')) ?>">
                        </div>
                        <div class="field-group"><label>Check Point 2</label><input type="text"
                                name="settings[bailout_check2]"
                                value="<?= htmlspecialchars(s($S, 'bailout_check2', 'Instant cash payment after gold release')) ?>">
                        </div>
                    </div>
                    <div class="field-group"><label>Check Point 3</label><input type="text"
                            name="settings[bailout_check3]"
                            value="<?= htmlspecialchars(s($S, 'bailout_check3', 'All major banks & NBFCs covered')) ?>">
                    </div>

                    <div class="settings-section-title">4 Steps Process</div>
                    <div class="field-row">
                        <div class="field-group"><label>Step 1 Title</label><input type="text"
                                name="settings[bailout_step1_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step1_title', 'Share Details')) ?>"></div>
                        <div class="field-group"><label>Step 1 Text</label><input type="text"
                                name="settings[bailout_step1_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Step 2 Title</label><input type="text"
                                name="settings[bailout_step2_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step2_title', 'We Visit Bank')) ?>"></div>
                        <div class="field-group"><label>Step 2 Text</label><input type="text"
                                name="settings[bailout_step2_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Step 3 Title</label><input type="text"
                                name="settings[bailout_step3_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step3_title', 'Gold Released')) ?>"></div>
                        <div class="field-group"><label>Step 3 Text</label><input type="text"
                                name="settings[bailout_step3_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step3_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Step 4 Title</label><input type="text"
                                name="settings[bailout_step4_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step4_title', 'You Get Cash')) ?>"></div>
                        <div class="field-group"><label>Step 4 Text</label><input type="text"
                                name="settings[bailout_step4_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_step4_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">Why Choose Us</div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 1 Title</label><input type="text"
                                name="settings[bailout_why1_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why1_title', 'Fast Processing')) ?>"></div>
                        <div class="field-group"><label>Reason 1 Text</label><input type="text"
                                name="settings[bailout_why1_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why1_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 2 Title</label><input type="text"
                                name="settings[bailout_why2_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why2_title', 'Best Gold Rate')) ?>"></div>
                        <div class="field-group"><label>Reason 2 Text</label><input type="text"
                                name="settings[bailout_why2_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why2_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 3 Title</label><input type="text"
                                name="settings[bailout_why3_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why3_title', 'All Banks Covered')) ?>"></div>
                        <div class="field-group"><label>Reason 3 Text</label><input type="text"
                                name="settings[bailout_why3_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why3_text', '')) ?>"></div>
                    </div>
                    <div class="field-row">
                        <div class="field-group"><label>Reason 4 Title</label><input type="text"
                                name="settings[bailout_why4_title]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why4_title', 'No Hidden Fees')) ?>"></div>
                        <div class="field-group"><label>Reason 4 Text</label><input type="text"
                                name="settings[bailout_why4_text]"
                                value="<?= htmlspecialchars(s($S, 'bailout_why4_text', '')) ?>"></div>
                    </div>

                    <div class="settings-section-title">CTA Section</div>
                    <div class="field-group"><label>CTA Heading</label><input type="text"
                            name="settings[bailout_cta_heading]"
                            value="<?= htmlspecialchars(s($S, 'bailout_cta_heading', 'Get Your Gold Released Today')) ?>">
                    </div>
                    <div class="field-group"><label>CTA Text</label><textarea
                            name="settings[bailout_cta_text]"><?= htmlspecialchars(s($S, 'bailout_cta_text', '')) ?></textarea>
                    </div>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Gold Bailout
                        Content</button>
                </div>

                <!-- ── SEO Settings ─────────────────────────────────── -->

                <div class="panel" id="panel-seo">
                    <div class="panel-title">🔍 SEO — Per Page Settings</div>
                    <div class="panel-subtitle">Control the Title, Meta Description, and Keywords for each page. These
                        are loaded dynamically from the database.</div>
                    <div class="seo-pages-nav">
                        <?php $fi = true;
                        foreach ($seoPages as $pageKey => $pageLabel): ?>
                            <button type="button" class="seo-page-btn <?= $fi ? 'active' : '' ?>"
                                onclick="showSeoPage('<?= $pageKey ?>', this)">
                                <?= $pageLabel ?>
                            </button>
                            <?php $fi = false; endforeach; ?>
                    </div>
                    <?php $fi = true;
                    foreach ($seoPages as $pageKey => $pageLabel): ?>
                        <div class="seo-page-panel <?= $fi ? 'active' : '' ?>" id="seop-<?= $pageKey ?>">
                            <div class="group-label"><?= $pageLabel ?></div>
                            <?php foreach ($seoFields as $field => $label): ?>
                                <?php
                                $dbKey = "seo_{$pageKey}_{$field}";
                                $val = $grouped['seo'][$dbKey]['setting_value'] ?? '';
                                $rows = ($field === 'desc') ? 2 : 1;
                                $hint = '';
                                if ($field === 'title')
                                    $hint = 'Recommended: 50–60 characters';
                                if ($field === 'desc')
                                    $hint = 'Recommended: 120–160 characters';
                                if ($field === 'keywords')
                                    $hint = 'Comma-separated keywords';
                                ?>
                                <div class="field-group">
                                    <label><?= $label ?></label>
                                    <?php if ($rows > 1): ?>
                                        <textarea name="settings[<?= $dbKey ?>]"
                                            rows="<?= $rows ?>"><?= htmlspecialchars($val) ?></textarea>
                                    <?php else: ?>
                                        <input type="text" name="settings[<?= $dbKey ?>]" value="<?= htmlspecialchars($val) ?>">
                                    <?php endif; ?>
                                    <?php if ($hint): ?>
                                        <p class="field-hint"><?= $hint ?></p><?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <hr class="section-divider">
                        </div>
                        <?php $fi = false; endforeach; ?>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save SEO Settings</button>
                </div>

                <!-- ── Social Media ─────────────────────────────────── -->
                <div class="panel" id="panel-social">
                    <div class="panel-title">🌐 Social Media Links</div>
                    <div class="panel-subtitle">Update the social media URLs shown in the footer. Enter full URLs
                        (https://...).</div>
                    <?php
                    $socials = [
                        'social_facebook' => ['Facebook Page URL', 'fab fa-facebook-f'],
                        'social_instagram' => ['Instagram Profile URL', 'fab fa-instagram'],
                        'social_youtube' => ['YouTube Channel URL', 'fab fa-youtube'],
                        'social_whatsapp' => ['WhatsApp Link (wa.me)', 'fab fa-whatsapp'],
                        'social_google_maps' => ['Google Maps Link', 'fas fa-map-marker-alt'],
                    ];
                    foreach ($socials as $key => [$label, $icon]): ?>
                        <div class="field-group">
                            <label><i class="<?= $icon ?>" style="width:16px;"></i> &nbsp;<?= $label ?></label>
                            <input type="url" name="settings[<?= $key ?>]"
                                value="<?= htmlspecialchars($grouped['social'][$key]['setting_value'] ?? '') ?>"
                                placeholder="https://...">
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Social Links</button>
                </div>

                <!-- ── Rates ─────────────────────────────────────────── -->
                <div class="panel" id="panel-rates">
                    <div class="panel-title">💰 Live Rates</div>
                    <div class="panel-subtitle">Update the gold, silver, and diamond rates shown on the website (values
                        shown to visitors).</div>
                    <div class="field-row">
                        <?php
                        $rateFields = ['gold_rate' => 'Gold Rate (₹/gram)', 'silver_rate' => 'Silver Rate (₹/gram)', 'diamond_rate' => 'Diamond Rate (₹/carat)'];
                        foreach ($rateFields as $k => $lbl): ?>
                            <div class="field-group">
                                <label><?= $lbl ?></label>
                                <input type="text" name="settings[<?= $k ?>]"
                                    value="<?= htmlspecialchars($grouped['rates'][$k]['setting_value'] ?? '') ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Rates</button>
                </div>

                <?php
                // ── Generic panels for remaining groups ────────────────
                $genericGroups = [
                    'hero' => ['🏠 Hero Section', 'Edit the main banner text shown on the homepage.'],
                    'trusted' => ['🤝 Trusted Buyers Section', 'The "Trusted Buyers" section content on homepage.'],
                    'services' => ['⚙️ Services Section', 'The 4 service cards shown on homepage.'],
                    'features' => ['✅ Why Choose Us', 'The 4 feature boxes on homepage.'],
                    'testimonials' => ['💬 Testimonials', 'Customer testimonials shown on homepage.'],
                    'stats' => ['📊 Stats / Counters', 'The statistics/numbers shown on the homepage banner.'],
                    'contact' => ['📞 Contact Info & Branches', 'Phone, email, WhatsApp, and all 6 branch addresses.'],
                    'footer' => ['📄 Footer', 'The text shown in the footer.'],
                    'about' => ['📖 About Page', 'Content for the About Us page.'],
                    'faq' => ['❓ FAQ Section', 'The FAQ questions and answers on the About page.'],
                    'gold_rate_page' => ['📉 Gold Rate Page Content', 'Text content and main heading for the Today Gold Rate page.'],
                ];
                foreach ($genericGroups as $grp => [$title, $subtitle]):
                    $items = $grouped[$grp] ?? [];
                    ?>
                    <div class="panel" id="panel-<?= $grp ?>">
                        <div class="panel-title"><?= $title ?></div>
                        <div class="panel-subtitle"><?= $subtitle ?></div>
                        <?php foreach ($items as $key => $item): ?>
                            <div class="field-group">
                                <label><?= fl($key) ?> <span class="badge"><?= $key ?></span></label>
                                <?php if (str_ends_with($key, '_img') || str_ends_with($key, '_image') || str_starts_with($key, 'image_')): ?>
                                    <?php if ($item['setting_value']): ?>
                                        <div
                                            style="margin-bottom: 10px; padding: 10px; background: rgba(0,0,0,0.05); border-radius: 6px; display: inline-block;">
                                            <img src="../<?= htmlspecialchars((string) ($item['setting_value'] ?? '')) ?>"
                                                style="max-height: 80px; max-width: 100%; object-fit: contain; border-radius: 4px;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="hidden" name="settings[<?= htmlspecialchars($key) ?>]"
                                        value="<?= htmlspecialchars((string) ($item['setting_value'] ?? '')) ?>">
                                    <input type="file" name="settings_img[<?= htmlspecialchars($key) ?>]" accept="image/*"
                                        style="padding: 10px; background: #fff; width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                                <?php elseif (strlen((string) ($item['setting_value'] ?? '')) > 100): ?>
                                    <textarea
                                        name="settings[<?= htmlspecialchars($key) ?>]"><?= htmlspecialchars((string) ($item['setting_value'] ?? '')) ?></textarea>
                                <?php else: ?>
                                    <input type="text" name="settings[<?= htmlspecialchars($key) ?>]"
                                        value="<?= htmlspecialchars((string) ($item['setting_value'] ?? '')) ?>">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($items)): ?>
                            <p style="color:#aaa;font-size:0.85rem;">No settings found. Run setup_database.php to seed defaults.
                            </p>
                        <?php endif; ?>
                        <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save
                            <?= explode(' —', $title)[0] ?></button>
                    </div>
                <?php endforeach; ?>

                <!-- ── Dynamic Pages / Blog ─────────────────────────── -->
                <div class="panel" id="panel-dynamic_pages">
                    <div class="panel-title">📝 Dynamic Pages & Blog Management</div>
                    <div class="panel-subtitle">Create and manage your own custom pages or blog posts.</div>
                    
                    <div style="margin-bottom: 20px;">
                        <a href="edit_page.php" class="plc-btn plc-view" style="padding: 10px 20px; font-size: 0.9rem;">
                            <i class="fas fa-plus"></i> Create New Page
                        </a>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM dynamic_pages ORDER BY created_at DESC");
                                $dynPages = $stmt->fetchAll();
                                if (empty($dynPages)): ?>
                                    <tr><td colspan="5" style="text-align:center; color:#aaa;">No dynamic pages created yet.</td></tr>
                                <?php else:
                                    foreach ($dynPages as $dp): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($dp['title']) ?></strong></td>
                                            <td><code>/<?= htmlspecialchars($dp['slug']) ?></code></td>
                                            <td><span class="badge" style="background: <?= $dp['status'] === 'published' ? '#d1fae5' : '#eee' ?>; color: <?= $dp['status'] === 'published' ? '#065f46' : '#666' ?>;"><?= strtoupper($dp['status']) ?></span></td>
                                            <td style="font-size: 0.75rem;"><?= date('M d, Y', strtotime($dp['created_at'])) ?></td>
                                            <td>
                                                <div class="page-link-actions">
                                                    <a href="edit_page.php?id=<?= $dp['id'] ?>" class="plc-btn plc-edit"><i class="fas fa-pen"></i> Edit</a>
                                                    <a href="../<?= htmlspecialchars($dp['slug']) ?>" target="_blank" class="plc-btn plc-view"><i class="fas fa-eye"></i> View</a>
                                                    <a href="delete_page.php?id=<?= $dp['id'] ?>" class="plc-btn plc-edit" style="border-color:#ff4d4d; color:#ff4d4d; background:#fff5f5;" onclick="return confirm('Are you sure you want to delete this page? This cannot be undone.')"><i class="fas fa-trash"></i> Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </form>

            <!-- ── Contact Submissions ───────────────────────────── -->
            <div class="panel" id="panel-submissions">
                <div class="panel-title">📩 Contact Submissions</div>
                <div class="panel-subtitle">All enquiries submitted via the contact form across the website.</div>
                <?php if (empty($submissions)): ?>
                    <p style="color:#aaa;">No submissions yet.</p>
                <?php else: ?>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Service</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($submissions as $i => $sub): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($sub['name']) ?></td>
                                        <td><a
                                                href="tel:<?= htmlspecialchars($sub['phone']) ?>"><?= htmlspecialchars($sub['phone']) ?></a>
                                        </td>
                                        <td><?= htmlspecialchars($sub['email']) ?></td>
                                        <td><span class="badge-service"><?= htmlspecialchars($sub['service']) ?></span></td>
                                        <td><?= htmlspecialchars(substr($sub['message'], 0, 80)) ?><?= strlen($sub['message']) > 80 ? '…' : '' ?>
                                        </td>
                                        <td style="white-space:nowrap;"><?= $sub['created_at'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script>
        function showPanel(id, btn) {
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.sidebar-btn').forEach(b => b.classList.remove('active'));
            const panel = document.getElementById('panel-' + id);
            if (panel) panel.classList.add('active');
            if (btn) btn.classList.add('active');
        }

        function showSeoPage(id, btn) {
            document.querySelectorAll('.seo-page-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.seo-page-btn').forEach(b => b.classList.remove('active'));
            const p = document.getElementById('seop-' + id);
            if (p) p.classList.add('active');
            if (btn) btn.classList.add('active');
        }

        // Called by Edit SEO buttons on page cards
        function openSeoEdit(seoKey) {
            // 1. Switch main panel to SEO
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.sidebar-btn').forEach(b => b.classList.remove('active'));
            const seoPanel = document.getElementById('panel-seo');
            if (seoPanel) seoPanel.classList.add('active');
            // Highlight sidebar SEO button
            document.querySelectorAll('.sidebar-btn').forEach(b => {
                if (b.textContent.trim().startsWith('🔍')) b.classList.add('active');
            });
            // 2. Switch SEO sub-tab to the matching page
            document.querySelectorAll('.seo-page-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.seo-page-btn').forEach(b => b.classList.remove('active'));
            const seop = document.getElementById('seop-' + seoKey);
            if (seop) seop.classList.add('active');
            // Highlight the matching seo-page-btn
            document.querySelectorAll('.seo-page-btn').forEach(b => {
                if (b.getAttribute('onclick') && b.getAttribute('onclick').includes("'" + seoKey + "'")) {
                    b.classList.add('active');
                }
            });
            // 3. Smooth scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Auto-dismiss success alert after 4s
        setTimeout(() => {
            const a = document.querySelector('.alert-success');
            if (a) a.style.opacity = '0', setTimeout(() => a.remove(), 400);
        }, 4000);
    </script>
</body>

</html>