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



            $html .= "<h4>You have received a new message from ". strip_tags($_POST['name1'])."</h4>" ;
            $html .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $html .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name1']) . "</td></tr>";
            $html .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email1']) . "</td></tr>";
            $html .= "<tr><td><strong>Telephone:</strong> </td><td>" . strip_tags($_POST['phone1']) . "</td></tr>";
            $html .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message1']) . "</td></tr>";
    
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
$mail->Password = "nick3484";
$mail->SetFrom("myqualitia@gmail.com");
$mail->Subject = 'New Email From MyQualitia';
$mail->Body = $html;
$mail->AddAddress("myqualitia@gmail.com");

 if(!$mail->Send()) {
    echo "error";
 } else {
    echo " ";
 }

header( "refresh:5;url= https://myqualitia.com/" );



?>


<html lang="en">
<head>
  <!-- Title -->
  <title>MyQualitia</title>

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

        
        

    <title>Thank you</title>
    <style>
      body{
        background-color: #e39a1b;
          }
        .lead{
            text-align: center;
        }
        .btn-padding{
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="row full-height" >
            <div>
                <div class="fetured-text ">
                <h1 class="white">Thank You!</h1>
                    <p class="lead "><strong>According to the content of your message, you will receive a reply back shortly.</strong> You will be directed back to the site after 5 seconds</p>
                    <hr>
              
                    <div class="btn-padding">
                      <a class="btn lead btn-padding" href="https://MyQualitia.com" role="button">Continue to homepage</a>
                    </div>
                </div>
              </div>

    </div>




 
</body>
</html>