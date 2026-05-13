<?php
$files = ['contact.php'];

$replacements = [
    'href="about.php"' => 'href="about-us/"',
    'href="contact.php"' => 'href="contact/"',
    'href="contact.php?' => 'href="contact/?',
    'href="services.php"' => 'href="gold-pe-cash-services/"',
    'href="services.php?' => 'href="gold-pe-cash-services/?',
    'href="gold.php"' => 'href="cash-on-gold/"',
    'href="silver.php"' => 'href="cash-on-silver/"',
    'href="diamond.php"' => 'href="cash-on-diamond/"',
    'href="gold-bailout.php"' => 'href="gold-bailout-valuation/"'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        file_put_contents($file, $content);
        echo "Updated $file\n";
    }
}
echo "Routing URLs successfully rewritten.";
?>