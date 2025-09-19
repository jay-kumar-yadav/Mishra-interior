<?php
// Include configuration and AI enhancement
require_once 'config.php';
require_once 'ai-enhancement.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Rate limiting
if (RATE_LIMIT_ENABLED) {
    $clientIP = $_SERVER['REMOTE_ADDR'];
    $rateLimitFile = 'chatbot/logs/rate_limit_' . md5($clientIP) . '.txt';
    
    if (file_exists($rateLimitFile)) {
        $requests = json_decode(file_get_contents($rateLimitFile), true);
        $currentMinute = floor(time() / 60);
        
        if (isset($requests[$currentMinute]) && $requests[$currentMinute] >= MAX_REQUESTS_PER_MINUTE) {
            http_response_code(429);
            echo json_encode(['error' => getConfig('error_messages')['rate_limit_exceeded']]);
            exit;
        }
        
        $requests[$currentMinute] = ($requests[$currentMinute] ?? 0) + 1;
    } else {
        $requests = [floor(time() / 60) => 1];
    }
    
    file_put_contents($rateLimitFile, json_encode($requests));
}

class ChatbotAPI {
    private $responses;
    private $aiEnhancement;
    private $config;
    
    public function __construct() {
        $this->config = getConfig();
        $this->aiEnhancement = new AIEnhancement(AI_SERVICE, OPENAI_API_KEY);
        $this->initializeResponses();
    }
    
    private function initializeResponses() {
        $this->responses = $this->config['response_templates'];
        
        // Add service-specific responses
        $this->responses['services'] = [
            'We offer several interior design services:',
            '• Refurnishing - Best collection and exclusive designs',
            '• Sport Flooring - High-quality sports flooring solutions',
            '• Wall Painting - All types of exclusive wall painting designs',
            '• Wooden Flooring - Premium wooden flooring options',
            '• Wallpaper Installation - Beautiful wallpaper designs',
            '• Carpet Installation - Quality carpet solutions',
            '• Vinyl Flooring - Durable vinyl flooring options',
            '• Blinds Installation - Window treatment solutions'
        ];
        
        $this->responses['pricing'] = [
            'Our pricing varies based on the project size and materials used.',
            'For accurate pricing, please contact us directly:',
            '• Email: ' . COMPANY_EMAIL,
            '• Phone: ' . COMPANY_PHONE,
            '• We offer free consultations and estimates!'
        ];
        
        $team = $this->config['team_members'];
        $this->responses['contact'] = [
            'You can reach us through:',
            '• Owner: ' . $team['owner']['name'] . ' - ' . $team['owner']['phone'],
            '• Managing Director: ' . $team['managing_director']['name'] . ' - ' . $team['managing_director']['phone'],
            '• Marketing Director: ' . $team['marketing_director']['name'] . ' - ' . $team['marketing_director']['phone'],
            '• Project Manager: ' . $team['project_manager']['name'] . ' - ' . $team['project_manager']['phone'],
            '• Email: ' . COMPANY_EMAIL,
            '• Visit our showroom for a personal consultation!'
        ];
        
        $this->responses['location'] = [
            'We are located in your area and serve customers locally.',
            'For our exact address and directions, please call us at ' . COMPANY_PHONE,
            'We also offer site visits and consultations at your location.'
        ];
        
        $businessHours = $this->config['business_hours'];
        $this->responses['timing'] = [
            'Our business hours are:',
            '• Monday to Saturday: ' . $businessHours['monday'],
            '• Sunday: ' . $businessHours['sunday'],
            '• We are closed on major holidays',
            '• Emergency services available on request'
        ];
        
        $stats = $this->config['company_stats'];
        $this->responses['portfolio'] = [
            'We have completed over ' . $stats['projects'] . ' projects with ' . $stats['clients'] . ' satisfied clients!',
            'You can view our work in the Projects section of our website.',
            'Our portfolio includes:',
            '• Residential interior design',
            '• Commercial spaces',
            '• Wooden flooring installations',
            '• Wall painting and wallpaper projects',
            '• Sport flooring for gyms and sports facilities'
        ];
        
        $this->responses['materials'] = [
            'We use only high-quality materials:',
            '• Premium wooden flooring from trusted suppliers',
            '• Durable wallpaper with various designs',
            '• High-grade paint for wall painting',
            '• Professional-grade sport flooring',
            '• Quality carpets and vinyl flooring',
            '• All materials come with warranties'
        ];
        
        $this->responses['process'] = [
            'Our design process:',
            '1. Initial consultation and site visit',
            '2. Design proposal and 3D visualization',
            '3. Material selection and approval',
            '4. Project timeline and cost estimation',
            '5. Installation and project completion',
            '6. Final inspection and handover'
        ];
        
        $this->responses['warranty'] = [
            'We provide comprehensive warranties:',
            '• Workmanship warranty: 2 years',
            '• Material warranty: As per manufacturer',
            '• Free maintenance for first 6 months',
            '• 24/7 customer support',
            '• Satisfaction guarantee on all projects'
        ];
        
        $this->responses['default'] = [
            'I understand you\'re asking about: "{query}"',
            'While I can help with general information about our services, for specific details please contact us directly.',
            'You can reach us at ' . COMPANY_PHONE . ' or email ' . COMPANY_EMAIL,
            'Is there anything else I can help you with about our interior design services?'
        ];
    }
    
    public function processMessage($message) {
        $originalMessage = $message;
        $message = strtolower(trim($message));
        
        // Log the incoming message
        logMessage('INFO', 'User message received', ['message' => $originalMessage]);
        
        // Analyze intent
        $intent = $this->aiEnhancement->analyzeIntent($message);
        
        // Try AI enhancement first if enabled
        if (AI_SERVICE !== 'local') {
            try {
                $aiResponse = $this->aiEnhancement->generateEnhancedResponse($originalMessage);
                if ($aiResponse && !empty($aiResponse)) {
                    logMessage('INFO', 'AI response generated', ['intent' => $intent]);
                    return $aiResponse;
                }
            } catch (Exception $e) {
                logMessage('ERROR', 'AI enhancement failed', ['error' => $e->getMessage()]);
            }
        }
        
        // Fallback to local responses
        // Check for greetings
        if (preg_match('/\b(hello|hi|hey|good morning|good afternoon|good evening)\b/', $message)) {
            return $this->getRandomResponse('greeting');
        }
        
        // Check for service-related queries
        if (preg_match('/\b(service|services|what do you do|what can you do|offer|provide)\b/', $message)) {
            return $this->getRandomResponse('services');
        }
        
        // Check for pricing queries
        if (preg_match('/\b(price|pricing|cost|how much|expensive|cheap|budget|quote|estimate)\b/', $message)) {
            return $this->getRandomResponse('pricing');
        }
        
        // Check for contact queries
        if (preg_match('/\b(contact|phone|email|address|location|where|reach|call)\b/', $message)) {
            return $this->getRandomResponse('contact');
        }
        
        // Check for location queries
        if (preg_match('/\b(location|address|where are you|directions|map)\b/', $message)) {
            return $this->getRandomResponse('location');
        }
        
        // Check for timing queries
        if (preg_match('/\b(time|timing|hours|open|closed|when|available)\b/', $message)) {
            return $this->getRandomResponse('timing');
        }
        
        // Check for portfolio queries
        if (preg_match('/\b(portfolio|work|projects|examples|gallery|show|previous|experience)\b/', $message)) {
            return $this->getRandomResponse('portfolio');
        }
        
        // Check for material queries
        if (preg_match('/\b(material|materials|quality|brand|supplier|wood|paint|wallpaper)\b/', $message)) {
            return $this->getRandomResponse('materials');
        }
        
        // Check for process queries
        if (preg_match('/\b(process|how|procedure|steps|workflow|timeline|duration)\b/', $message)) {
            return $this->getRandomResponse('process');
        }
        
        // Check for warranty queries
        if (preg_match('/\b(warranty|guarantee|maintenance|support|after|service)\b/', $message)) {
            return $this->getRandomResponse('warranty');
        }
        
        // Check for specific services
        if (preg_match('/\b(wallpaper|wall paper)\b/', $message)) {
            return [
                'We offer premium wallpaper installation services!',
                'Our wallpaper collection includes:',
                '• Modern and contemporary designs',
                '• Traditional and classic patterns',
                '• Textured and 3D wallpapers',
                '• Custom designs available',
                '• Professional installation with warranty',
                'Contact us at +919945623419 for a consultation!'
            ];
        }
        
        if (preg_match('/\b(wooden|wood|flooring|floor)\b/', $message)) {
            return [
                'We specialize in wooden flooring solutions!',
                'Our wooden flooring services include:',
                '• Engineered wood flooring',
                '• Solid wood flooring',
                '• Laminate flooring',
                '• Bamboo flooring',
                '• Custom wood designs',
                '• Professional installation and finishing',
                'Get a free quote by calling +919945623419!'
            ];
        }
        
        if (preg_match('/\b(paint|painting|wall paint)\b/', $message)) {
            return [
                'We provide professional wall painting services!',
                'Our painting services include:',
                '• Interior wall painting',
                '• Exterior wall painting',
                '• Texture painting',
                '• Decorative painting',
                '• Color consultation',
                '• Premium quality paints',
                'Contact us for a free color consultation!'
            ];
        }
        
        if (preg_match('/\b(sport|sports|gym|fitness|flooring)\b/', $message)) {
            return [
                'We offer specialized sport flooring solutions!',
                'Our sport flooring includes:',
                '• Gym flooring',
                '• Basketball court flooring',
                '• Badminton court flooring',
                '• Multi-purpose sports flooring',
                '• Shock-absorbing surfaces',
                '• Professional installation',
                'Perfect for fitness centers and sports facilities!'
            ];
        }
        
        // Default response
        return $this->getDefaultResponse($message);
    }
    
    private function getRandomResponse($category) {
        $responses = $this->responses[$category];
        return $responses;
    }
    
    private function getDefaultResponse($query) {
        $default = $this->responses['default'];
        $default[0] = str_replace('{query}', $query, $default[0]);
        return $default;
    }
    
    public function handleRequest() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                logMessage('WARNING', 'Invalid request method', ['method' => $_SERVER['REQUEST_METHOD']]);
                return json_encode(['error' => getConfig('error_messages')['invalid_request']]);
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($input['message']) || empty(trim($input['message']))) {
                logMessage('WARNING', 'Empty message received');
                return json_encode(['error' => getConfig('error_messages')['invalid_message']]);
            }
            
            $message = trim($input['message']);
            
            // Check message length
            if (strlen($message) > 500) {
                logMessage('WARNING', 'Message too long', ['length' => strlen($message)]);
                return json_encode(['error' => getConfig('error_messages')['message_too_long']]);
            }
            
            $response = $this->processMessage($message);
            
            // Log successful response
            logMessage('INFO', 'Response generated successfully', ['response_length' => count($response)]);
            
            return json_encode([
                'response' => $response,
                'timestamp' => date('Y-m-d H:i:s'),
                'status' => 'success',
                'intent' => $this->aiEnhancement->analyzeIntent($message)
            ]);
            
        } catch (Exception $e) {
            logMessage('ERROR', 'Request handling failed', ['error' => $e->getMessage()]);
            return json_encode([
                'error' => getConfig('error_messages')['service_unavailable'],
                'status' => 'error'
            ]);
        }
    }
}

// Initialize and handle the request
$chatbot = new ChatbotAPI();
echo $chatbot->handleRequest();
?>
