<?php
echo "Testing Statistics System...\n\n";

// Test 1: Check if config file exists
echo "1. Config file exists: ";
if (file_exists('chatbot/config.php')) {
    echo "YES\n";
} else {
    echo "NO - This is the problem!\n";
    exit;
}

// Test 2: Include config
echo "2. Including config: ";
try {
    require_once 'chatbot/config.php';
    echo "SUCCESS\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit;
}

// Test 3: Get stats
echo "3. Getting stats: ";
try {
    $stats = getConfig('company_stats');
    if ($stats) {
        echo "SUCCESS\n";
        echo "Current statistics:\n";
        echo "- Clients: " . $stats['clients'] . "\n";
        echo "- Projects: " . $stats['projects'] . "\n";
        echo "- Likes: " . $stats['likes'] . "\n";
        echo "- Reviews: " . $stats['reviews'] . "\n";
    } else {
        echo "NO STATS RETURNED\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

// Test 4: Check if statistics tracker works
echo "\n4. Testing statistics tracker: ";
try {
    require_once 'chatbot/statistics-tracker.php';
    $tracker = new StatisticsTracker();
    $currentStats = $tracker->getCurrentStats();
    if ($currentStats) {
        echo "SUCCESS\n";
        echo "Tracker stats:\n";
        echo "- Clients: " . $currentStats['clients'] . "\n";
        echo "- Projects: " . $currentStats['projects'] . "\n";
        echo "- Likes: " . $currentStats['likes'] . "\n";
        echo "- Reviews: " . $currentStats['reviews'] . "\n";
    } else {
        echo "NO STATS FROM TRACKER\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

echo "\n✅ Test complete! If you see the statistics above, the system is working.\n";
echo "If you're still seeing dummy data on the website, try:\n";
echo "1. Clear your browser cache (Ctrl+F5)\n";
echo "2. Check if there are any JavaScript errors in browser console\n";
echo "3. Visit debug-index.php to see detailed debug information\n";
?>
