<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Email System - Mishra Interior</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .test-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .test-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            background: #d58512;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background: #b8730f;
        }
        .result {
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="test-container">
        <h1>📧 Email System Test</h1>
        <p>This page helps you test the email functionality of your contact form.</p>
        
        <?php
        // Test email configuration
        if (isset($_POST['test_email'])) {
            echo "<h2>Testing Email Configuration</h2>";
            
            require_once 'email-config.php';
            
            $config = getEmailConfig();
            echo "<div class='info'>";
            echo "<h3>Current Configuration:</h3>";
            echo "<ul>";
            echo "<li><strong>SMTP Host:</strong> " . $config['smtp_host'] . "</li>";
            echo "<li><strong>SMTP Port:</strong> " . $config['smtp_port'] . "</li>";
            echo "<li><strong>Contact Email:</strong> " . $config['contact_email'] . "</li>";
            echo "<li><strong>From Email:</strong> " . $config['from_email'] . "</li>";
            echo "</ul>";
            echo "</div>";
            
            // Test basic mail function
            $test_result = sendTestEmail();
            
            if ($test_result) {
                echo "<div class='success'>";
                echo "<h3>✅ Test Email Sent Successfully!</h3>";
                echo "<p>Check your email at <strong>" . $config['contact_email'] . "</strong> for the test message.</p>";
                echo "</div>";
            } else {
                echo "<div class='error'>";
                echo "<h3>❌ Test Email Failed</h3>";
                echo "<p>The email system is not working properly. This is common on localhost/XAMPP.</p>";
                echo "<p><strong>Solutions:</strong></p>";
                echo "<ul>";
                echo "<li>Use a real web server (not localhost)</li>";
                echo "<li>Configure SMTP settings in email-config.php</li>";
                echo "<li>Check if your hosting provider allows mail() function</li>";
                echo "</ul>";
                echo "</div>";
            }
        }
        
        // Test contact form handler
        if (isset($_POST['test_contact_form'])) {
            echo "<h2>Testing Contact Form Handler</h2>";
            
            // Simulate form data
            $_POST['name'] = 'Test User';
            $_POST['email'] = 'test@example.com';
            $_POST['phone'] = '9876543210';
            $_POST['datetbx'] = date('Y-m-d');
            $_POST['item'] = ['Test Item 1', 'Test Item 2'];
            $_POST['quantity'] = ['2', '1'];
            $_POST['comment'] = ['Test comment 1', 'Test comment 2'];
            
            // Capture output
            ob_start();
            include 'contact-form-handler.php';
            $output = ob_get_clean();
            
            echo "<div class='info'>";
            echo "<h3>Contact Form Handler Response:</h3>";
            echo "<pre>" . htmlspecialchars($output) . "</pre>";
            echo "</div>";
        }
        ?>
        
        <div class="test-form">
            <h2>🧪 Test Email Configuration</h2>
            <form method="POST">
                <button type="submit" name="test_email" class="btn">Send Test Email</button>
            </form>
            <p><small>This will send a test email to jay94588@gmail.com</small></p>
        </div>
        
        <div class="test-form">
            <h2>📝 Test Contact Form Handler</h2>
            <form method="POST">
                <button type="submit" name="test_contact_form" class="btn">Test Contact Form</button>
            </form>
            <p><small>This will test the contact form processing logic</small></p>
        </div>
        
        <div class="info">
            <h3>📋 Setup Instructions:</h3>
            <ol>
                <li><strong>For Production:</strong> Edit <code>email-config.php</code> with your SMTP settings</li>
                <li><strong>For Gmail:</strong> Use Gmail App Password (not your regular password)</li>
                <li><strong>For Localhost:</strong> The basic mail() function may not work - use a real server</li>
                <li><strong>Check Logs:</strong> Look for <code>email_log.txt</code> for debugging</li>
            </ol>
        </div>
        
        <div class="info">
            <h3>🔧 Current Email Settings:</h3>
            <p><strong>Recipient Email:</strong> jay94588@gmail.com</p>
            <p><strong>Contact Form:</strong> contact-us.php → contact-form-handler.php</p>
            <p><strong>Configuration:</strong> email-config.php</p>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="contact-us.php" class="btn">Go to Contact Form</a>
            <a href="index.php" class="btn">Back to Home</a>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
