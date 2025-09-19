<?php
// Simple test file for the chatbot API
require_once 'config.php';
require_once 'ai-enhancement.php';

echo "<h1>Mishra Interior Chatbot Test</h1>";

// Test the AI Enhancement class
$aiEnhancement = new AIEnhancement('local');

$testMessages = [
    "Hello",
    "What services do you offer?",
    "What are your prices?",
    "How can I contact you?",
    "What are your business hours?",
    "Do you have a portfolio?",
    "What materials do you use?",
    "Tell me about wooden flooring",
    "I need help with wallpaper"
];

echo "<h2>Testing Chatbot Responses</h2>";

foreach ($testMessages as $message) {
    echo "<div style='border: 1px solid #ddd; margin: 10px 0; padding: 10px;'>";
    echo "<strong>User:</strong> " . htmlspecialchars($message) . "<br>";
    
    try {
        $response = $aiEnhancement->generateEnhancedResponse($message);
        echo "<strong>Bot:</strong><br>";
        if (is_array($response)) {
            foreach ($response as $line) {
                echo htmlspecialchars($line) . "<br>";
            }
        } else {
            echo htmlspecialchars($response);
        }
    } catch (Exception $e) {
        echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage());
    }
    
    echo "</div>";
}

// Test AI Enhancement
echo "<h2>Testing AI Enhancement</h2>";

$testMessage = "I want to renovate my living room";
$intent = $aiEnhancement->analyzeIntent($testMessage);
echo "<p><strong>Message:</strong> " . htmlspecialchars($testMessage) . "</p>";
echo "<p><strong>Detected Intent:</strong> " . htmlspecialchars($intent) . "</p>";

$suggestions = $aiEnhancement->generateSuggestions($intent);
echo "<p><strong>Suggestions:</strong></p><ul>";
foreach ($suggestions as $suggestion) {
    echo "<li>" . htmlspecialchars($suggestion) . "</li>";
}
echo "</ul>";

// Test configuration
echo "<h2>Configuration Test</h2>";
$config = getConfig();
echo "<p><strong>Company Name:</strong> " . COMPANY_NAME . "</p>";
echo "<p><strong>Company Phone:</strong> " . COMPANY_PHONE . "</p>";
echo "<p><strong>AI Service:</strong> " . AI_SERVICE . "</p>";
echo "<p><strong>Services Count:</strong> " . count($config['services']) . "</p>";
echo "<p><strong>Team Members:</strong> " . count($config['team_members']) . "</p>";

// Test logging
echo "<h2>Logging Test</h2>";
logMessage('INFO', 'Test log message', ['test' => true]);
echo "<p>Test log message written to: " . LOG_FILE . "</p>";

echo "<h2>Test Complete!</h2>";
echo "<p>If you see this page without errors, the chatbot is working correctly.</p>";
echo "<p><a href='../index.php'>Go to main website</a> | <a href='admin.php'>Admin Panel</a></p>";
?>
