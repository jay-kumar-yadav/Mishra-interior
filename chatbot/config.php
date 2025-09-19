<?php
/**
 * Chatbot Configuration File
 * Configure your chatbot settings here
 */

// Basic Configuration
define('CHATBOT_NAME', 'Mishra Interior Assistant');
define('CHATBOT_VERSION', '1.0.0');
define('CHATBOT_DEBUG', false);

// AI Service Configuration
define('AI_SERVICE', 'local'); // Options: 'local', 'openai', 'google'
define('OPENAI_API_KEY', ''); // Add your OpenAI API key here
define('GOOGLE_API_KEY', ''); // Add your Google AI API key here

// Company Information
define('COMPANY_NAME', 'Mishra Interior');
define('COMPANY_PHONE', '+919945623419');
define('COMPANY_EMAIL', 'rajeshkumar1975b@gmail.com');
define('COMPANY_WEBSITE', 'https://mishrainteriors.com');

// Team Information
$TEAM_MEMBERS = [
    'owner' => [
        'name' => 'Rajesh Kumar',
        'phone' => '+919945623419',
        'email' => 'rajeshkumar1975b@gmail.com',
        'role' => 'Owner'
    ],
    'managing_director' => [
        'name' => 'Ashwin Mishra',
        'phone' => '+919380735528',
        'email' => 'ashwinm8120@gmail.com',
        'role' => 'Managing Director'
    ],
    'marketing_director' => [
        'name' => 'Rashmi Mishra',
        'phone' => '+917353709447',
        'email' => 'rashmimishra1006@gmail.com',
        'role' => 'Marketing Director'
    ],
    'project_manager' => [
        'name' => 'Shambhu Sharma',
        'phone' => '+919632175490',
        'email' => 'shambhu@mishrainteriors.com',
        'role' => 'Project Manager'
    ]
];

// Services Information
$SERVICES = [
    'refurnishing' => [
        'name' => 'Refurnishing',
        'description' => 'Best Collection and exclusive designs of refurnishing items available here.',
        'icon' => 'fa-building-o'
    ],
    'sport_flooring' => [
        'name' => 'Sport Flooring',
        'description' => 'Best Collection and exclusive designs of sport flooring items are available here.',
        'icon' => 'fa-paw'
    ],
    'wall_painting' => [
        'name' => 'Wall Painting',
        'description' => 'We provide all types exclusive designs of wall painting for like houses, kitchen.',
        'icon' => 'fa-paint-brush'
    ],
    'wooden_flooring' => [
        'name' => 'Wooden Flooring',
        'description' => 'Best Collection and exclusive designs of Wooden Flooring item available here.',
        'icon' => 'fa-pagelines'
    ],
    'wallpaper' => [
        'name' => 'Wallpaper Installation',
        'description' => 'Premium wallpaper installation with various designs and patterns.',
        'icon' => 'fa-picture-o'
    ],
    'carpet' => [
        'name' => 'Carpet Installation',
        'description' => 'Quality carpet solutions for residential and commercial spaces.',
        'icon' => 'fa-square'
    ],
    'vinyl_flooring' => [
        'name' => 'Vinyl Flooring',
        'description' => 'Durable vinyl flooring options for all types of spaces.',
        'icon' => 'fa-th-large'
    ],
    'blinds' => [
        'name' => 'Blinds Installation',
        'description' => 'Window treatment solutions including blinds and curtains.',
        'icon' => 'fa-window-maximize'
    ]
];

// Business Hours
$BUSINESS_HOURS = [
    'monday' => '9:00 AM - 7:00 PM',
    'tuesday' => '9:00 AM - 7:00 PM',
    'wednesday' => '9:00 AM - 7:00 PM',
    'thursday' => '9:00 AM - 7:00 PM',
    'friday' => '9:00 AM - 7:00 PM',
    'saturday' => '9:00 AM - 7:00 PM',
    'sunday' => '10:00 AM - 5:00 PM'
];

// Statistics
$COMPANY_STATS = [
    'clients' => 207,
    'projects' => 285,
    'likes' => 654,
    'reviews' => 714
];

// Common Questions and Answers
$FAQ = [
    'What services do you offer?' => 'We offer refurnishing, sport flooring, wall painting, wooden flooring, wallpaper installation, carpet installation, vinyl flooring, and blinds installation.',
    'How can I contact you?' => 'You can contact us at +919945623419 (Rajesh Kumar - Owner) or email us at rajeshkumar1975b@gmail.com',
    'What are your business hours?' => 'We are open Monday to Saturday 9:00 AM - 7:00 PM and Sunday 10:00 AM - 5:00 PM',
    'Do you offer free consultations?' => 'Yes, we offer free consultations and site visits. Contact us to schedule an appointment.',
    'What materials do you use?' => 'We use only high-quality materials from trusted suppliers with warranties.',
    'How long does a project take?' => 'Project duration varies based on size and complexity. We provide detailed timelines during consultation.',
    'Do you provide warranties?' => 'Yes, we provide 2-year workmanship warranty and material warranties as per manufacturer.',
    'Can you work with my budget?' => 'Yes, we work with various budgets and can suggest alternatives to meet your requirements.'
];

// Response Templates
$RESPONSE_TEMPLATES = [
    'greeting' => [
        'Hello! Welcome to Mishra Interior. How can I help you today?',
        'Hi there! I\'m here to assist you with your interior design needs. What would you like to know?',
        'Welcome to Mishra Interior! I can help you with information about our services, pricing, and more.'
    ],
    'closing' => [
        'Thank you for contacting Mishra Interior! Feel free to reach out anytime.',
        'Is there anything else I can help you with today?',
        'Don\'t hesitate to contact us directly if you need more information!'
    ],
    'fallback' => [
        'I understand you\'re asking about: "{query}"',
        'While I can help with general information, for specific details please contact us directly.',
        'You can reach us at +919945623419 or email rajeshkumar1975b@gmail.com',
        'Is there anything else I can help you with about our interior design services?'
    ]
];

// Analytics Configuration
define('ENABLE_ANALYTICS', true);
define('SAVE_CONVERSATIONS', true);
define('MAX_CONVERSATION_LENGTH', 50);

// Database Configuration (if using database)
define('DB_HOST', 'localhost');
define('DB_NAME', 'mishra_chatbot');
define('DB_USER', 'root');
define('DB_PASS', '');

// Security Configuration
define('RATE_LIMIT_ENABLED', true);
define('MAX_REQUESTS_PER_MINUTE', 30);
define('BLOCKED_IPS', []);

// Feature Flags
define('ENABLE_TYPING_INDICATOR', true);
define('ENABLE_SUGGESTIONS', true);
define('ENABLE_FILE_UPLOAD', false);
define('ENABLE_VOICE_MESSAGES', false);

// Localization
define('DEFAULT_LANGUAGE', 'en');
define('SUPPORTED_LANGUAGES', ['en', 'hi']);

// Error Messages
$ERROR_MESSAGES = [
    'invalid_request' => 'Invalid request. Please try again.',
    'rate_limit_exceeded' => 'Too many requests. Please wait a moment and try again.',
    'service_unavailable' => 'Service temporarily unavailable. Please contact us directly.',
    'invalid_message' => 'Please enter a valid message.',
    'message_too_long' => 'Message is too long. Please keep it under 500 characters.'
];

// Success Messages
$SUCCESS_MESSAGES = [
    'message_sent' => 'Message sent successfully!',
    'consultation_scheduled' => 'Consultation scheduled successfully!',
    'quote_requested' => 'Quote request submitted successfully!'
];

// Logging Configuration
define('LOG_ENABLED', true);
define('LOG_LEVEL', 'INFO'); // DEBUG, INFO, WARNING, ERROR
define('LOG_FILE', 'chatbot/logs/chatbot.log');

// Create logs directory if it doesn't exist
if (!file_exists('chatbot/logs')) {
    mkdir('chatbot/logs', 0755, true);
}

// Helper function to get configuration
function getConfig($key = null) {
    global $TEAM_MEMBERS, $SERVICES, $BUSINESS_HOURS, $COMPANY_STATS, $FAQ, $RESPONSE_TEMPLATES, $ERROR_MESSAGES, $SUCCESS_MESSAGES;
    
    $config = [
        'team_members' => $TEAM_MEMBERS,
        'services' => $SERVICES,
        'business_hours' => $BUSINESS_HOURS,
        'company_stats' => $COMPANY_STATS,
        'faq' => $FAQ,
        'response_templates' => $RESPONSE_TEMPLATES,
        'error_messages' => $ERROR_MESSAGES,
        'success_messages' => $SUCCESS_MESSAGES
    ];
    
    if ($key && isset($config[$key])) {
        return $config[$key];
    }
    
    return $config;
}

// Helper function to log messages
function logMessage($level, $message, $context = []) {
    if (!LOG_ENABLED) return;
    
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] [$level] $message";
    
    if (!empty($context)) {
        $logEntry .= " " . json_encode($context);
    }
    
    $logEntry .= PHP_EOL;
    
    file_put_contents(LOG_FILE, $logEntry, FILE_APPEND | LOCK_EX);
}

// Helper function to get random response
function getRandomResponse($category) {
    $templates = getConfig('response_templates');
    
    if (isset($templates[$category])) {
        $responses = $templates[$category];
        return $responses[array_rand($responses)];
    }
    
    return 'I\'m here to help! How can I assist you today?';
}
?>
