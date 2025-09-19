<?php
/**
 * Production Email Configuration for Mishra Interior
 * Update this file with your real server SMTP settings
 */

// ========================================
// 🔧 UPDATE THESE SETTINGS FOR YOUR SERVER
// ========================================

// SMTP Settings (Get these from your hosting provider)
define('SMTP_HOST', 'mail.yourdomain.com');           // Your hosting SMTP server
define('SMTP_PORT', 587);                            // Usually 587 or 465
define('SMTP_USERNAME', 'noreply@yourdomain.com');   // Your hosting email account
define('SMTP_PASSWORD', 'your-email-password');      // Password for that email
define('SMTP_SECURE', 'tls');                        // 'tls' for port 587, 'ssl' for port 465

// ========================================
// 📧 EMAIL DESTINATIONS (DON'T CHANGE THESE)
// ========================================

// Where contact form emails will be sent (KEEP THIS)
define('CONTACT_EMAIL', 'jay94588@gmail.com');

// From email (appears as sender)
define('FROM_EMAIL', 'noreply@yourdomain.com');      // Change to your domain
define('FROM_NAME', 'Mishra Interior Website');

// ========================================
// 📋 COMMON HOSTING PROVIDER SETTINGS
// ========================================

/*
// GoDaddy
define('SMTP_HOST', 'smtpout.secureserver.net');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'noreply@yourdomain.com');
define('SMTP_PASSWORD', 'your-password');
define('SMTP_SECURE', 'tls');

// Bluehost
define('SMTP_HOST', 'mail.yourdomain.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'noreply@yourdomain.com');
define('SMTP_PASSWORD', 'your-password');
define('SMTP_SECURE', 'tls');

// HostGator
define('SMTP_HOST', 'mail.yourdomain.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'noreply@yourdomain.com');
define('SMTP_PASSWORD', 'your-password');
define('SMTP_SECURE', 'tls');

// Gmail (if you want to use Gmail)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-gmail@gmail.com');
define('SMTP_PASSWORD', 'your-gmail-app-password');  // Use App Password, not regular password
define('SMTP_SECURE', 'tls');
*/

// ========================================
// ⚙️ OTHER SETTINGS (USUALLY DON'T CHANGE)
// ========================================

define('EMAIL_CHARSET', 'UTF-8');
define('EMAIL_ENCODING', '8bit');
define('USE_BACKUP_MAIL', true);
define('LOG_EMAILS', true);
define('LOG_FILE', 'email_log.txt');

// Email Templates
define('CONTACT_SUBJECT', 'New Contact Form Submission - Mishra Interior');
define('CONFIRMATION_SUBJECT', 'Thank you for contacting Mishra Interior');

// Company Information
define('COMPANY_NAME', 'Mishra Interior');
define('COMPANY_PHONE', '+919945623419');
define('COMPANY_EMAIL', 'rajeshkumar1975b@gmail.com');
define('COMPANY_WEBSITE', 'mishrainteriors.com');

/**
 * Get email configuration
 */
function getEmailConfig() {
    return [
        'smtp_host' => SMTP_HOST,
        'smtp_port' => SMTP_PORT,
        'smtp_username' => SMTP_USERNAME,
        'smtp_password' => SMTP_PASSWORD,
        'smtp_secure' => SMTP_SECURE,
        'contact_email' => CONTACT_EMAIL,
        'from_email' => FROM_EMAIL,
        'from_name' => FROM_NAME,
        'charset' => EMAIL_CHARSET,
        'encoding' => EMAIL_ENCODING,
        'use_backup' => USE_BACKUP_MAIL,
        'log_emails' => LOG_EMAILS,
        'log_file' => LOG_FILE
    ];
}

/**
 * Log email activity
 */
function logEmail($message, $type = 'INFO') {
    if (!LOG_EMAILS) return;
    
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] [$type] $message" . PHP_EOL;
    
    file_put_contents(LOG_FILE, $logEntry, FILE_APPEND | LOCK_EX);
}

/**
 * Send test email
 */
function sendTestEmail() {
    $config = getEmailConfig();
    
    $subject = "Test Email from Mishra Interior - " . date('Y-m-d H:i:s');
    $body = "
    <html>
    <body>
        <h2>✅ Email System Test Successful!</h2>
        <p>This is a test email to verify the email configuration is working properly.</p>
        <p><strong>Test Details:</strong></p>
        <ul>
            <li>Date: " . date('Y-m-d H:i:s') . "</li>
            <li>SMTP Host: " . $config['smtp_host'] . "</li>
            <li>From: " . $config['from_email'] . "</li>
            <li>To: " . $config['contact_email'] . "</li>
        </ul>
        <p>If you received this email, your contact form is ready to send real emails!</p>
        <p>Best regards,<br>Mishra Interior Team</p>
    </body>
    </html>";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=" . $config['charset'] . "\r\n";
    $headers .= "From: " . $config['from_name'] . " <" . $config['from_email'] . ">" . "\r\n";
    
    $result = mail($config['contact_email'], $subject, $body, $headers);
    
    if ($result) {
        logEmail("Test email sent successfully to " . $config['contact_email']);
        return true;
    } else {
        logEmail("Test email failed to send", 'ERROR');
        return false;
    }
}
?>
