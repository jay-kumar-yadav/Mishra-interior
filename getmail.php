<?php
session_start();
include 'cl_mail.php';
$mail = new mail();

//for sms
include 'cl_sms.php';
$sms = new sms();

$myArr = array($_REQUEST['name'], $_REQUEST['datetbx'], $_REQUEST['mail'], $_REQUEST['contact']);
$myJSON = json_encode($myArr);
$arr = array();
$n = 0;
foreach ($_REQUEST['srno'] as $srno) {
    array_push($myArr, Array($srno, $_REQUEST['item'][$n], $_REQUEST['quantity'][$n], $_REQUEST['comment'][$n]));
    $n++;
}
/* * **
  $message = "<p style='color:darkorange;'>Hello " . $myArr[0] . "</p>";
  $message = $message . "<p><b>Your mishrainteriors.in quotation</b><br/><br/>";
  $message = $message . "We thought you'd like to know that we've verify your quotation.<br/>Your selection details is as follows:</p>";
  $message = $message . "<table style='border:1px black solid;'><tr><th>Sr No</th><th>Items</th><th>Quantity</th><th>Comment</th></tr>";
  $in = 1;
  for ($i = 4; $i < count($myArr); $i++) {
  if ($myArr[$i][1] == "" || $myArr[$i][2] == "")
  continue;
  $message = $message . '<tr><td style="border-top:1px black solid;">' . $in++ . '</td><td style="border-top:1px black solid;border-left:1px black solid;">' . $myArr[$i][1] . '</td><td style="border-top:1px black solid;border-left:1px black solid;">' . $myArr[$i][2] . '</td><td style="border-top:1px black solid;border-left:1px black solid;">' . $myArr[$i][3] . '</td></tr>';
  }
  $message = $message . "</table>";
  $message = $message . "<p>Thanks for taking interest!</p>";
  echo $message;
 */

//send sms
//print_r($myArr);
$$message = "";
$captcha;
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
if (!$captcha) {
    $_SESSION['confirm']="Please check the the captcha form.";
    header("location:contact-us.php");
    exit;
}
$secretKey = "6Lfgvj0UAAAAAHFD3UcoLRB7ssS_IQVHq-FJV1ry";
$ip = $_SERVER['REMOTE_ADDR'];
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
$responseKeys = json_decode($response, true);
if (intval($responseKeys["success"]) !== 1) {
    $_SESSION['confirm']="You are spammer !";
    header("location:contact-us.php");
    //echo '<h2>You are spammer ! Get the @$%K out</h2>';
} else {
    if ($mail->send_mail($myArr) == true) {
        $sms->send_sms($myArr);
        $_SESSION['confirm']="Email/SMS Sent Successfuly-They Will Contact Soon... !";
        //$message = "Email/SMS Sent Successfuly-They Will Contact Soon... !";
        header("location:contact-us.php");
    } else {
        $_SESSION['confirm']="Notification could not be sent ! Please Try ...";
        //$message = "Notification could not be sent ! Please Try ...";
        header("location:contact-us.php");
    }
}
?>