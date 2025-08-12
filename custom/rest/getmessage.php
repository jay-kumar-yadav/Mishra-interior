<?php
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
/* * *******$message = "";
  $in = 1;
  $message = $message . "<table style='border:1px black solid;'><tr><th>Sr No</th><th>Items</th><th>Quantity</th><th>Comment</th></tr>";
  for ($i = 4; $i < count($myArr); $i++) {
  if ($myArr[$i][1] == "" || $myArr[$i][2] == "")
  continue;
  $message = $message . '<tr><td style="border-top:1px black solid;">' . $in++ . '</td><td style="border-top:1px black solid;border-left:1px black solid;">' . $myArr[$i][1] . '</td><td style="border-top:1px black solid;border-left:1px black solid;">' . $myArr[$i][2] . '</td><td style="border-top:1px black solid;border-left:1px black solid;">' . $myArr[$i][3] . '</td></tr>';
  }
  $message = $message . "</table>";
  echo $message;
  print_r($myArr);************** */
if ($sms->send_sms($myArr) == true) {
    $message = "Message Sent Successfuly";
    header("location:enquiry.php?confirm=" . $message);
} else {
    $message = "Message could not be sent...";
    header("location:enquiry.php?confirm=" . $message);
}
?>