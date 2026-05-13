<?php
/**
 * route.php — URL Slug Router
 * Handles custom slugs stored in DB: /cash-on-gold → gold.php
 */
include 'includes/db.php';
include 'includes/functions.php';

$S = getAllSettings();

// Map: slug_value => actual_php_file
$slugMap = [
    'home' => 'index.php',
    'about-us' => 'about.php',
    'services' => 'services.php',
    'cash-on-gold' => 'gold.php',
    'cash-on-silver' => 'silver.php',
    'cash-on-diamond' => 'diamond.php',
    'gold-bailout' => 'gold-bailout.php',
    'contact-us' => 'contact.php',
    'today-gold-rate-in-ranchi' => 'today-gold-rate-in-ranchi.php',
];

// Get the requested slug from URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$slug = trim(str_replace('/Gold Pe Cash/', '', $requestUri), '/');
$slug = strtolower($slug);

// Dynamic slugs from DB override defaults
$dbSlugMap = [
    s($S, 'slug_home', 'home') => 'index.php',
    s($S, 'slug_about', 'about-us') => 'about.php',
    s($S, 'slug_services', 'services') => 'services.php',
    s($S, 'slug_gold', 'cash-on-gold') => 'gold.php',
    s($S, 'slug_silver', 'cash-on-silver') => 'silver.php',
    s($S, 'slug_diamond', 'cash-on-diamond') => 'diamond.php',
    s($S, 'slug_bailout', 'gold-bailout') => 'gold-bailout.php',
    s($S, 'slug_contact', 'contact-us') => 'contact.php',
];

$target = $dbSlugMap[$slug] ?? $slugMap[$slug] ?? null;

if ($target && file_exists($target)) {
    include $target;
} else {
    http_response_code(404);
    include 'index.php';
}
?>