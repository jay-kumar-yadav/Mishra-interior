<?php

//**********************//
//Organiztion - MehtaTechnolog
//Developer - Pappu Mehta
//Date - 10072017
//**********************//

class mail {

    //This funciton will send mail based on function type and unique idate
    //Funciton type = on what process what mail need to send
    //Unique id will hold the primary key value so we can fetch the details for mail
    //Public Attribute

    public $arr = "";

    function send_mail($details) {
        //This variable will have parameter from caller program
        //$arr = explode("#", $details); //[Email#Name]

        //$to = $details[2]; //Email address
        $to = "rajesh@mishrainteriors.com"; //Change Email id accourding to requirment
        $subject = "Mishra Interior-Quotation/Enquiry";

       
        
        $message = "Hello,\nRajesh Kumar \n\n";
        $message = $message . "Email id = $details[2] \n";
        $message = $message . "Mobile No = $details[3] \n";
        $message = $message . "Quotation Date = $details[1]\n\n";
        
        $message = $message . "Your have recived new quotation from Mr. $details[0] \n";
        $message = $message . "Let me know the purchase order regrding this quotation.";
        
        $message = $message . "\n\n\n Quotation Details are below :-\n\n";
        $message = $message . "Sr No     "."Items     "."Quantity     "."Comment\n\n";
        $in = 1;
        for ($i = 4; $i < count($details); $i++) {
            if ($details[$i][1] == "" || $details[$i][2] == "")
                continue;
            $message = $message .$in."         ".$details[$i][1]."     ".$details[$i][2]."     ".$details[$i][3]."\n";
            //     $details[$i][2]     $details[$i][3] \n";
//            $message = $message . $details[$i][1];
            $in = $in + 1;
        }
        
        $message = $message . "\n\n\nThanks and Regard \n$details[0]";

        $header = "From:No-Reply@mishrainterior.com \r\n"; //Change Email id accourding to requirment

        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/plain\r\n";

        $retval = mail($to, $subject, $message, $header);

        if ($retval == true) {
            //echo "Message sent successfully...";
            return true;
        } else {
            //echo "Message could not be sent...";
            return false;
        }
    }

//Closing of Method
}

//Closing of Class