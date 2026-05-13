<?php
$file = __DIR__ . '/gold.php';
$content = file_get_contents($file);
$marker = "include 'includes/footer.php'; ?>";
// Get the FIRST occurrence
$pos = strpos($content, $marker);
if ($pos !== false) {
    $newContent = substr($content, 0, $pos + strlen($marker)) . "\n";
    file_put_contents($file, $newContent);
    echo "<p style='font-family:monospace;padding:20px;'>Done! File cleaned. Lines: " . count(file($file)) . "</p>";
} else {
    echo "<p>Marker not found!</p>";
}
?>