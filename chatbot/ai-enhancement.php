<?php
/**
 * AI Enhancement Module for Mishra Interior Chatbot
 * This module can be extended to integrate with external AI services
 * like OpenAI, Google AI, or other chatbot platforms
 */

class AIEnhancement {
    private $apiKey;
    private $service;
    
    public function __construct($service = 'local', $apiKey = null) {
        $this->service = $service;
        $this->apiKey = $apiKey;
    }
    
    /**
     * Enhanced response generation using AI
     */
    public function generateEnhancedResponse($userMessage, $context = []) {
        switch ($this->service) {
            case 'openai':
                return $this->getOpenAIResponse($userMessage, $context);
            case 'google':
                return $this->getGoogleAIResponse($userMessage, $context);
            case 'local':
            default:
                return $this->getLocalAIResponse($userMessage, $context);
        }
    }
    
    /**
     * OpenAI Integration (requires API key)
     */
    private function getOpenAIResponse($message, $context) {
        if (!$this->apiKey) {
            return $this->getLocalAIResponse($message, $context);
        }
        
        $prompt = $this->buildPrompt($message, $context);
        
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant for Mishra Interior, an interior design company. Provide friendly, professional responses about interior design services, pricing, and contact information.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 200,
            'temperature' => 0.7
        ];
        
        $response = $this->makeAPICall('https://api.openai.com/v1/chat/completions', $data);
        
        if ($response && isset($response['choices'][0]['message']['content'])) {
            return $this->formatResponse($response['choices'][0]['message']['content']);
        }
        
        return $this->getLocalAIResponse($message, $context);
    }
    
    /**
     * Google AI Integration (requires API key)
     */
    private function getGoogleAIResponse($message, $context) {
        if (!$this->apiKey) {
            return $this->getLocalAIResponse($message, $context);
        }
        
        $prompt = $this->buildPrompt($message, $context);
        
        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 200
            ]
        ];
        
        $response = $this->makeAPICall('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $this->apiKey, $data);
        
        if ($response && isset($response['candidates'][0]['content']['parts'][0]['text'])) {
            return $this->formatResponse($response['candidates'][0]['content']['parts'][0]['text']);
        }
        
        return $this->getLocalAIResponse($message, $context);
    }
    
    /**
     * Local AI Response (fallback)
     */
    private function getLocalAIResponse($message, $context) {
        // This uses the existing local response system
        $chatbot = new ChatbotAPI();
        return $chatbot->processMessage($message);
    }
    
    /**
     * Build context-aware prompt
     */
    private function buildPrompt($message, $context) {
        $companyInfo = "Mishra Interior is a professional interior design company offering services like wallpaper installation, wooden flooring, wall painting, sport flooring, carpet installation, and more. ";
        $contactInfo = "Contact: Rajesh Kumar (+919945623419), Ashwin Mishra (+919380735528), Rashmi Mishra (+917353709447), Shambhu Sharma (+919632175490). ";
        $servicesInfo = "Services include: Refurnishing, Sport Flooring, Wall Painting, Wooden Flooring, Wallpaper, Carpet, Vinyl Flooring, Blinds. ";
        
        $contextInfo = "";
        if (!empty($context)) {
            $contextInfo = "Previous conversation context: " . implode(' ', $context) . " ";
        }
        
        return $companyInfo . $servicesInfo . $contactInfo . $contextInfo . "User question: " . $message;
    }
    
    /**
     * Make API call to external service
     */
    private function makeAPICall($url, $data) {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        
        return null;
    }
    
    /**
     * Format AI response for chatbot
     */
    private function formatResponse($response) {
        // Split response into lines and clean up
        $lines = array_filter(array_map('trim', explode("\n", $response)));
        
        // Remove empty lines and format
        $formattedLines = [];
        foreach ($lines as $line) {
            if (!empty($line)) {
                $formattedLines[] = $line;
            }
        }
        
        return $formattedLines;
    }
    
    /**
     * Analyze user intent
     */
    public function analyzeIntent($message) {
        $intents = [
            'greeting' => ['hello', 'hi', 'hey', 'good morning', 'good afternoon'],
            'services' => ['service', 'what do you do', 'offer', 'provide'],
            'pricing' => ['price', 'cost', 'how much', 'expensive', 'budget'],
            'contact' => ['contact', 'phone', 'email', 'address', 'call'],
            'portfolio' => ['work', 'projects', 'examples', 'gallery'],
            'booking' => ['book', 'appointment', 'consultation', 'schedule'],
            'complaint' => ['problem', 'issue', 'complaint', 'dissatisfied']
        ];
        
        $message = strtolower($message);
        
        foreach ($intents as $intent => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($message, $keyword) !== false) {
                    return $intent;
                }
            }
        }
        
        return 'general';
    }
    
    /**
     * Generate contextual suggestions
     */
    public function generateSuggestions($intent, $context = []) {
        $suggestions = [
            'greeting' => [
                'What services do you offer?',
                'Can you tell me about your pricing?',
                'How can I contact you?'
            ],
            'services' => [
                'What are your prices?',
                'Do you have a portfolio?',
                'How long does a project take?'
            ],
            'pricing' => [
                'Can I get a free quote?',
                'What materials do you use?',
                'Do you offer payment plans?'
            ],
            'contact' => [
                'What are your business hours?',
                'Do you offer free consultations?',
                'Can you visit my location?'
            ],
            'portfolio' => [
                'Can I see more examples?',
                'What types of projects do you do?',
                'Do you have before/after photos?'
            ],
            'booking' => [
                'What information do you need?',
                'How much does a consultation cost?',
                'What should I prepare?'
            ]
        ];
        
        return $suggestions[$intent] ?? [
            'What services do you offer?',
            'How can I contact you?',
            'Do you have a portfolio?'
        ];
    }
}

// Configuration for AI services
class ChatbotConfig {
    public static function getConfig() {
        return [
            'ai_service' => 'local', // 'local', 'openai', 'google'
            'openai_api_key' => '', // Add your OpenAI API key here
            'google_api_key' => '', // Add your Google AI API key here
            'enable_analytics' => true,
            'save_conversations' => true,
            'max_conversation_length' => 50
        ];
    }
}
?>
