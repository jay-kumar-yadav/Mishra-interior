<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <![endif]-->
        <meta name="keywords" content="Mishar Interios,Wallpaper,Wooden Flooring,
              Carpet,Vinyl,Sport Flooring,Blinds,Sera Board,Deck Wood Flooring,Wall Paintaing,Interior
              Rubber Flooring,
              Mehta Techno"/>
        <meta name="description" content="Mishra Interiors - Responsive HTML Template for Interior Design and Decoration" />
        <meta name="author" content="mehtatechno.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Mishra Interiors - Interior Design and Decoration</title>

        <link rel="icon" href="image/0.png" type="image/x-icon">

        <!--  <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
  
          <link href="main.css" rel="stylesheet">-->
        <link href="main.css" rel="stylesheet">
        <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>

        <link href="assets/plugins/bootstrapdialog/bootstrap-dialog.css" rel="stylesheet" type="text/css"/>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <style>
            td{
                padding:10px;
            }
            table{
                width:100%;
            }
            th{
                padding-left: 10px;
            }
            .msg_error_recaptcha
            { 
                color: #c65848;
            }
            .g-recaptcha.error_recaptcha
            { 
                border: solid 2px #c64848; 
                padding: .2em; 
                width: 22.5em;
            }
            .wa-box-style2.contact-box {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.wa-box-style2.contact-box .text {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.wa-box-style2.contact-box .text p {
    flex-grow: 1;
    margin-bottom: 0;
}

/* Ensure all columns have equal height */
.row.equal-height {
    display: flex;
    flex-wrap: wrap;
}

.row.equal-height > [class*='col-'] {
    display: flex;
    flex-direction: column;
}
   :root {
            --primary-color: #DCA44B;      
            --accent-color: #DCA44B;       
            --light-bg: #f5f5f5;           
            --text-color: #ffffff;         
            --border-color: #555555;       
            --error-color: #e74c3c;        
            --success-color: #27ae60;      
            --dark-bg: #323232;            
            --card-bg: #424242;           
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .centered-title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .centered-title h2 {
            font-weight: 600;
            color: var(--accent-color);
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .centered-title h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-color);
        }
        
        .form-section {
            background: var(--card-bg);
            border-radius: 5px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 12px 15px;
            width: 100%;
            transition: all 0.3s;
            background: #555;
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(230, 126, 34, 0.2);
            outline: none;
            background: #666;
        }
        
        .form-control::placeholder {
            color: #ccc;
        }
        
        .required {
            color: var(--error-color);
        }
        
        .items-table {
            width: 100%;
            margin: 25px 0;
            border-collapse: collapse;
            border: 1px solid var(--border-color);
        }
        
        .items-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .items-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .items-table input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background: #555;
            color: white;
        }
        
        .items-table input:focus {
            background: #666;
        }
        
        .items-table tr {
            background-color: var(--card-bg);
        }
        
        .items-table tr:nth-child(even) {
            background-color: #4a4a4a;
        }
        
        .theme-button {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
            margin-top: 20px;
        }
        
        .theme-button:hover {
            background: #d35400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .add-item-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .add-item-btn:hover {
            background: #1a252f;
        }
        
        .remove-item-btn {
            background: var(--error-color);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 5px;
            font-size: 12px;
        }
        
        .remove-item-btn:hover {
            background: #c0392b;
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        
        .alert-danger {
            background-color: #e74c3c;
            color: white;
            border: 1px solid #c0392b;
        }
        
        .alert-info {
            background-color: #3498db;
            color: white;
            border: 1px solid #2980b9;
        }
        
        .alert-success {
            background-color: #27ae60;
            color: white;
            border: 1px solid #219653;
        }
        
        .g-recaptcha {
            margin: 20px 0;
            transform: scale(0.90);
            transform-origin: left center;
        }
        
        .section-title {
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-color);
            color: var(--accent-color);
        }
        
        @media (max-width: 768px) {
            .items-table {
                display: block;
                overflow-x: auto;
            }
            .form-section {
                padding: 20px;
            }
        }
    </style>
 </style>
    </head>
    <body>
        <!--//==Preloader Start==//-->
        <div class="preloader">
            <div class="thecube">
                <div class="loader"></div>
                <h4>Loading</h4>
            </div>
        </div>
        <!--//==Preloader End==//-->  
        <!--//==Header Start==//-->
        <?php include 'header.php'; ?>
        <!--//==Header End==//-->
        <!--//==Page Header Start==//-->
        <div class="page-header black-overlay">
            <div class="container breadcrumb-section text-center">
                <div class="row pad-s15">
                    <div class="col-md-12">
                        <h2><span class="wa-theme-color">Contact Us</span></h2>
                        <div class="clear"></div>
                        <div class="breadcrumb-box">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="active">
                                    Contact Us
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//==Page Header End==//-->	
        <!--//=============Contact Info Start============//-->
        <section class="page_single padTB100 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <!--//==Section Heading Start==//-->
                                <div class="centered-title">
                                    <h2>Contact Info<span class="heading-shapes"><i></i><i></i><i></i></span></h2>
                                    <div class="clear"></div>

                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!--//==Section Heading End==//-->
                       <div class="row equal-height">
    <div class="col-md-4 col-sm-4">
        <div class="wa-box-style2 contact-box grey-bg">
            <div class="icon">	
                <i class="fa fa-map-o" aria-hidden="true"></i>
            </div>
            <div class="text">
                <h4>Address</h4>
                <p>Sai Krupa Venkateshwara Nilayam " bearing No. 165, 5th Cross, Janikiram Layout, Hennur Geddalahalli, Bangalore 560
                077,</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="wa-box-style2 contact-box grey-bg">
            <div class="icon">	
                <i class="fa fa-mobile" aria-hidden="true"></i>
            </div>
            <div class="text">
                <h4>Phone</h4>
                <p>
                    Rajesh:+91 9945623419,<br/>
                    Shambhu:+91 9632175490<br/>
                    Ashwin:+91 9380735528<br/>
                    <br/>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="wa-box-style2 contact-box grey-bg">
            <div class="icon">	
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </div>
            <div class="text">
                <h4>Email</h4>
             <p>
                    mishrainteriors.com-Bangalore, 
                    rajeshkumar1975b@gmail.com
                    Ashwinm8120@gmail.com
                </p>
                <br/>
            </div>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </section>
        <!--//=============Contact Info End============//-->		
        <!--//==Contact Form Section Start==//-->
        
        <section class="form-section">
        <div class="centered-title">
            <h2>Get In Touch<span class="heading-shapes"><i></i><i></i><i></i></span></h2>
        </div>
        
        <form id="contactForm" action="contact-form-handler.php" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Your Name <span class="required">*</span></label>
                        <input type="text" class="form-control" required name="name" id="nametbx" placeholder="Enter your full name">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date <span class="required">*</span></label>
                        <input type="date" class="form-control" required name="datetbx" id="datetbx">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" class="form-control" required name="email" id="emailtbx" placeholder="Enter your email address">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contact Number <span class="required">*</span></label>
                        <input type="tel" class="form-control" required name="phone" id="contbx" placeholder="Enter your 10-digit phone number" pattern="[0-9]{10}">
                    </div>
                </div>                                
            </div>
            
            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid #2c3e50;">Items Information</h4>
            
            <table class="items-table">
                <thead>
                    <tr>
                        <th width="10%">Sr No</th>
                        <th width="40%">Item</th>
                        <th width="20%">Quantity</th>
                        <th width="25%">Comment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody id="itemsTableBody">
                    <tr>
                        <td><input type="number" name="srno[]" class="srtbx" min="1" value="1" required/></td>
                        <td><input type="text" name="item[]" class="itemtbx" placeholder="Item name" required/></td>
                        <td><input type="number" name="quantity[]" class="quantbx" min="1" placeholder="Qty" required/></td>
                        <td><input type="text" name="comment[]" class="comtbx" placeholder="Any comments"/></td>
                        <td><button type="button" class="remove-item-btn" onclick="removeItem(this)">×</button></td>
                    </tr>
                </tbody>
            </table>
            
            <button type="button" class="add-item-btn" id="addItemBtn">
                <i class="fa fa-plus"></i> Add Another Item
            </button>
            
            <div id="show_error_message_form" style="margin: 20px 0;"></div>
            
            <button type="submit" class="theme-button">
                <i class="fa fa-paper-plane"></i> Send Message
            </button>
            
            <div class="fashion_infotext" style="margin-top: 20px;"></div>
        </form>
    </section>

    </div>
        <!--//==Contact Form Section End==//-->			
        <!--//==Contact Map Section Start==//-->
        <div class="page_single">
    <div class="container-fluid">
        <div class="row">
            <div class="">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.9650888031624!2d77.63784116482275!3d13.037894190812393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae17478ff95a9f%3A0xd67555513b0469c9!2sSai+Krupa+Venkateshwara+Nilayam%2C+165%2C+5th+Cross%2C+Janikiram+Layout%2C+Hennur+Geddalahalli%2C+Bengaluru%2C+Karnataka+560077!5e0!3m2!1sen!2sin!4v1512190021032" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
    </div>
    <!--//==Contact Map Section End==//-->		
    <!--//=========Footer Start=========//-->
    <?php include 'footer.php'; ?>

    <!--//=========Footer End=========//-->	  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/bootstrapdialog/bootstrap-dialog.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/plugins/menu/js/hover-dropdown-menu.js"></script> 
    <script type="text/javascript" src="assets/plugins/menu/js/jquery.hover-dropdown-menu-addon.js"></script>	
    <script src="assets/plugins/owl-carousel/js/owl.carousel.js"></script>	 
    <script src="assets/plugins/mixitup/js/jquery.mixitup.js"></script>	
    <script src="assets/plugins/fancymedia/js/jquery.fancybox.pack.js"></script>
    <script src="assets/plugins/fancymedia/js/jquery.fancybox-media.js"></script>  		
    <script type="text/javascript" src="assets/plugins/counter/js/jquery.countTo.js"></script> 
    <script type="text/javascript" src="assets/plugins/counter/js/jquery.appear.js"></script>  
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyApOXiWaaV5Xv4Wgjns-dDzNV-sMGf58O8"></script>

    <script src="assets/js/main.js"></script>
    <script src="custom/js/contactus.js" type="text/javascript"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
   // Add new item row
        document.getElementById('addItemBtn').addEventListener('click', function() {
            const tbody = document.getElementById('itemsTableBody');
            const rowCount = tbody.rows.length;
            const newRow = tbody.insertRow();
            
            newRow.innerHTML = `
                <td><input type="number" name="srno[]" class="srtbx" min="1" value="${rowCount + 1}" required/></td>
                <td><input type="text" name="item[]" class="itemtbx" placeholder="Item name" required/></td>
                <td><input type="number" name="quantity[]" class="quantbx" min="1" placeholder="Qty" required/></td>
                <td><input type="text" name="comment[]" class="comtbx" placeholder="Any comments"/></td>
                <td><button type="button" class="remove-item-btn" onclick="removeItem(this)">×</button></td>
            `;
        });
        
        // Remove item row
        function removeItem(button) {
            const row = button.parentNode.parentNode;
            if (document.getElementById('itemsTableBody').rows.length > 1) {
                row.parentNode.removeChild(row);
                // Update serial numbers
                const rows = document.getElementById('itemsTableBody').rows;
                for (let i = 0; i < rows.length; i++) {
                    rows[i].cells[0].querySelector('input').value = i + 1;
                }
            } else {
                alert("You need to have at least one item.");
            }
        }
        
        // Form validation and submission
       document.getElementById('addItemBtn').addEventListener('click', function() {
            const tbody = document.getElementById('itemsTableBody');
            const rowCount = tbody.rows.length;
            const newRow = tbody.insertRow();
            
            newRow.innerHTML = `
                <td><input type="number" name="srno[]" class="srtbx" min="1" value="${rowCount + 1}" required/></td>
                <td><input type="text" name="item[]" class="itemtbx" placeholder="Item name" required/></td>
                <td><input type="number" name="quantity[]" class="quantbx" min="1" placeholder="Qty" required/></td>
                <td><input type="text" name="comment[]" class="comtbx" placeholder="Any comments"/></td>
                <td><button type="button" class="remove-item-btn" onclick="removeItem(this)">×</button></td>
            `;
        });
        
        // Remove item row
        function removeItem(button) {
            const row = button.parentNode.parentNode;
            if (document.getElementById('itemsTableBody').rows.length > 1) {
                row.parentNode.removeChild(row);
                // Update serial numbers
                const rows = document.getElementById('itemsTableBody').rows;
                for (let i = 0; i < rows.length; i++) {
                    rows[i].cells[0].querySelector('input').value = i + 1;
                }
            } else {
                alert("You need to have at least one item.");
            }
        }
        
        // Form validation and submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            
            // Basic validation
            const name = document.getElementById('nametbx').value;
            const email = document.getElementById('emailtbx').value;
            const contact = document.getElementById('contbx').value;
            const date = document.getElementById('datetbx').value;
            
            if (!name || !email || !contact || !date) {
                document.getElementById('show_error_message_form').innerHTML = 
                    '<div class="alert alert-danger">Please fill all required fields.</div>';
                return;
            }
            
            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('show_error_message_form').innerHTML = 
                    '<div class="alert alert-danger">Please enter a valid email address.</div>';
                return;
            }
            
            // Validate phone number
            if (!/^[0-9]{10}$/.test(contact)) {
                document.getElementById('show_error_message_form').innerHTML = 
                    '<div class="alert alert-danger">Please enter a valid 10-digit phone number.</div>';
                return;
            }
            
            // Check if at least one item is filled
            const items = document.querySelectorAll('input[name="item[]"]');
            const quantities = document.querySelectorAll('input[name="quantity[]"]');
            let hasValidItem = false;
            
            for (let i = 0; i < items.length; i++) {
                if (items[i].value.trim() && quantities[i].value.trim()) {
                    hasValidItem = true;
                    break;
                }
            }
            
            if (!hasValidItem) {
                document.getElementById('show_error_message_form').innerHTML = 
                    '<div class="alert alert-danger">Please fill at least one item with quantity.</div>';
                return;
            }
            
            // Show loading message
            document.getElementById('show_error_message_form').innerHTML = 
                '<div class="alert alert-info">Sending your message...</div>';
            
            // Submit form via AJAX
            const formData = new FormData(this);
            
            fetch('contact-form-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('show_error_message_form').innerHTML = 
                        '<div class="alert alert-success">' + data.message + '</div>';
                    // Reset form
                    document.getElementById('contactForm').reset();
                    // Set today's date
                    const today = new Date().toISOString().split('T')[0];
                    document.getElementById('datetbx').value = today;
                } else {
                    document.getElementById('show_error_message_form').innerHTML = 
                        '<div class="alert alert-danger">' + data.message + '</div>';
                }
            })
            .catch(error => {
                document.getElementById('show_error_message_form').innerHTML = 
                    '<div class="alert alert-danger">Sorry, there was an error sending your message. Please try again or contact us directly.</div>';
                console.error('Error:', error);
            });
        });
        
        // Phone number validation
        document.getElementById('contbx').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });
        
        // Set today's date as default
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('datetbx').value = today;
        });
    </script>
</body>
</html>