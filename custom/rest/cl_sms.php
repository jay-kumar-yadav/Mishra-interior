<?php

//**********************//
//Organiztion - MehtaTechnolog
//Developer - Pappu Mehta
//Date - 10072017
//**********************//

class sms {

//This funciton will send mail based on function type and unique idate
//Funciton type = on what process what mail need to send
//Unique id will hold the primary key value so we can fetch the details for mail
    //Public Attribute

    public $arr = "";

    function send_sms($details) {

        //This variable will have parameter from caller program
        //$arr = explode("#", $details); //[Mobile No]
        //Your authentication key
        $authKey = "151389A7RqwJkQIaP590c7e40"; //this authkey is registred with mehta.techno@gmail.com
        //Multiple mobiles numbers separated by comma
        $mobileNumber = "9945623419";
        //$mobileNumber = $arr[3];

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "MISINT"; //Mishra Interior
        //Your message to send, Add URL encoding here.
        $message = urlencode("You got new Enquiry from : Mr. $details[0] and Mob No : $details[3] for more details please check email. Mishra Interiors");

        //Define route 
        $route = "4"; //Eg: route=1 for promotional, route=4 for transactional SMS.
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );

        //API URL
        $url = "http://api.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
                //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            //echo 'error:' . curl_error($ch);
        }

        curl_close($ch);
    }

}
