<?php
// Quick script to update statistics and see immediate changes
require_once 'chatbot/config.php';
require_once 'chatbot/statistics-tracker.php';

echo "<h1>🔄 Updating Statistics</h1>";

$tracker = new StatisticsTracker();

// Get current stats
$currentStats = $tracker->getCurrentStats();
echo "<p><strong>Current Statistics:</strong></p>";
echo "<ul>";
echo "<li>Clients: " . $currentStats['clients'] . "</li>";
echo "<li>Projects: " . $currentStats['projects'] . "</li>";
echo "<li>Likes: " . $currentStats['likes'] . "</li>";
echo "<li>Reviews: " . $currentStats['reviews'] . "</li>";
echo "</ul>";

// Update statistics to new values
$newStats = [
    'clients' => 250,
    'projects' => 300,
    'likes' => 700,
    'reviews' => 750
];

echo "<h2>📈 Updating to New Values:</h2>";
echo "<ul>";
echo "<li>Clients: " . $currentStats['clients'] . " → " . $newStats['clients'] . "</li>";
echo "<li>Projects: " . $currentStats['projects'] . " → " . $newStats['projects'] . "</li>";
echo "<li>Likes: " . $currentStats['likes'] . " → " . $newStats['likes'] . "</li>";
echo "<li>Reviews: " . $currentStats['reviews'] . " → " . $newStats['reviews'] . "</li>";
echo "</ul>";

// Update the statistics
$updatedStats = $tracker->updateStats($newStats);
$tracker->logStatsChange($currentStats, $updatedStats, 'Quick update for testing');

echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>✅ Statistics Updated Successfully!</h3>";
echo "<p>Your website should now show the new numbers. If you still see old numbers:</p>";
echo "<ol>";
echo "<li>Clear your browser cache (Ctrl + F5)</li>";
echo "<li>Wait a few seconds for the page to fully load</li>";
echo "<li>Check the debug page: <a href='debug-index.php'>debug-index.php</a></li>";
echo "</ol>";
echo "</div>";

echo "<h2>🔗 Quick Links:</h2>";
echo "<p>";
echo "<a href='index.php' style='background: #d58512; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;'>🏠 Main Website</a>";
echo "<a href='debug-index.php' style='background: #17a2b8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;'>🔍 Debug Page</a>";
echo "<a href='chatbot/stats-manager.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;'>📊 Stats Manager</a>";
echo "</p>";

echo "<h2>📊 Updated Statistics:</h2>";
echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin: 20px 0;'>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; border-left: 4px solid #d58512;'>";
echo "<div style='font-size: 2em; font-weight: bold; color: #d58512;'>" . $updatedStats['clients'] . "</div>";
echo "<div>Clients</div>";
echo "</div>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; border-left: 4px solid #d58512;'>";
echo "<div style='font-size: 2em; font-weight: bold; color: #d58512;'>" . $updatedStats['projects'] . "</div>";
echo "<div>Projects</div>";
echo "</div>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; border-left: 4px solid #d58512;'>";
echo "<div style='font-size: 2em; font-weight: bold; color: #d58512;'>" . $updatedStats['likes'] . "</div>";
echo "<div>Likes</div>";
echo "</div>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; border-left: 4px solid #d58512;'>";
echo "<div style='font-size: 2em; font-weight: bold; color: #d58512;'>" . $updatedStats['reviews'] . "</div>";
echo "<div>Reviews</div>";
echo "</div>";
echo "</div>";
?>
