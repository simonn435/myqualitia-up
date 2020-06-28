<?php

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug =0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "myqualitia@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Laura3582";

// keeps the current $mail settings and creates new object
$mail1 = clone $mail;

//Set who the message is to be sent from
$mail->setFrom('myqualitia@gmail.com', 'MyQualitia');
//For user mail set who the message is to be sent from
$mail1->setFrom('myqualitia@gmail.com', 'MyQualitia');
//Set an alternative reply-to address
$mail->addReplyTo('myqualitia@gmail.com', 'MyQualitia');

//Set who the message is to be sent to
$mail->addAddress('myqualitia@gmail.com', 'MyQualitia');
//For user mail set who the message is to be sent to
$mail1->addAddress($_POST['email'], 'MyQualitia');
//$mail->addAddress($_POST['emailaddress'] , 'MogulMatter');

//Set the subject line
$mail->Subject = 'MyQualitia Order Submission';
//For user mail set the subject line
$mail1->Subject = 'MyQualitia Order Submission';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$html .= "<h4>You have received a new message from ". strip_tags($_POST['name'])."</h4>" ;
$html .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$html .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
$html .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
$html .= "<tr><td><strong>Address:</strong> </td><td>" . strip_tags($_POST['address']) . "</td></tr>";
$html .= "<tr><td><strong>City:</strong> </td><td>" . strip_tags($_POST['city']) . "</td></tr>";
$html .= "<tr><td><strong>State:</strong> </td><td>" . strip_tags($_POST['state']) . "</td></tr>";
$html .= "<tr><td><strong>Zip:</strong> </td><td>" . strip_tags($_POST['zip']) . "</td></tr>";
$html .= "<tr><td><strong>Telephone:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
$html .= "<tr><td><strong>Sodium:</strong> </td><td>" . strip_tags($_POST['sodium']) . "</td></tr>";
$html .= "<tr><td><strong>Sulfate:</strong> </td><td>" . strip_tags($_POST['sulfate']) . "</td></tr>";
$html .= "<tr><td><strong>FreeAcid:</strong> </td><td>" . strip_tags($_POST['freeacid']) . "</td></tr>";
$html .= "<tr><td><strong>FreeAcid:</strong> </td><td>" . strip_tags($_POST['qreserve']) . "</td></tr>";
$html .= "<tr><td><strong>Blend:</strong> </td><td>" . strip_tags($_POST['blend']) . "</td></tr>";
$html .= "<tr><td><strong>Shipping:</strong> </td><td>" . strip_tags($_POST['shipping']) . "</td></tr>";
$html .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
$response = $_POST["g-recaptcha-response"];
$html .= "<tr><td><strong>User Agreed:</strong> </td><td>" .implode("," , $_POST['useragrement']).'</p>';


    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6Ldm46gZAAAAADUHvmga1JIvYOrCU_YiZ2oCcqST',
        'response' => $_POST["g-recaptcha-response"]
    );
    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success=json_decode($verify);

    if ($captcha_success->success==false) {
        header('Location: https://www.myqualitia.com/404.html');
        die;
    } 

$html1 = "<p>Hello ".$_POST['name']."</p>

<p>Thank you for your order.</p>

<p>We'll be reaching out to you shortly about payment information and confirm your order</p>

<p>Thank you, <br> MyQualitia</p>";

$mail->msgHTML($html);

$mail1->msgHTML($html1);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

$mail1->AltBody = 'This is a plain-text message body';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} elseif(!$mail1->send()){ 
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{    echo "";

    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}


//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
/*
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}*/

header( "refresh:5;url= https://myqualitia.com/" );


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Title -->
  <title>MyQualitia | Home</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.ico">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css">
  <link rel="stylesheet" href="assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="assets/vendor/hs-video-bg/dist/hs-video-bg.min.css">
  <link rel="stylesheet" href="assets/vendor/aos/dist/aos.css">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="assets/css/theme.css">
</head>
<body>
    <div class="container">
    <div class="row full-height" >
            <div>
                <div class="fetured-text ">
                <h1 class="white">Thank You!</h1>
                    <p class="lead "><strong>According to the content of your message, you will receive a reply back shortly.</strong> You will be directed back to the site after 5 seconds</p>
                    <hr>
              
                    <div class="btn-padding">
                      <a class="btn lead btn-padding" href="https://myqualitia.com" role="button">Continue to homepage</a>
                    </div>
                </div>
              </div>
        </div>
    </div>




 
</body>
</html>