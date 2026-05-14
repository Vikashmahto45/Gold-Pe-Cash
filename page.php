<?php
include 'includes/db.php';
include 'includes/functions.php';

$slug = $_GET['slug'] ?? '';
if (!$slug && isset($dynamic_slug)) {
    $slug = $dynamic_slug; // For route.php inclusion
}

if (!$slug) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM dynamic_pages WHERE slug = ? AND status = 'published'");
$stmt->execute([$slug]);
$page = $stmt->fetch();

if (!$page) {
    http_response_code(404);
    include 'index.php';
    exit;
}

$pageTitle = $page['meta_title'] ?: $page['title'] . " — Gold Pe Cash";
$metaDescription = $page['meta_desc'];
$metaKeywords = $page['meta_keywords'];

include 'includes/header.php';
$S = getAllSettings();
?>

<style>
    .dynamic-hero {
        background: linear-gradient(135deg, var(--maroon) 0%, #1a0000 100%);
        padding: 140px 0 80px;
        text-align: center;
        color: white;
    }
    .dynamic-hero h1 {
        font-size: 3.5rem;
        color: var(--gold);
        font-family: 'Playfair Display', serif;
        margin-bottom: 20px;
    }
    .page-content {
        padding: 80px 0;
        line-height: 1.8;
        font-size: 1.1rem;
        color: #444;
    }
    .page-content h2, .page-content h3 {
        color: var(--maroon);
        margin-top: 40px;
    }
    .page-content img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
    }
    .highlight-box {
        background: #fdf5e6;
        padding: 30px;
        border-left: 5px solid var(--gold);
        border-radius: 10px;
        margin: 40px 0;
    }
</style>

<section class="dynamic-hero">
    <div class="container">
        <h1><?php echo htmlspecialchars($page['title']); ?></h1>
        <?php if ($page['featured_image']): ?>
            <div style="margin-top:30px;"><img src="<?php echo $page['featured_image']; ?>" style="max-width:800px; width:100%; border-radius:20px; box-shadow:0 20px 40px rgba(0,0,0,0.3);"></div>
        <?php endif; ?>
    </div>
</section>

<div class="page-content">
    <div class="container" style="max-width: 900px;">
        <?php echo $page['content']; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
