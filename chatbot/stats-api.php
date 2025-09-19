<?php
/**
 * Statistics API for Mishra Interior
 * Simple API endpoints for managing statistics
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'config.php';
require_once 'statistics-tracker.php';

// Simple API key authentication (you should change this)
$apiKey = 'mishra_interior_2025';

// Check API key
if (!isset($_GET['key']) || $_GET['key'] !== $apiKey) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid API key']);
    exit;
}

$tracker = new StatisticsTracker();

// Handle different actions
$action = $_GET['action'] ?? 'get';

switch ($action) {
    case 'get':
        // Get current statistics
        $stats = $tracker->getCurrentStats();
        echo json_encode([
            'success' => true,
            'data' => $stats,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        break;
        
    case 'increment':
        // Increment a specific statistic
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['stat']) || !isset($input['amount'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters: stat, amount']);
            break;
        }
        
        $statName = $input['stat'];
        $amount = intval($input['amount']);
        
        $oldStats = $tracker->getCurrentStats();
        $newStats = $tracker->incrementStat($statName, $amount);
        
        if ($newStats) {
            $tracker->logStatsChange($oldStats, $newStats, "API increment: $statName by $amount");
            echo json_encode([
                'success' => true,
                'message' => "Incremented $statName by $amount",
                'old_value' => $oldStats[$statName],
                'new_value' => $newStats[$statName],
                'data' => $newStats
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid stat name']);
        }
        break;
        
    case 'update':
        // Update statistics
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        $oldStats = $tracker->getCurrentStats();
        $newStats = $tracker->updateStats($input);
        $tracker->logStatsChange($oldStats, $newStats, 'API update');
        
        echo json_encode([
            'success' => true,
            'message' => 'Statistics updated successfully',
            'data' => $newStats
        ]);
        break;
        
    case 'report':
        // Get detailed report
        $report = $tracker->generateStatsReport();
        echo json_encode([
            'success' => true,
            'data' => $report
        ]);
        break;
        
    case 'history':
        // Get statistics history
        $history = $tracker->getStatsHistory();
        echo json_encode([
            'success' => true,
            'data' => $history
        ]);
        break;
        
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
}

// Log API usage
logMessage('INFO', 'Statistics API accessed', [
    'action' => $action,
    'method' => $_SERVER['REQUEST_METHOD'],
    'ip' => $_SERVER['REMOTE_ADDR']
]);
?>
