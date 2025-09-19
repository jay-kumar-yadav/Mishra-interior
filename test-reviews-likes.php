<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Reviews & Likes System - Mishra Interiors</title>
    <link rel="stylesheet" href="main.css">
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="reviews-likes-modal.css" rel="stylesheet">
    <style>
        .test-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .test-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, #D4AF37, #B8860B);
            color: white;
            border-radius: 15px;
        }
        .test-section {
            margin: 40px 0;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 4px solid #D4AF37;
        }
        .stats-demo {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .stat-item {
            background: white;
            padding: 30px 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .stat-icon {
            font-size: 3rem;
            color: #D4AF37;
            margin-bottom: 15px;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2C2C2C;
            margin-bottom: 10px;
        }
        .stat-label {
            color: #666;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .clickable-stat {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .clickable-stat:hover {
            transform: scale(1.05);
        }
        .instructions {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .instructions h4 {
            color: #1976d2;
            margin-bottom: 10px;
        }
        .instructions ul {
            margin: 0;
            padding-left: 20px;
        }
        .instructions li {
            margin-bottom: 5px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <div class="test-header">
            <h1>🧪 Reviews & Likes System Test</h1>
            <p>Interactive Statistics with Customer Reviews and Likes</p>
        </div>

        <div class="test-section">
            <h2>📊 Interactive Statistics</h2>
            <div class="instructions">
                <h4>How to Test:</h4>
                <ul>
                    <li><strong>Click on "LIKES"</strong> to see who liked your work</li>
                    <li><strong>Click on "REVIEWS"</strong> to read customer reviews</li>
                    <li>Modals will open with beautiful animations</li>
                    <li>Data is loaded dynamically from the API</li>
                </ul>
            </div>

            <div class="stats-demo">
                <div class="stat-item clickable-stat" onclick="reviewsModal.showClients()" title="Click to see our valued clients">
                    <div class="stat-icon">
                        <i class="fa fa-user-o"></i>
                    </div>
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Clients</div>
                </div>

                <div class="stat-item clickable-stat" onclick="reviewsModal.showProjects()" title="Click to see our project portfolio">
                    <div class="stat-icon">
                        <i class="fa fa-building-o"></i>
                    </div>
                    <div class="stat-number">300+</div>
                    <div class="stat-label">Projects</div>
                </div>

                <div class="stat-item clickable-stat" onclick="reviewsModal.showLikes()" title="Click to see who liked our work">
                    <div class="stat-icon">
                        <i class="fa fa-heart-o"></i>
                    </div>
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Likes</div>
                </div>

                <div class="stat-item clickable-stat" onclick="reviewsModal.showReviews()" title="Click to read customer reviews">
                    <div class="stat-icon">
                        <i class="fa fa-comment-o"></i>
                    </div>
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Reviews</div>
                </div>
            </div>
        </div>

        <div class="test-section">
            <h2>🎨 Features Implemented</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                <div style="background: white; padding: 20px; border-radius: 10px;">
                    <h4 style="color: #D4AF37; margin-bottom: 15px;">👥 Clients Modal</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>Client information</li>
                        <li>Project counts</li>
                        <li>Total values</li>
                        <li>Contact details</li>
                        <li>Client status</li>
                    </ul>
                </div>
                <div style="background: white; padding: 20px; border-radius: 10px;">
                    <h4 style="color: #D4AF37; margin-bottom: 15px;">🏗️ Projects Modal</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>Project details</li>
                        <li>Budget & duration</li>
                        <li>Project images</li>
                        <li>Features list</li>
                        <li>Client information</li>
                    </ul>
                </div>
                <div style="background: white; padding: 20px; border-radius: 10px;">
                    <h4 style="color: #D4AF37; margin-bottom: 15px;">✨ Reviews Modal</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>Beautiful customer reviews</li>
                        <li>Star ratings display</li>
                        <li>Customer avatars</li>
                        <li>Project categories</li>
                        <li>Review dates</li>
                    </ul>
                </div>
                <div style="background: white; padding: 20px; border-radius: 10px;">
                    <h4 style="color: #D4AF37; margin-bottom: 15px;">❤️ Likes Modal</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>People who liked your work</li>
                        <li>Customer locations</li>
                        <li>Project names</li>
                        <li>Like dates</li>
                        <li>Grid layout</li>
                    </ul>
                </div>
                <div style="background: white; padding: 20px; border-radius: 10px;">
                    <h4 style="color: #D4AF37; margin-bottom: 15px;">🎭 Interactive Effects</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>Hover animations</li>
                        <li>Click effects</li>
                        <li>Smooth transitions</li>
                        <li>Loading states</li>
                        <li>Responsive design</li>
                    </ul>
                </div>
                <div style="background: white; padding: 20px; border-radius: 10px;">
                    <h4 style="color: #D4AF37; margin-bottom: 15px;">📱 User Experience</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>Easy to use</li>
                        <li>Mobile friendly</li>
                        <li>Keyboard navigation</li>
                        <li>Click outside to close</li>
                        <li>Escape key support</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="test-section">
            <h2>🔧 Technical Details</h2>
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="color: #D4AF37; margin-bottom: 15px;">Files Created:</h4>
                <ul style="margin: 0; padding-left: 20px;">
                    <li><strong>reviews-likes-data.php</strong> - Sample data for reviews and likes</li>
                    <li><strong>reviews-likes-api.php</strong> - API endpoints for data</li>
                    <li><strong>reviews-likes-modal.css</strong> - Beautiful modal styles</li>
                    <li><strong>reviews-likes-modal.js</strong> - Interactive functionality</li>
                </ul>
                <br>
                <h4 style="color: #D4AF37; margin-bottom: 15px;">Integration:</h4>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Added to index.php fun-facts section</li>
                    <li>CSS and JS files included</li>
                    <li>Clickable statistics with tooltips</li>
                    <li>Seamless user experience</li>
                </ul>
            </div>
        </div>

        <div style="text-align: center; margin: 40px 0;">
            <a href="index.php" style="display: inline-block; padding: 15px 30px; background: #D4AF37; color: white; text-decoration: none; border-radius: 25px; margin: 10px; font-weight: 600;">
                🏠 View Live Homepage
            </a>
            <a href="contact-us.php" style="display: inline-block; padding: 15px 30px; background: #2C2C2C; color: white; text-decoration: none; border-radius: 25px; margin: 10px; font-weight: 600;">
                📞 Test Contact Form
            </a>
        </div>
    </div>

    <!-- Include the modal JavaScript -->
    <script src="reviews-likes-modal.js"></script>
</body>
</html>
