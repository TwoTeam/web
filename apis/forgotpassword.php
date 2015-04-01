<?php
error_reporting(0);
include_once '../database.php';
$email = $_REQUEST["email"];

function randomPassword() {
    $alphabet = "abcdefghijklmnoprqstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 5; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

$rndPass = randomPassword();

if (!empty($email)) {
    $query = sprintf("UPDATE users SET hash='$rndPass' WHERE email='$email'");
    if (mysqli_query($link, $query)) {
        //echo "#uspelo";
    } else {
        if (mysql_errno($link) == 1052) {
            //echo "Neki si zamuštru!";
        } else {
            //echo "Uspel mi je!";
        }
    }
} else {
}

if (!empty($email)) {
    /**
     * This example shows settings to use when sending via Google's Gmail servers.
     */
    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');
    require '../mailer/PHPMailerAutoload.php';
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "eventhub1337@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "jebemtigeslo";

    //Set who the message is to be sent from
    $mail->setFrom('reset@eventhub.com', 'EventHub');

    //Set who the message is to be sent to
    $mail->addAddress($email, "");

    //Set the subject line
    $mail->Subject = 'Ponastavitev gesla';

    $mail->IsHTML(true);
    $mail->AddEmbeddedImage('../mailer/examples/images/ikona.png', 'logo');

    $mail->Body = '<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
				<div align="center">
				<a href="http://veligovsek.si/events/"><img src="cid:logo" height="40" width="40" alt=""></a>
				<h1>Pozdravljen,</h1>
				<p>Poslal si zahtevo za pozabljeno geslo.</p>
				<p>S klikom na spodnjo povezavo si lahko spremeniš svoje geslo.</p>
				<p><a href=http://veligovsek.si/events/changepassword.php?hash=' . $rndPass . '>Klikni tukaj</a></p>
				</div>
			  </div>';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('../mailer/examples/contents.html'), dirname(__FILE__));
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    //Attach an image file
    // $mail->addAttachment('images/phpmailer_mini.png'); #TegaNeNucamo
    //send the message, check for errors
    if (!$mail->send()) {
        $response["result"][] = array("response" => true, "message" => "Napaka v posiljanju: " . $mail->ErrorInfo);
    } else {
        $response["result"][] = array("response" => true, "message" => "Sporocilo poslano");
    }
}

echo json_encode($response);
