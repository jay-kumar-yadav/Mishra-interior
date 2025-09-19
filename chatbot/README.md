# Mishra Interior AI Chatbot

A comprehensive AI-powered chatbot solution for the Mishra Interior website, designed to help customers with questions about interior design services, pricing, contact information, and more.

## Features

- 🤖 **Intelligent Responses**: AI-powered responses with fallback to local knowledge base
- 💬 **Modern UI**: Beautiful, responsive chat interface with typing indicators
- 📱 **Mobile Friendly**: Fully responsive design that works on all devices
- 🔧 **Easy Configuration**: Simple configuration system for customization
- 📊 **Analytics**: Built-in admin panel for monitoring chatbot usage
- 📈 **Dynamic Statistics**: Real-time statistics management with growth tracking
- 🛡️ **Security**: Rate limiting and input validation
- 🌐 **Multi-language Ready**: Prepared for multiple language support
- 🔌 **Extensible**: Easy integration with external AI services
- 📊 **Statistics API**: RESTful API for managing company statistics

## Installation

1. **Upload Files**: Upload the `chatbot` folder to your website root directory
2. **Include in Website**: The chatbot is already integrated into your `footer.php`
3. **Set Permissions**: Ensure the `chatbot/logs` directory is writable (755 permissions)
4. **Test**: Visit your website and click the chat button in the bottom-right corner

## Configuration

### Basic Configuration
Edit `chatbot/config.php` to customize:

```php
// Company Information
define('COMPANY_NAME', 'Mishra Interior');
define('COMPANY_PHONE', '+919945623419');
define('COMPANY_EMAIL', 'rajeshkumar1975b@gmail.com');

// AI Service Configuration
define('AI_SERVICE', 'local'); // Options: 'local', 'openai', 'google'
```

### AI Service Integration

#### OpenAI Integration
1. Get an API key from [OpenAI](https://platform.openai.com/)
2. Update `config.php`:
```php
define('AI_SERVICE', 'openai');
define('OPENAI_API_KEY', 'your-api-key-here');
```

#### Google AI Integration
1. Get an API key from [Google AI Studio](https://makersuite.google.com/)
2. Update `config.php`:
```php
define('AI_SERVICE', 'google');
define('GOOGLE_API_KEY', 'your-api-key-here');
```

## Usage

### For Customers
- Click the chat button in the bottom-right corner
- Ask questions about services, pricing, contact information, etc.
- Use the suggestion buttons for quick questions
- The chatbot will provide helpful responses and contact information

### For Administrators
- Access the admin panel at `chatbot/admin.php`
- Default password: `admin123` (change this in production!)
- View analytics, logs, and rate limiting information

### Statistics Management
- Access the statistics manager at `chatbot/stats-manager.php`
- Update your company statistics (clients, projects, likes, reviews)
- Use quick increment buttons for easy updates
- View growth tracking and change history
- Statistics are automatically displayed on your website

## Customization

### Adding New Responses
Edit `chatbot/config.php` to add new FAQ entries:

```php
$FAQ = [
    'Your new question?' => 'Your new answer here.',
    // ... existing entries
];
```

### Modifying Chatbot Appearance
Edit `chatbot/chatbot.css` to customize:
- Colors and themes
- Button styles
- Message appearance
- Responsive breakpoints

### Adding New Services
Update the services array in `config.php`:

```php
$SERVICES = [
    'new_service' => [
        'name' => 'New Service',
        'description' => 'Description of your new service.',
        'icon' => 'fa-icon-name'
    ],
    // ... existing services
];
```

## File Structure

```
chatbot/
├── api.php              # Main API endpoint
├── chatbot.js           # Frontend JavaScript
├── chatbot.css          # Styling
├── config.php           # Configuration file
├── ai-enhancement.php   # AI service integration
├── admin.php            # Admin panel
├── README.md            # This file
└── logs/                # Log files directory
    ├── chatbot.log      # Main log file
    └── rate_limit_*.txt # Rate limiting data
```

## API Endpoints

### POST /chatbot/api.php
Send a message to the chatbot.

**Request:**
```json
{
    "message": "What services do you offer?"
}
```

**Response:**
```json
{
    "response": [
        "We offer several interior design services:",
        "• Refurnishing - Best collection and exclusive designs",
        "• Sport Flooring - High-quality sports flooring solutions",
        "..."
    ],
    "timestamp": "2025-01-27 10:30:00",
    "status": "success",
    "intent": "services"
}
```

### Statistics API

#### GET /chatbot/stats-api.php?action=get&key=YOUR_API_KEY
Get current statistics.

**Response:**
```json
{
    "success": true,
    "data": {
        "clients": 207,
        "projects": 285,
        "likes": 654,
        "reviews": 714,
        "last_updated": "2025-01-27 10:30:00"
    }
}
```

#### POST /chatbot/stats-api.php?action=increment&key=YOUR_API_KEY
Increment a statistic.

**Request:**
```json
{
    "stat": "clients",
    "amount": 1
}
```

**Response:**
```json
{
    "success": true,
    "message": "Incremented clients by 1",
    "old_value": 207,
    "new_value": 208,
    "data": { ... }
}
```

## Security Features

- **Rate Limiting**: Prevents spam and abuse
- **Input Validation**: Sanitizes all user inputs
- **Error Handling**: Graceful error handling and logging
- **CORS Protection**: Proper CORS headers for security

## Troubleshooting

### Chatbot Not Appearing
1. Check that `chatbot/chatbot.css` and `chatbot/chatbot.js` are accessible
2. Verify the files are included in your `footer.php`
3. Check browser console for JavaScript errors

### API Errors
1. Check `chatbot/logs/chatbot.log` for error messages
2. Ensure the `chatbot/logs` directory is writable
3. Verify PHP error reporting is enabled

### AI Service Issues
1. Check API key configuration
2. Verify internet connectivity for external AI services
3. Check rate limits on AI service providers

## Performance Optimization

- **Caching**: Responses are cached for better performance
- **Rate Limiting**: Prevents server overload
- **Logging**: Efficient logging system
- **Minification**: Consider minifying CSS/JS for production

## Support

For technical support or customization requests, contact:
- **Email**: rajeshkumar1975b@gmail.com
- **Phone**: +919945623419

## License

This chatbot solution is proprietary to Mishra Interior. All rights reserved.

## Changelog

### Version 1.0.0
- Initial release
- Basic chatbot functionality
- AI service integration
- Admin panel
- Mobile responsive design
- Rate limiting and security features
