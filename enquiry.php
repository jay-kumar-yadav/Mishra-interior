
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
        <title>Mishra Interiors-Interior Design and Decoration</title>

        <link rel="icon" href="image/0.png" type="image/x-icon">
        <!-- Master Css -->
        <link href="main.css" rel="stylesheet">
        <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrapdialog/bootstrap-dialog.css" rel="stylesheet" type="text/css"/>
     

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
                        <h2><span class="wa-theme-color">Enquiry Us</span></h2>
                        <div class="clear"></div>
                        <div class="breadcrumb-box">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="active">
                                    Enquiry
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//==Page Header End==//-->
        <!--//==Contact Map Section Start==//-->
        <!--<div class="page_single">
            <div class="container-fluid">
                <div class="row">
                    <div class="map-sections">
                        <div id="gmap_canvas"></div>
                    </div>
                </div>
            </div>
        </div>-->
        <!--//==Contact Map Section End==//-->		
        <!--//==Contact Form Section Start==//-->
        <section class="page_single">
            <div class="container">
                <div class="row contact-bottom padTB100">
                    <!--//==Section Heading Start==//-->
                    <div class="col-md-12">
                        <!--//==Section Heading Start==//-->
                        <div class="centered-title">
                            <h2>Get In Touch<span class="heading-shapes"><i></i><i></i><i></i></span></h2>
                            <div class="clear"></div>

                        </div>
                    </div>
                    <!--//==Section Heading End==//-->
                    <!--//==Form Area Start==//-->
                    <div class="col-md-12 left-box">
                        <form id="fashion_contactform" method="post" action="getmessage.php">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Your Name<span class="required red-text">*</span></label>
                                        <input type="text" required name="name" id="nametbx">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date<span class="required red-text">*</span></label>
                                        <input type="date"  required name="datetbx" id="datetbx">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email"  required name="mail" id="emailtbx">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Contactno</label>
                                        <input type="number" required  name="contact" id="contbx">
                                    </div>
                                </div>                                
                            </div>
                            <table>
                                <thead>

                                <th> Srno</th>
                                <th> Item</th>
                                <th>Quantity</th>
                                <th>Comment</th>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:10%;"><input type="number" name="srno[]" id="srtbx"/></td>
                                        <td><input type="text" name="item[]" id="itemtbx"/></td>
                                        <td style="width:15%;"><input type="number" name="quantity[]" id="quantbx"/></td>
                                        <td><input type="text" name="comment[]" id="comtbx"/></td>
                                    </tr> 
                                    <tr>
                                        <td><input type="number" name="srno[]" id="srtbx"/></td>
                                        <td><input type="text" name="item[]" id="itemtbx"/></td>
                                        <td><input type="number" name="quantity[]" id="quantbx"/></td>
                                        <td><input type="text" name="comment[]" id="comtbx"/></td>

                                    </tr>
                                    <tr>
                                        <td><input type="number" name="srno[]" id="srtbx"/></td>
                                        <td><input type="text" name="item[]" id="itemtbx"/></td>
                                        <td><input type="number" name="quantity[]" id="quantbx"/></td>
                                        <td><input type="text" name="comment[]" id="comtbx"/></td>
                                    </tr>
                                    <tr>
                                        <td><input type="number" name="srno[]" id="srtbx"/></td>
                                        <td> <input type="text" name="item[]" id="itemtbx"/></td>
                                        <td> <input type="number" name="quantity[]" id="quantbx"/></td>
                                        <td> <input type="text" name="comment[]" id="comtbx"/></td>

                                    </tr>
                                    <tr>
                                        <td><input type="number" name="srno[]" id="srtbx"/></td>
                                        <td><input type="text" name="item[]" id="itemtbx"/></td>
                                        <td><input type="number" name="quantity[]" id="quantbx"/></td>
                                        <td><input type="text" name="comment[]" id="comtbx"/></td>

                                    </tr>
                                </tbody>
                            </table>


                            <div class="col-sm-12 form-group">
                                <input type="submit" class="theme-button" value="Send Mail">
                                <div class="fashion_infotext"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--//==Contact Form Section End==//-->	
        <!--//=============Contact Info Start============//-->
        <section class="page_single padTB100 text-center dark-section">
            <div class="special-style-full special-style-dark">
                <div class="bg-image parallax-style contact-us-bg"></div>
            </div>
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
                            </div>
                            <div class="clear"></div>
                            <!--//==Section Heading End==//-->
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="wa-box-style2 contact-box grey-bg">
                                        <div class="icon">	
                                            <i class="fa fa-map-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h4>Address</h4>
                                            <p>#06,Hennur Bande,Byraveshwara Layout Main Road,Kalyan Nagar Post Bangalore -560043</p>

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
                                                +91 9945623419,<br/>
                                                +91 9632175490<br/>
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
                                                mishrainteriors.com, 
                                                shambhu@mishrainteriors.com
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
        <script>
<?php
if (isset($_GET['confirm']))
//echo "alert('".$_GET['confirm']."');";
    echo "BootstrapDialog.show({
                                    title: 'Message !',
                                    message: '" . $_GET['confirm'] . "',
                                    type: BootstrapDialog.TYPE_WARNING,
                                    size: BootstrapDialog.SIZE_SMALL

                                });";
?>
        </script>
    </body>
</html>