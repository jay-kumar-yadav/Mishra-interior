<?php
// Statistics Manager for Mishra Interior
require_once 'config.php';
require_once 'statistics-tracker.php';

$tracker = new StatisticsTracker();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_stats'])) {
    $newStats = [
        'clients' => intval($_POST['clients']),
        'projects' => intval($_POST['projects']),
        'likes' => intval($_POST['likes']),
        'reviews' => intval($_POST['reviews'])
    ];
    
    $oldStats = $tracker->getCurrentStats();
    $updatedStats = $tracker->updateStats($newStats);
    $tracker->logStatsChange($oldStats, $updatedStats, 'Manual update via admin panel');
    $successMessage = "Statistics updated successfully!";
}

// Handle increment actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['increment'])) {
    $statName = $_POST['stat_name'];
    $amount = intval($_POST['amount']);
    
    $oldStats = $tracker->getCurrentStats();
    $updatedStats = $tracker->incrementStat($statName, $amount);
    $tracker->logStatsChange($oldStats, $updatedStats, "Incremented $statName by $amount");
    $successMessage = "Statistics incremented successfully!";
}

// Get current statistics and report
$currentStats = $tracker->getCurrentStats();
$report = $tracker->generateStatsReport();
$history = $tracker->getStatsHistory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Manager - Mishra Interior</title>
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #d58512;
        }
        .header h1 {
            color: #d58512;
            margin: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: #d58512;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #d58512;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #d58512;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        .stat-growth {
            color: #28a745;
            font-size: 12px;
            font-weight: bold;
            margin-top: 5px;
        }
        .stat-growth.negative {
            color: #dc3545;
        }
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin: 20px 0;
        }
        .quick-btn {
            background: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        .quick-btn:hover {
            background: #218838;
        }
        .quick-btn.secondary {
            background: #6c757d;
        }
        .quick-btn.secondary:hover {
            background: #5a6268;
        }
        .btn {
            background: #d58512;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
            width: 100%;
        }
        .btn:hover {
            background: #b8730f;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #d58512;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .info-box {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #2c5aa0;
        }
        .info-box h3 {
            margin-top: 0;
            color: #2c5aa0;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../index.php" class="back-link">← Back to Website</a>
        
        <div class="header">
            <h1>📊 Statistics Manager</h1>
            <p>Update your company statistics displayed on the website</p>
        </div>
        
        <?php if (isset($successMessage)): ?>
            <div class="success-message">
                ✅ <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <div class="info-box">
            <h3>ℹ️ Current Statistics</h3>
            <p>These numbers are displayed in the "Fun Facts" section of your website. Update them to reflect your current achievements.</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $currentStats['clients']; ?></div>
                <div class="stat-label">Clients</div>
                <div class="stat-growth"><?php echo $report['growth']['clients_growth'] >= 0 ? '+' : ''; ?><?php echo $report['growth']['clients_growth']; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $currentStats['projects']; ?></div>
                <div class="stat-label">Projects</div>
                <div class="stat-growth"><?php echo $report['growth']['projects_growth'] >= 0 ? '+' : ''; ?><?php echo $report['growth']['projects_growth']; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $currentStats['likes']; ?></div>
                <div class="stat-label">Likes</div>
                <div class="stat-growth"><?php echo $report['growth']['likes_growth'] >= 0 ? '+' : ''; ?><?php echo $report['growth']['likes_growth']; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $currentStats['reviews']; ?></div>
                <div class="stat-label">Reviews</div>
                <div class="stat-growth"><?php echo $report['growth']['reviews_growth'] >= 0 ? '+' : ''; ?><?php echo $report['growth']['reviews_growth']; ?></div>
            </div>
        </div>
        
        <div class="info-box">
            <h3>📈 Growth Summary</h3>
            <p><strong>Last Updated:</strong> <?php echo $currentStats['last_updated']; ?></p>
            <p><strong>Total Changes:</strong> <?php echo $report['total_changes']; ?></p>
            <p><strong>Auto Increments:</strong> 
                Clients: <?php echo $currentStats['auto_increment']['clients']; ?>, 
                Projects: <?php echo $currentStats['auto_increment']['projects']; ?>, 
                Likes: <?php echo $currentStats['auto_increment']['likes']; ?>, 
                Reviews: <?php echo $currentStats['auto_increment']['reviews']; ?>
            </p>
        </div>
        
        <form method="POST">
            <h3>Update Statistics</h3>
            
            <div class="form-group">
                <label for="clients">Number of Clients:</label>
                <input type="number" id="clients" name="clients" value="<?php echo $currentStats['clients']; ?>" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="projects">Number of Projects:</label>
                <input type="number" id="projects" name="projects" value="<?php echo $currentStats['projects']; ?>" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="likes">Number of Likes:</label>
                <input type="number" id="likes" name="likes" value="<?php echo $currentStats['likes']; ?>" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="reviews">Number of Reviews:</label>
                <input type="number" id="reviews" name="reviews" value="<?php echo $currentStats['reviews']; ?>" min="0" required>
            </div>
            
            <button type="submit" name="update_stats" class="btn">Update Statistics</button>
        </form>
        
        <div class="info-box">
            <h3>⚡ Quick Actions</h3>
            <p>Quickly increment statistics when you complete new projects or get new clients.</p>
            
            <div class="quick-actions">
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="stat_name" value="clients">
                    <input type="hidden" name="amount" value="1">
                    <button type="submit" name="increment" class="quick-btn">+1 Client</button>
                </form>
                
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="stat_name" value="projects">
                    <input type="hidden" name="amount" value="1">
                    <button type="submit" name="increment" class="quick-btn">+1 Project</button>
                </form>
                
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="stat_name" value="likes">
                    <input type="hidden" name="amount" value="5">
                    <button type="submit" name="increment" class="quick-btn">+5 Likes</button>
                </form>
                
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="stat_name" value="reviews">
                    <input type="hidden" name="amount" value="1">
                    <button type="submit" name="increment" class="quick-btn">+1 Review</button>
                </form>
            </div>
        </div>
        
        <div class="info-box">
            <h3>💡 Tips</h3>
            <ul>
                <li>Update these numbers regularly to reflect your growing business</li>
                <li>Use real data from your customer database and project records</li>
                <li>Consider adding new statistics like "Years of Experience" or "Team Members"</li>
                <li>These numbers help build trust and credibility with potential customers</li>
            </ul>
        </div>
    </div>
</body>
</html>
