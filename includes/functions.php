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
    $settings = [];
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
            while ($row = $stmt->fetch()) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        } catch (PDOException $e) {
            // keep $settings empty
        }
    }
    
    // Fallback/Default addresses
    $defaultAddresses = [
        'address1' => 'Kishor Ganj, Harmu Road, beside Premsons Honda Showroom, Ranchi, 834001',
        'address2' => 'Opposite Health Point Hospital, Indraprastha Colony, Sarhul Nagar, Ranchi, Jharkhand – 834009',
        'address3' => 'Ratu Road, Near Mall of Ranchi, Ranchi 834001',
        'address4' => 'Piska More Chowk, Beside Gurdwara, Ranchi, Jharkhand 835102',
        'address5' => 'Kanta toli Chowk, Beside BOI and SBI ATM, Ranchi, Jharkhand 834001',
        'address6' => 'Ground floor, beside Lakshmi Narsing Home, Kilburn Colony, Shukla Colony, Ranchi, Jharkhand 834002',
        'address7' => 'Ashok Nagar Rd, beside Ashok Vihar, near Canara bank, Ashok Kunj, Kadru, Ranchi, Jharkhand 834002'
    ];
    
    foreach ($defaultAddresses as $k => $v) {
        if (!isset($settings[$k]) || trim($settings[$k]) === '') {
            $settings[$k] = $v;
        }
    }
    
    return $settings;
}

/**
 * Shorthand to get a setting with a fallback default.
 */
function s($settings, $key, $default = '')
{
    return isset($settings[$key]) && $settings[$key] !== '' ? $settings[$key] : $default;
}
?>