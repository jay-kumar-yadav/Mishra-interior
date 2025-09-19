<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Statistics - Mishra Interior</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .test-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .stat-display {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid #d58512;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #d58512;
        }
        .test-btn {
            background: #d58512;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .test-btn:hover {
            background: #b8730f;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="test-container">
        <h1>🧪 Statistics Test Page</h1>
        <p>This page will help you test if the dynamic statistics are working correctly.</p>
        
        <?php
        try {
            // Test 1: Load configuration
            echo "<h2>Test 1: Loading Configuration</h2>";
            require_once 'chatbot/config.php';
            $stats = getConfig('company_stats');
            
            if ($stats) {
                echo "<div class='success'>✅ Configuration loaded successfully!</div>";
                echo "<pre>" . print_r($stats, true) . "</pre>";
            } else {
                echo "<div class='error'>❌ Failed to load configuration</div>";
            }
            
            // Test 2: Test statistics tracker
            echo "<h2>Test 2: Statistics Tracker</h2>";
            require_once 'chatbot/statistics-tracker.php';
            $tracker = new StatisticsTracker();
            $currentStats = $tracker->getCurrentStats();
            
            if ($currentStats) {
                echo "<div class='success'>✅ Statistics tracker working!</div>";
                echo "<pre>" . print_r($currentStats, true) . "</pre>";
            } else {
                echo "<div class='error'>❌ Statistics tracker failed</div>";
            }
            
            // Test 3: Display current statistics
            echo "<h2>Test 3: Current Statistics Display</h2>";
            echo "<div class='stat-display'>";
            echo "<h3>Current Statistics (as they appear on your website):</h3>";
            echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin: 20px 0;'>";
            echo "<div><div class='stat-number'>" . $currentStats['clients'] . "</div><div>Clients</div></div>";
            echo "<div><div class='stat-number'>" . $currentStats['projects'] . "</div><div>Projects</div></div>";
            echo "<div><div class='stat-number'>" . $currentStats['likes'] . "</div><div>Likes</div></div>";
            echo "<div><div class='stat-number'>" . $currentStats['reviews'] . "</div><div>Reviews</div></div>";
            echo "</div>";
            echo "</div>";
            
            // Test 4: Test increment
            echo "<h2>Test 4: Test Increment Function</h2>";
            if (isset($_POST['test_increment'])) {
                $oldValue = $currentStats['clients'];
                $newStats = $tracker->incrementStat('clients', 1);
                if ($newStats) {
                    echo "<div class='success'>✅ Increment test successful! Clients: $oldValue → " . $newStats['clients'] . "</div>";
                } else {
                    echo "<div class='error'>❌ Increment test failed</div>";
                }
            }
            
            echo "<form method='POST'>";
            echo "<button type='submit' name='test_increment' class='test-btn'>Test Increment Clients (+1)</button>";
            echo "</form>";
            
            // Test 5: Show what should appear in index.php
            echo "<h2>Test 5: Code for index.php</h2>";
            echo "<p>This is the exact code that should be working in your index.php:</p>";
            echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
            echo htmlspecialchars('<?php
// Include chatbot configuration to get real statistics
require_once \'chatbot/config.php\';
$stats = getConfig(\'company_stats\');
?>
<!-- Then in your HTML: -->
<div class="count-number padTB40" data-count="' . $currentStats['clients'] . '">
    <h2><span class="counter">' . $currentStats['clients'] . '</span></h2>
</div>');
            echo "</pre>";
            
        } catch (Exception $e) {
            echo "<div class='error'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        ?>
        
        <h2>🔧 How to Fix if Still Showing Dummy Data:</h2>
        <ol>
            <li><strong>Clear Browser Cache:</strong> Press Ctrl+F5 to hard refresh the page</li>
            <li><strong>Check File Paths:</strong> Make sure the chatbot folder is in the correct location</li>
            <li><strong>Check PHP Errors:</strong> Look at your server error logs</li>
            <li><strong>Test Direct Access:</strong> Visit <a href="chatbot/stats-manager.php">chatbot/stats-manager.php</a></li>
        </ol>
        
        <h2>📊 Quick Actions:</h2>
        <p>
            <a href="chatbot/stats-manager.php" class="test-btn">📈 Statistics Manager</a>
            <a href="index.php" class="test-btn">🏠 Main Website</a>
            <a href="chatbot/admin.php" class="test-btn">⚙️ Admin Panel</a>
        </p>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
