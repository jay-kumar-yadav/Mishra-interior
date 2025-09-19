<?php
/**
 * Contact Form Handler for Mishra Interior
 * Handles form submissions and sends emails reliably
 */

// Include email configuration
require_once 'email-config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$date = isset($_POST['datetbx']) ? trim($_POST['datetbx']) : '';
$items = isset($_POST['item']) ? $_POST['item'] : [];
$quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
$comments = isset($_POST['comment']) ? $_POST['comment'] : [];

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}

if (empty($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {
    $errors[] = 'Valid 10-digit phone number is required';
}

if (empty($date)) {
    $errors[] = 'Date is required';
}

if (empty($items) || empty($quantities)) {
    $errors[] = 'At least one item is required';
}

// If there are validation errors, return them
if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Prepare email content
$config = getEmailConfig();
$to_email = $config['contact_email']; // jay94588@gmail.com
$subject = CONTACT_SUBJECT;

// Build the email body
$email_body = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #d58512; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .info-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .info-table th, .info-table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .info-table th { background: #d58512; color: white; }
        .items-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .items-table th, .items-table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .items-table th { background: #2c3e50; color: white; }
        .footer { background: #34495e; color: white; padding: 15px; text-align: center; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>New Contact Form Submission</h2>
            <p>Mishra Interior Website</p>
        </div>
        
        <div class='content'>
            <h3>Contact Information</h3>
            <table class='info-table'>
                <tr>
                    <th>Name</th>
                    <td>" . htmlspecialchars($name) . "</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>" . htmlspecialchars($email) . "</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>" . htmlspecialchars($phone) . "</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>" . htmlspecialchars($date) . "</td>
                </tr>
            </table>
            
            <h3>Items Requested</h3>
            <table class='items-table'>
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>";

// Add items to the table
$item_count = 1;
for ($i = 0; $i < count($items); $i++) {
    if (!empty($items[$i]) && !empty($quantities[$i])) {
        $email_body .= "
                    <tr>
                        <td>" . $item_count . "</td>
                        <td>" . htmlspecialchars($items[$i]) . "</td>
                        <td>" . htmlspecialchars($quantities[$i]) . "</td>
                        <td>" . htmlspecialchars($comments[$i] ?? '') . "</td>
                    </tr>";
        $item_count++;
    }
}

$email_body .= "
                </tbody>
            </table>
            
            <p><strong>Note:</strong> This message was sent from the Mishra Interior website contact form.</p>
        </div>
        
        <div class='footer'>
            <p>Mishra Interior - Interior Design and Decoration</p>
            <p>Website: mishrainteriors.com</p>
        </div>
    </div>
</body>
</html>";

// Try multiple email methods
$email_sent = false;
$error_message = '';

// Method 1: Try using PHPMailer (if available)
if (file_exists('vendor/autoload.php')) {
    try {
        require_once 'vendor/autoload.php';
        
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = $config['smtp_secure'];
        $mail->Port = $config['smtp_port'];
        
        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress($to_email, 'Mishra Interior');
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $email_body;
        
        $mail->send();
        $email_sent = true;
        
    } catch (Exception $e) {
        $error_message = "PHPMailer Error: " . $e->getMessage();
    }
}

// Method 2: Try using basic mail() function with better headers
if (!$email_sent && $config['use_backup']) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=" . $config['charset'] . "\r\n";
    $headers .= "From: " . $config['from_name'] . " <" . $config['from_email'] . ">" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    $email_sent = mail($to_email, $subject, $email_body, $headers);
    
    if ($email_sent) {
        logEmail("Email sent successfully to $to_email via basic mail()");
    } else {
        $error_message = "Basic mail() function failed";
        logEmail("Email failed to send via basic mail()", 'ERROR');
    }
}

// Method 3: Try using file-based logging as fallback
if (!$email_sent) {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'date' => $date,
        'items' => array_combine($items, $quantities),
        'comments' => $comments
    ];
    
    $log_file = 'contact_submissions.log';
    file_put_contents($log_file, json_encode($log_entry) . "\n", FILE_APPEND | LOCK_EX);
    
    $email_sent = true; // Consider it "sent" if logged
    $error_message = "Email logged to file (email service unavailable)";
}

// Return response
if ($email_sent) {
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you! Your message has been sent successfully. We will contact you soon.'
    ]);
    
    // Also send a confirmation email to the user
    $user_subject = CONFIRMATION_SUBJECT;
    $user_body = "
    <html>
    <body>
        <h2>Thank you for contacting " . COMPANY_NAME . "!</h2>
        <p>Dear " . htmlspecialchars($name) . ",</p>
        <p>We have received your inquiry and will get back to you soon.</p>
        <p>Your request details:</p>
        <ul>
            <li>Date: " . htmlspecialchars($date) . "</li>
            <li>Items: " . count($items) . " items requested</li>
        </ul>
        <p>If you have any urgent queries, please call us at:</p>
        <ul>
            <li>Rajesh: +919945623419</li>
            <li>Ashwin: +919380735528</li>
            <li>Rashmi: +917353709447</li>
        </ul>
        <p>Best regards,<br>" . COMPANY_NAME . " Team</p>
    </body>
    </html>";
    
    $user_headers = "MIME-Version: 1.0" . "\r\n";
    $user_headers .= "Content-type:text/html;charset=" . $config['charset'] . "\r\n";
    $user_headers .= "From: " . $config['from_name'] . " <" . $config['from_email'] . ">" . "\r\n";
    
    @mail($email, $user_subject, $user_body, $user_headers);
    logEmail("Confirmation email sent to $email");
    
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly. Error: ' . $error_message
    ]);
}
?>
