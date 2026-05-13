<?php
$filePath = 'C:\xampp\htdocs\Gold Pe Cash\live_about.html';
$content = file_get_contents($filePath);

// Look for the duplicate g)}},!1)</script> before the <script data-no-minify
$badString = 'g)}},!1)</script><script data-no-minify="1"';
$goodString = '<script data-no-minify="1"';

if (strpos($content, $badString) !== false) {
    echo "Found corrupted string! Fixing...\n";
    $content = str_replace($badString, $goodString, $content);
    file_put_contents($filePath, $content);
    echo "Success: File fixed.\n";
} else {
    echo "Error: Corrupted string not found.\n";
    // Let's try to find a part of it
    if (strpos($content, 'g)}},!1)</script>') !== false) {
        echo "Found partial corrupted string. Fixing...\n";
        $content = str_replace('g)}},!1)</script><script d', '<script d', $content);
        file_put_contents($filePath, $content);
        echo "Success: File fixed via partial match.\n";
    }
}
?>
