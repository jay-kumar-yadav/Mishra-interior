<?php
/**
 * Statistics Tracker for Mishra Interior
 * This system can track real statistics from various sources
 */

class StatisticsTracker {
    private $config;
    private $statsFile;
    
    public function __construct() {
        $this->config = getConfig();
        $this->statsFile = 'chatbot/logs/statistics.json';
        $this->ensureStatsFile();
    }
    
    private function ensureStatsFile() {
        if (!file_exists($this->statsFile)) {
            $defaultStats = [
                'clients' => 207,
                'projects' => 285,
                'likes' => 654,
                'reviews' => 714,
                'last_updated' => date('Y-m-d H:i:s'),
                'auto_increment' => [
                    'clients' => 0,
                    'projects' => 0,
                    'likes' => 0,
                    'reviews' => 0
                ]
            ];
            file_put_contents($this->statsFile, json_encode($defaultStats, JSON_PRETTY_PRINT));
        }
    }
    
    public function getCurrentStats() {
        $stats = json_decode(file_get_contents($this->statsFile), true);
        return $stats;
    }
    
    public function updateStats($newStats) {
        $currentStats = $this->getCurrentStats();
        
        foreach ($newStats as $key => $value) {
            if (isset($currentStats[$key])) {
                $currentStats[$key] = intval($value);
            }
        }
        
        $currentStats['last_updated'] = date('Y-m-d H:i:s');
        
        file_put_contents($this->statsFile, json_encode($currentStats, JSON_PRETTY_PRINT));
        
        // Update the config file as well
        $this->updateConfigFile($currentStats);
        
        return $currentStats;
    }
    
    private function updateConfigFile($stats) {
        $configFile = __DIR__ . '/config.php';
        $content = file_get_contents($configFile);
        
        // Replace the statistics array
        $oldStatsPattern = '/\$COMPANY_STATS = \[([\s\S]*?)\];/';
        $newStatsString = '$COMPANY_STATS = [' . PHP_EOL;
        $newStatsString .= "    'clients' => {$stats['clients']}," . PHP_EOL;
        $newStatsString .= "    'projects' => {$stats['projects']}," . PHP_EOL;
        $newStatsString .= "    'likes' => {$stats['likes']}," . PHP_EOL;
        $newStatsString .= "    'reviews' => {$stats['reviews']}" . PHP_EOL;
        $newStatsString .= '];';
        
        $content = preg_replace($oldStatsPattern, $newStatsString, $content);
        file_put_contents($configFile, $content);
    }
    
    public function incrementStat($statName, $amount = 1) {
        $stats = $this->getCurrentStats();
        
        if (isset($stats[$statName])) {
            $stats[$statName] += $amount;
            $stats['auto_increment'][$statName] += $amount;
            $stats['last_updated'] = date('Y-m-d H:i:s');
            
            file_put_contents($this->statsFile, json_encode($stats, JSON_PRETTY_PRINT));
            $this->updateConfigFile($stats);
            
            return $stats;
        }
        
        return false;
    }
    
    public function getStatsHistory() {
        $logFile = 'chatbot/logs/statistics_history.log';
        $history = [];
        
        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                $data = json_decode($line, true);
                if ($data) {
                    $history[] = $data;
                }
            }
        }
        
        return array_reverse($history);
    }
    
    public function logStatsChange($oldStats, $newStats, $reason = 'Manual update') {
        $logFile = 'chatbot/logs/statistics_history.log';
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'reason' => $reason,
            'old_stats' => $oldStats,
            'new_stats' => $newStats,
            'changes' => []
        ];
        
        foreach ($newStats as $key => $value) {
            if (isset($oldStats[$key]) && $oldStats[$key] != $value) {
                $logEntry['changes'][$key] = [
                    'old' => $oldStats[$key],
                    'new' => $value,
                    'difference' => $value - $oldStats[$key]
                ];
            }
        }
        
        file_put_contents($logFile, json_encode($logEntry) . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
    
    public function getStatsGrowth() {
        $history = $this->getStatsHistory();
        $currentStats = $this->getCurrentStats();
        
        if (empty($history)) {
            return [
                'clients_growth' => 0,
                'projects_growth' => 0,
                'likes_growth' => 0,
                'reviews_growth' => 0
            ];
        }
        
        $oldestStats = $history[count($history) - 1]['new_stats'];
        
        return [
            'clients_growth' => $currentStats['clients'] - $oldestStats['clients'],
            'projects_growth' => $currentStats['projects'] - $oldestStats['projects'],
            'likes_growth' => $currentStats['likes'] - $oldestStats['likes'],
            'reviews_growth' => $currentStats['reviews'] - $oldestStats['reviews']
        ];
    }
    
    public function generateStatsReport() {
        $currentStats = $this->getCurrentStats();
        $growth = $this->getStatsGrowth();
        $history = $this->getStatsHistory();
        
        return [
            'current' => $currentStats,
            'growth' => $growth,
            'total_changes' => count($history),
            'last_updated' => $currentStats['last_updated'],
            'auto_increments' => $currentStats['auto_increment']
        ];
    }
}

// API endpoint for statistics
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    
    $tracker = new StatisticsTracker();
    
    switch ($_GET['action']) {
        case 'get':
            echo json_encode($tracker->getCurrentStats());
            break;
            
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $oldStats = $tracker->getCurrentStats();
                $newStats = $tracker->updateStats($input);
                $tracker->logStatsChange($oldStats, $newStats, 'API update');
                echo json_encode(['success' => true, 'stats' => $newStats]);
            }
            break;
            
        case 'increment':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $statName = $input['stat'];
                $amount = isset($input['amount']) ? intval($input['amount']) : 1;
                $oldStats = $tracker->getCurrentStats();
                $newStats = $tracker->incrementStat($statName, $amount);
                if ($newStats) {
                    $tracker->logStatsChange($oldStats, $newStats, "Incremented $statName by $amount");
                    echo json_encode(['success' => true, 'stats' => $newStats]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Invalid stat name']);
                }
            }
            break;
            
        case 'report':
            echo json_encode($tracker->generateStatsReport());
            break;
            
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
    exit;
}
?>
