<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Contact Form Submissions - Mishra Interiors</title>
    
    <link rel="icon" href="image/0.png" type="image/x-icon">
    <link href="main.css" rel="stylesheet">
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: linear-gradient(135deg, #DCA44B, #B8860B);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 10px;
            min-width: 150px;
        }
        
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #DCA44B;
        }
        
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
        
        .submission-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 5px solid #DCA44B;
        }
        
        .submission-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .submission-title {
            font-size: 1.3em;
            font-weight: bold;
            color: #333;
        }
        
        .submission-date {
            color: #666;
            font-size: 0.9em;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .info-label {
            font-weight: bold;
            color: #DCA44B;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
        }
        
        .items-section {
            margin-top: 20px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .items-table th {
            background: #DCA44B;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .no-submissions {
            text-align: center;
            padding: 50px;
            color: #666;
        }
        
        .refresh-btn {
            background: #DCA44B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        
        .refresh-btn:hover {
            background: #B8860B;
        }
        
        .back-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-btn:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .submission-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .contact-info {
                grid-template-columns: 1fr;
            }
            
            .stats {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="container">
        <div class="header">
            <h1><i class="fa fa-envelope"></i> Contact Form Submissions</h1>
            <p>View all contact form submissions from your website</p>
        </div>
        
        <!-- Navigation -->
        <div>
            <a href="contact-us.php" class="back-btn">
                <i class="fa fa-arrow-left"></i> Back to Contact Form
            </a>
            <button onclick="location.reload()" class="refresh-btn">
                <i class="fa fa-refresh"></i> Refresh
            </button>
        </div>
        
        <?php
        // Read submissions from log file
        $logFile = 'contact_submissions.log';
        $submissions = [];
        
        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                
                // Try to parse as JSON first (new format)
                $data = json_decode($line, true);
                if ($data) {
                    $submissions[] = $data;
                } else {
                    // Parse old format: timestamp | name | email | phone | Items: count
                    $parts = explode(' | ', $line);
                    if (count($parts) >= 5) {
                        $submissions[] = [
                            'timestamp' => $parts[0],
                            'name' => $parts[1],
                            'email' => $parts[2],
                            'phone' => $parts[3],
                            'items' => ['Item' => '1'], // Placeholder for old format
                            'comments' => ['']
                        ];
                    }
                }
            }
        }
        
        // Sort by timestamp (newest first)
        usort($submissions, function($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });
        
        $totalSubmissions = count($submissions);
        $todaySubmissions = 0;
        $thisWeekSubmissions = 0;
        
        $today = date('Y-m-d');
        $weekStart = date('Y-m-d', strtotime('monday this week'));
        
        foreach ($submissions as $submission) {
            $submissionDate = date('Y-m-d', strtotime($submission['timestamp']));
            if ($submissionDate === $today) {
                $todaySubmissions++;
            }
            if ($submissionDate >= $weekStart) {
                $thisWeekSubmissions++;
            }
        }
        ?>
        
        <!-- Statistics -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalSubmissions; ?></div>
                <div class="stat-label">Total Submissions</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $todaySubmissions; ?></div>
                <div class="stat-label">Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $thisWeekSubmissions; ?></div>
                <div class="stat-label">This Week</div>
            </div>
        </div>
        
        <!-- Submissions List -->
        <?php if (empty($submissions)): ?>
            <div class="no-submissions">
                <i class="fa fa-inbox" style="font-size: 3em; color: #ccc; margin-bottom: 20px;"></i>
                <h3>No submissions yet</h3>
                <p>Contact form submissions will appear here once someone fills out the form.</p>
            </div>
        <?php else: ?>
            <?php foreach ($submissions as $index => $submission): ?>
                <div class="submission-card">
                    <div class="submission-header">
                        <div class="submission-title">
                            Submission #<?php echo $totalSubmissions - $index; ?>
                        </div>
                        <div class="submission-date">
                            <i class="fa fa-clock-o"></i> <?php echo date('M d, Y \a\t g:i A', strtotime($submission['timestamp'])); ?>
                        </div>
                    </div>
                    
                    <div class="contact-info">
                        <div class="info-item">
                            <div class="info-label">Name</div>
                            <div class="info-value"><?php echo htmlspecialchars($submission['name']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <a href="mailto:<?php echo htmlspecialchars($submission['email']); ?>">
                                    <?php echo htmlspecialchars($submission['email']); ?>
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Phone</div>
                            <div class="info-value">
                                <a href="tel:<?php echo htmlspecialchars($submission['phone']); ?>">
                                    <?php echo htmlspecialchars($submission['phone']); ?>
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date</div>
                            <div class="info-value"><?php echo htmlspecialchars($submission['date']); ?></div>
                        </div>
                    </div>
                    
                    <?php if (isset($submission['items']) && !empty($submission['items'])): ?>
                        <div class="items-section">
                            <h4><i class="fa fa-list"></i> Items Requested</h4>
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $itemCount = 1;
                                    if (is_array($submission['items'])) {
                                        foreach ($submission['items'] as $item => $quantity): 
                                    ?>
                                        <tr>
                                            <td><?php echo $itemCount++; ?></td>
                                            <td><?php echo htmlspecialchars($item); ?></td>
                                            <td><?php echo htmlspecialchars($quantity); ?></td>
                                            <td><?php echo htmlspecialchars($submission['comments'][$itemCount-2] ?? ''); ?></td>
                                        </tr>
                                    <?php 
                                        endforeach;
                                    } else {
                                        // Handle old format
                                        foreach ($submission['items'] as $item => $quantity): 
                                    ?>
                                        <tr>
                                            <td><?php echo $itemCount++; ?></td>
                                            <td><?php echo htmlspecialchars($item); ?></td>
                                            <td><?php echo htmlspecialchars($quantity); ?></td>
                                            <td><?php echo htmlspecialchars($submission['comments'][$itemCount-2] ?? ''); ?></td>
                                        </tr>
                                    <?php 
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
