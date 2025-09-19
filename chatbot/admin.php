<?php
// Simple admin panel for chatbot analytics
require_once 'config.php';

// Basic authentication (you should implement proper authentication)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    if (isset($_POST['password']) && $_POST['password'] === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Chatbot Admin Login</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f5f5f5; }
                .login-form { max-width: 300px; margin: 100px auto; background: white; padding: 20px; border-radius: 5px; }
                input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 3px; }
                button { width: 100%; padding: 10px; background: #d58512; color: white; border: none; border-radius: 3px; cursor: pointer; }
            </style>
        </head>
        <body>
            <div class="login-form">
                <h2>Chatbot Admin Login</h2>
                <form method="post">
                    <input type="password" name="password" placeholder="Enter password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Get log data
$logFile = LOG_FILE;
$logs = [];
if (file_exists($logFile)) {
    $logContent = file_get_contents($logFile);
    $logLines = array_reverse(array_filter(explode("\n", $logContent)));
    $logs = array_slice($logLines, 0, 100); // Last 100 entries
}

// Get rate limit data
$rateLimitFiles = glob('chatbot/logs/rate_limit_*.txt');
$rateLimitData = [];
foreach ($rateLimitFiles as $file) {
    $ip = str_replace(['chatbot/logs/rate_limit_', '.txt'], '', basename($file));
    $data = json_decode(file_get_contents($file), true);
    if ($data) {
        $rateLimitData[$ip] = array_sum($data);
    }
}

// Get conversation statistics
$conversationStats = [
    'total_messages' => 0,
    'unique_users' => count($rateLimitFiles),
    'today_messages' => 0,
    'common_intents' => []
];

foreach ($logs as $log) {
    if (strpos($log, 'User message received') !== false) {
        $conversationStats['total_messages']++;
        if (strpos($log, date('Y-m-d')) !== false) {
            $conversationStats['today_messages']++;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mishra Interior Chatbot Admin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5f5f5; }
        .header { background: #d58512; color: white; padding: 20px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .stat-number { font-size: 2em; font-weight: bold; color: #d58512; }
        .logs-section { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .log-entry { padding: 10px; border-bottom: 1px solid #eee; font-family: monospace; font-size: 12px; }
        .log-entry:last-child { border-bottom: none; }
        .log-info { color: #007bff; }
        .log-warning { color: #ffc107; }
        .log-error { color: #dc3545; }
        .logout { float: right; color: white; text-decoration: none; }
        .logout:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mishra Interior Chatbot Admin Panel</h1>
        <a href="?logout=1" class="logout">Logout</a>
    </div>
    
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $conversationStats['total_messages']; ?></div>
                <div>Total Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $conversationStats['today_messages']; ?></div>
                <div>Today's Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $conversationStats['unique_users']; ?></div>
                <div>Unique Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo count($rateLimitData); ?></div>
                <div>Active Sessions</div>
            </div>
        </div>
        
        <div class="logs-section">
            <h2>Recent Activity Logs</h2>
            <div style="max-height: 400px; overflow-y: auto;">
                <?php foreach ($logs as $log): ?>
                    <div class="log-entry <?php 
                        if (strpos($log, '[ERROR]') !== false) echo 'log-error';
                        elseif (strpos($log, '[WARNING]') !== false) echo 'log-warning';
                        else echo 'log-info';
                    ?>">
                        <?php echo htmlspecialchars($log); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="logs-section">
            <h2>Rate Limit Status</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="background: #f8f9fa;">
                    <th style="padding: 10px; border: 1px solid #ddd;">IP Address</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Requests</th>
                </tr>
                <?php foreach ($rateLimitData as $ip => $requests): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($ip); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $requests; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}
?>
