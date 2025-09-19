<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Index - Mishra Interior</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .debug-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .debug-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .debug-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <!-- Debug Information -->
    <div class="debug-info">
        <h3>🔍 Debug Information</h3>
        <?php
        echo "<p><strong>Current Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
        
        // Test 1: Check if config file exists
        echo "<p><strong>Config File Exists:</strong> ";
        if (file_exists('chatbot/config.php')) {
            echo "✅ Yes</p>";
        } else {
            echo "❌ No - This is the problem!</p>";
        }
        
        // Test 2: Try to include config
        echo "<p><strong>Config Include:</strong> ";
        try {
            require_once 'chatbot/config.php';
            echo "✅ Success</p>";
        } catch (Exception $e) {
            echo "❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        
        // Test 3: Try to get stats
        echo "<p><strong>Get Stats:</strong> ";
        try {
            $stats = getConfig('company_stats');
            if ($stats) {
                echo "✅ Success - Found " . count($stats) . " statistics</p>";
                echo "<pre style='background: white; padding: 10px; margin: 10px 0; border-radius: 3px;'>";
                print_r($stats);
                echo "</pre>";
            } else {
                echo "❌ No stats returned</p>";
            }
        } catch (Exception $e) {
            echo "❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>
    
    <!-- Original Statistics Section with Debug -->
    <section class="fun-facts padTB100">
        <div class="special-style-full special-area-widthfull special-style-dark">
            <div class="bg-image parallax-style facts-bg"></div>
        </div>
        <div id="fun-factor" class="fun-fact-section dark-theme-fun-fact">
            <div class="container text-center">
                <h3 class="marB10">Check Out Our Awesome Statistics Till Now!</h3>
                <h1 class="marB50">&amp; Hire Us Now</h1>
                
                <!-- Debug: Show what values are being used -->
                <div class="debug-info">
                    <h4>🔍 Statistics Values Being Used:</h4>
                    <?php
                    if (isset($stats)) {
                        echo "<p>Clients: " . $stats['clients'] . "</p>";
                        echo "<p>Projects: " . $stats['projects'] . "</p>";
                        echo "<p>Likes: " . $stats['likes'] . "</p>";
                        echo "<p>Reviews: " . $stats['reviews'] . "</p>";
                    } else {
                        echo "<p>❌ No statistics loaded!</p>";
                    }
                    ?>
                </div>
                
                <div class="row text-center fact-counter pad-s15">
                    <!--//==Facts Counter Item==//-->
                    <div class="col-xs-12 col-sm-3 col-md-3 marB-s30">
                        <!-- Icon -->
                        <span class="top-box icon-box"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <div class="count-number padTB40" data-count="<?php echo isset($stats) ? $stats['clients'] : '207'; ?>">
                            <h2><span class="counter"><?php echo isset($stats) ? $stats['clients'] : '207'; ?></span></h2>
                        </div>
                        <!-- Title -->
                        <h2 class="facts-text">CLIENTS</h2>
                    </div>
                    <!--//==Facts Counter Item==//-->
                    <div class="col-xs-12 col-sm-3 col-md-3 marB-s30">
                        <!-- Icon -->
                        <span class="top-box icon-box"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                        <div class="count-number padTB40" data-count="<?php echo isset($stats) ? $stats['projects'] : '285'; ?>">
                            <h2><span class="counter"><?php echo isset($stats) ? $stats['projects'] : '285'; ?></span></h2>
                        </div>
                        <!-- Title -->
                        <h2 class="facts-text">Projects</h2>
                    </div>
                    <!--//==Facts Counter Item==//-->
                    <div class="col-xs-12 col-sm-3 col-md-3 marB-s30">
                        <!-- Icon -->
                        <span class="top-box icon-box"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        <div class="count-number padTB40" data-count="<?php echo isset($stats) ? $stats['likes'] : '654'; ?>">
                            <h2><span class="counter"><?php echo isset($stats) ? $stats['likes'] : '654'; ?></span></h2>
                        </div>
                        <!-- Title -->
                        <h2 class="facts-text">likes</h2>
                    </div>
                    <!--//==Facts Counter Item==//-->
                    <div class="col-xs-12 col-sm-3 col-md-3 marB-s30">
                        <!-- Icon -->
                        <span class="top-box icon-box"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                        <div class="count-number padTB40" data-count="<?php echo isset($stats) ? $stats['reviews'] : '714'; ?>">
                            <h2><span class="counter"><?php echo isset($stats) ? $stats['reviews'] : '714'; ?></span></h2>
                        </div>
                        <!-- Title -->
                        <h2 class="facts-text">reviews</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div style="text-align: center; margin: 50px 0;">
        <a href="index.php" style="background: #d58512; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px;">Go to Original Index</a>
        <a href="test-statistics.php" style="background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin-left: 10px;">Test Statistics Page</a>
    </div>
</body>
</html>
