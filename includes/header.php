<?php
// includes/header.php

// ── Dynamic Base URL Handling for Local & Live ───────────────────
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$baseDir = ($host === 'localhost' || $host === '127.0.0.1') ? '/Gold Pe Cash/' : '/';
$baseUrl = rtrim($protocol . "://" . $host . $baseDir, '/') . '/';

if (!isset($pageTitle))
    $pageTitle = "Gold Pe Cash - Instant Cash for Gold in Ranchi";
if (!isset($metaDescription))
    $metaDescription = "Get instant cash for gold, silver, and diamonds in Ranchi. Best rates, transparent process. Visit Gold Pe Cash today.";
if (!isset($metaKeywords))
    $metaKeywords = "cash for gold ranchi, sell gold ranchi, gold pe cash";

// ── Dynamic SEO from DB ──────────────────────────────────────────
// If a page passes $seoKey (e.g. 'home', 'about'), pull meta from DB
if (!isset($S)) {
    include_once __DIR__ . '/db.php';
    include_once __DIR__ . '/functions.php';
    $S = getAllSettings();
}
if (isset($seoKey)) {
    $dbTitle = s($S, "seo_{$seoKey}_title", '');
    $dbDesc = s($S, "seo_{$seoKey}_desc", '');
    $dbKw = s($S, "seo_{$seoKey}_keywords", '');
    if ($dbTitle)
        $pageTitle = $dbTitle;
    if ($dbDesc)
        $metaDescription = $dbDesc;
    if ($dbKw)
        $metaKeywords = $dbKw;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-323ZBB7XLM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-323ZBB7XLM');
    </script>
    <meta name="google-site-verification" content="kvgx2_I8Cybrv5hv3W8_CM0XYYdShdsg7pqyY8e5wcQ" />
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($metaKeywords); ?>">

    <!-- Dynamic Base URL to ensure all assets map correctly regardless of routing -->
    <base href="<?php echo $baseUrl; ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Gold Pe Cash">

    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="assets/images/Logo.webp">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Schema Markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Gold Pe Cash",
      "url": "https://goldpecash.com/",
      "logo": "https://goldpecash.com/assets/images/Logo.webp",
      "sameAs": [
        "https://facebook.com/goldpecash",
        "https://instagram.com/goldpecash",
        "https://youtube.com/@goldpecash"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://goldpecash.com/"
      },
      "headline": "Gold Pe Cash — Instant Cash for Gold in Ranchi, Gold Sale Rate in Ranchi, Gold Buyer in Ranchi",
      "image": "https://goldpecash.com/assets/images/Logo.webp",  
      "author": {
        "@type": "Organization",
        "name": "Gold Pe Cash"
      },  
      "publisher": {
        "@type": "Organization",
        "name": "Gold Pe Cash",
        "logo": {
          "@type": "ImageObject",
          "url": "https://goldpecash.com/assets/images/Logo.webp"
        }
      },
      "datePublished": "2024-01-01"
    }
    </script>
</head>

<body>

    <header>
        <div class="container header-inner">
            <div class="logo">
                <a href="./">
                    <img src="assets/images/Logo.webp" alt="Gold Pe Cash" class="site-logo">
                </a>
            </div>

            <nav>
                <ul class="nav-links">
                    <li><a href="./">Home</a></li>
                    <li><a href="about-us/">About Us</a></li>
                    <li>
                        <a href="gold-pe-cash-services/">Services <i class="fas fa-chevron-down"
                                style="font-size:0.6rem; margin-left:4px;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="cash-on-gold/">Cash on Gold</a></li>
                            <li><a href="cash-on-silver/">Cash on Silver</a></li>
                            <li><a href="cash-on-diamond/">Cash on Diamond</a></li>
                            <li><a href="gold-bailout-valuation/">Gold Bailout</a></li>
                        </ul>
                    </li>
                    <li><a href="contact/">Contact Us</a></li>
                </ul>
            </nav>

            <a href="contact/" class="btn btn-red header-cta" style="padding: 10px 25px; font-size: 0.8rem;">Enquire
                Now</a>

            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>