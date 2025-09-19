<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mishra Interior Chatbot Demo</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="chatbot/chatbot.css">
    <style>
        .demo-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .demo-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .demo-header h1 {
            color: #d58512;
            margin-bottom: 10px;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .feature-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d58512;
        }
        .feature-card h3 {
            color: #d58512;
            margin-top: 0;
        }
        .demo-actions {
            text-align: center;
            margin: 30px 0;
        }
        .demo-btn {
            display: inline-block;
            background: #d58512;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
            transition: background 0.3s ease;
        }
        .demo-btn:hover {
            background: #b8730f;
            color: white;
            text-decoration: none;
        }
        .chatbot-preview {
            background: #f8f9fa;
            border: 2px dashed #d58512;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .chatbot-preview p {
            color: #666;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>
    
    <div class="demo-container">
        <div class="demo-header">
            <h1>🤖 Mishra Interior AI Chatbot</h1>
            <p>Your intelligent assistant for interior design questions</p>
        </div>
        
        <div class="chatbot-preview">
            <h3>💬 Try the Chatbot!</h3>
            <p>Look for the chat button in the bottom-right corner of this page</p>
            <p>Click it to start chatting with our AI assistant</p>
        </div>
        
        <div class="feature-grid">
            <div class="feature-card">
                <h3>🎨 Service Information</h3>
                <p>Ask about our interior design services including wallpaper, wooden flooring, wall painting, and more.</p>
            </div>
            
            <div class="feature-card">
                <h3>💰 Pricing & Quotes</h3>
                <p>Get information about our pricing structure and request free quotes for your projects.</p>
            </div>
            
            <div class="feature-card">
                <h3>📞 Contact Details</h3>
                <p>Find contact information for our team members and learn how to reach us.</p>
            </div>
            
            <div class="feature-card">
                <h3>🕒 Business Hours</h3>
                <p>Check our operating hours and availability for consultations and services.</p>
            </div>
            
            <div class="feature-card">
                <h3>📸 Portfolio</h3>
                <p>Learn about our completed projects and see examples of our work.</p>
            </div>
            
            <div class="feature-card">
                <h3>🛡️ Warranties</h3>
                <p>Understand our warranty policies and after-sales service commitments.</p>
            </div>
        </div>
        
        <div class="demo-actions">
            <a href="index.php" class="demo-btn">🏠 Back to Home</a>
            <a href="chatbot/test.php" class="demo-btn">🧪 Test API</a>
            <a href="chatbot/admin.php" class="demo-btn">⚙️ Admin Panel</a>
        </div>
        
        <div style="background: #e8f4f8; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="color: #2c5aa0; margin-top: 0;">💡 Sample Questions to Try:</h3>
            <ul style="color: #555;">
                <li>"What services do you offer?"</li>
                <li>"How much does wallpaper installation cost?"</li>
                <li>"What are your business hours?"</li>
                <li>"Can you show me your portfolio?"</li>
                <li>"What materials do you use for wooden flooring?"</li>
                <li>"How can I contact your team?"</li>
                <li>"Do you offer free consultations?"</li>
                <li>"What warranty do you provide?"</li>
            </ul>
        </div>
        
        <div style="background: #fff3cd; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="color: #856404; margin-top: 0;">🔧 Technical Features:</h3>
            <ul style="color: #856404;">
                <li>AI-powered intelligent responses</li>
                <li>Mobile-responsive design</li>
                <li>Rate limiting and security</li>
                <li>Analytics and logging</li>
                <li>Easy configuration system</li>
                <li>Integration with external AI services</li>
            </ul>
        </div>
    </div>
    
    <!-- Include footer with chatbot -->
    <?php include 'footer.php'; ?>
    
    <script src="chatbot/chatbot.js"></script>
</body>
</html>
