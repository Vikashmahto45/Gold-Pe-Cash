<?php
// includes/functions.php

/**
 * Get a single setting value from the database.
 */
function getSetting($key)
{
    global $pdo;
    if (!$pdo)
        return null;
    try {
        $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch();
        return $result ? $result['setting_value'] : null;
    } catch (PDOException $e) {
        return null;
    }
}

/**
 * Load all settings into an associative array (key => value).
 * Call once per page load for efficiency.
 */
function getAllSettings()
{
    global $pdo;
    if (!$pdo)
        return [];
    try {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
        $settings = [];
        while ($row = $stmt->fetch()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Shorthand to get a setting with a fallback default.
 */
function s($settings, $key, $default = '')
{
    return isset($settings[$key]) && $settings[$key] !== '' ? $settings[$key] : $default;
}
?>