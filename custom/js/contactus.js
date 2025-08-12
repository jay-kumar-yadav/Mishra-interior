/******************   this function checks the number and its length     ***************************/
function isNumberKey(evt, limitField, limitNum) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        //showErrorMsg($(limitField),$(limitField),"Not");
        return false;
    }
    if (limitField.value.length === limitNum) {
        //showErrorMsg($(limitField),$(limitField),"Not");
        return false;
    }
    return true;

}
function showErrorMsg($showMsgafter, $inputBoxId, $msg)
{
    $showMsgafter.next("span#errmsg").remove();
    $showMsgafter.after('<span id="errmsg" style="color:red;font-size:12px;">' + $msg + "</span>");
    $bb = $inputBoxId.css("border");
    $inputBoxId.css("border-bottom", "#da4f49 solid 1px");
    $inputBoxId.on("input", function () {
        $showMsgafter.next("span").remove();
        $inputBoxId.css("border", $bb);
        $inputBoxId.unbind("input");
    });
}
function sendmail()
{
    //alert("send mail");
    var p_contact_name, p_contact_date, p_contact_email, p_contact_number;
    p_contact_name = $("#nametbx").val();
    p_contact_date = $("#datetbx").val();
    p_contact_email = $("#emailtbx").val();
    p_contact_number = $("#contbx").val();
    
    /**** validation of form elemnet   ****/
    if (p_contact_name == "")
    {
        showErrorMsg($("#nametbx"), $("#nametbx"), "Required !");
        $("#nametbx").focus();
        return false;
    }
    if (p_contact_date == "")
    {
        showErrorMsg($("#datetbx"), $("#datetbx"), "Required !");
        $("#datetbx").focus();
        return false;
    }
    if (p_contact_email == "")
    {
        showErrorMsg($("#emailtbx"), $("#emailtbx"), "Required !");
        $("#emailtbx").focus();
        return false;
    }
    if (p_contact_number == "")
    {
        showErrorMsg($("#contbx"), $("#contbx"), "Required !");
        $("#contbx").focus();
        return false;
    }

    /*check captcha*/

    var $captcha = $('#recaptcha'), response = grecaptcha.getResponse();
    if (response.length === 0)
    {
        $('.msg_error_recaptcha').text("reCAPTCHA is mandatory");
        if (!$captcha.hasClass("error_recaptcha"))
        {
            $captcha.addClass("error_recaptcha");
            return false;
        }
    }

    $('.msg_error_recaptcha').text('');
    $captcha.removeClass("error_recaptcha");
    //alert('reCAPTCHA marked');

    var srno = [];
    var items = [];
    var quantity = [];
    var comment = [];
    var itemsurl = "";
    $("input[name='srno']").each(function () {
        srno.push($(this).val());
    });
    $("input[name='item']").each(function () {
        items.push($(this).val());
    });
    $("input[name='quantity']").each(function () {
        quantity.push($(this).val());
    });
    $("input[name='comment']").each(function () {
        comment.push($(this).val());
    });
    for (var i = 0; i < srno.length; i++)
    {
        itemsurl += "&srno[]=" + srno[i] + "&item[]=" + items[i] + "&quantity[]=" + quantity[i] + "&comment[]=" + comment[i];
    }
    var strURL = "custom/rest/getmail.php?p_contact_name=" + p_contact_name + "&p_contact_date=" + p_contact_date + "&p_contact_email=" + p_contact_email + "&p_contact_number=" + p_contact_number+"&g-recaptcha-response="+document.getElementsByName("g-recaptcha-response")[0].value + itemsurl;
    var req = new XMLHttpRequest();
    req.open("get", strURL, true);
    req.send();
    //alert(strURL);
    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200)
        {
            try {
                BootstrapDialog.show({
                    title: 'Message !',
                    message:req.responseText,
                    type: BootstrapDialog.TYPE_WARNING,
                    size: BootstrapDialog.SIZE_SMALL

                });
                //alert(req.responseText);
                //document.getElementById("show_error_message_form").innerHTML = req.responseText;                
            } catch (err)
            {
                //document.getElementById("show_error_message_form").innerHTML = err.message;
            }
        }
    };
}
