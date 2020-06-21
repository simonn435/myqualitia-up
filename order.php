<?php

//Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// require '../vendor/autoload.php';

$mail = new PHPMailer(); // create a new object
    $html = ' <div class = "row"><img src="assets/svg/logos/logo.png" alt="Website Change Request" /></div>';



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
            $html .= "<tr><td><strong>Blend:</strong> </td><td>" . strip_tags($_POST['blend']) . "</td></tr>";
            $html .= "<tr><td><strong>Shipping:</strong> </td><td>" . strip_tags($_POST['shipping']) . "</td></tr>";
            $html .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
            $html .= "<tr><td><strong>User Agreed:</strong> </td><td>" .implode("," , $_POST['useragrement']).'</p>';
    
            $html .= "</table>";


    $mail->msgHTML($html);


$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "myqualitia@gmail.com";
$mail->Password = "nova92716";
$mail->SetFrom("myqualitia@gmail.com");
$mail->Subject = 'New Email From MyQualitia';
$mail->Body = $html;
$mail->AddAddress("myqualitia@gmail.com");

 if(!$mail->Send()) {
    echo " ";
 } else {
    echo " ";
 }

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