<?php
/**
 * Email Configuration for Mishra Interior
 * Configure your email settings here
 */

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com'); // Your Gmail address
define('SMTP_PASSWORD', 'your-app-password'); // Gmail App Password
define('SMTP_SECURE', 'tls'); // or 'ssl' for port 465

// Recipient Email (where contact form emails will be sent)
define('CONTACT_EMAIL', 'jay94588@gmail.com');

// From Email (appears as sender)
define('FROM_EMAIL', 'noreply@mishrainteriors.com');
define('FROM_NAME', 'Mishra Interior Website');

// Email Settings
define('EMAIL_CHARSET', 'UTF-8');
define('EMAIL_ENCODING', '8bit');

// Backup Settings (if SMTP fails, use basic mail)
define('USE_BACKUP_MAIL', true);
define('LOG_EMAILS', true);
define('LOG_FILE', 'email_log.txt');

// reCAPTCHA Settings (if you want to add it later)
define('RECAPTCHA_SECRET_KEY', '6Lfgvj0UAAAAAHFD3UcoLRB7ssS_IQVHq-FJV1ry');
define('RECAPTCHA_SITE_KEY', '6Lfgvj0UAAAAAYour_Site_Key_Here');

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
    
    $subject = "Test Email from Mishra Interior";
    $body = "This is a test email to verify the email configuration is working properly.";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
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
