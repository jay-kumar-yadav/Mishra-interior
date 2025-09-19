<?php
// Test statistics system
require_once 'config.php';
require_once 'statistics-tracker.php';

echo "<h1>Statistics System Test</h1>";

try {
    $tracker = new StatisticsTracker();
    $stats = $tracker->getCurrentStats();
    
    echo "<h2>Current Statistics:</h2>";
    echo "<pre>" . json_encode($stats, JSON_PRETTY_PRINT) . "</pre>";
    
    echo "<h2>Test Increment:</h2>";
    $oldStats = $tracker->getCurrentStats();
    $newStats = $tracker->incrementStat('clients', 1);
    
    if ($newStats) {
        echo "<p>✅ Successfully incremented clients: {$oldStats['clients']} → {$newStats['clients']}</p>";
    } else {
        echo "<p>❌ Failed to increment clients</p>";
    }
    
    echo "<h2>Statistics Report:</h2>";
    $report = $tracker->generateStatsReport();
    echo "<pre>" . json_encode($report, JSON_PRETTY_PRINT) . "</pre>";
    
    echo "<h2>✅ Statistics System Working!</h2>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
