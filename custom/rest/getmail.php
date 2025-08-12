<?php

session_start();
include 'cl_mail.php';
$mail = new mail();

//for sms
include 'cl_sms.php';
$sms = new sms();

$myArr = array($_REQUEST['p_contact_name'], $_REQUEST['p_contact_date'], $_REQUEST['p_contact_email'], $_REQUEST['p_contact_number']);
$myJSON = json_encode($myArr);
$arr = array();
$n = 0;
foreach ($_REQUEST['srno'] as $srno) {
    array_push($myArr, Array($srno, $_REQUEST['item'][$n], $_REQUEST['quantity'][$n], $_REQUEST['comment'][$n]));
    $n++;
}

/* if ($mail->send_mail($myArr) == true) {
  $sms->send_sms($myArr);
  echo "Email/SMS Sent Successfuly-They Will Contact Soon... !";
  } else {
  echo "Notification could not be sent ! Please Try ...";
  } */

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
$captcha;
if (isset($_REQUEST['g-recaptcha-response'])) {
    $captcha = $_REQUEST['g-recaptcha-response'];
}
if (!$captcha) {
    echo "Please check the the captcha form.";
}
$secretKey = "6Lfgvj0UAAAAAHFD3UcoLRB7ssS_IQVHq-FJV1ry";
$ip = $_SERVER['REMOTE_ADDR'];
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
$responseKeys = json_decode($response, true);
if (intval($responseKeys["success"]) !== 1) {
    echo "You are spammer !";
} else {
    if ($mail->send_mail($myArr) == true) {
        $sms->send_sms($myArr);
        echo "Email/SMS Sent Successfuly-They Will Contact Soon... !";
    } else {
        echo "Notification could not be sent ! Please Try ...";
    }
}
?>