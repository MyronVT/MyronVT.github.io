<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Replace this with your own email address
$siteOwnersEmail = 'agency.mynk@gmail.com';


if (isset($_POST)) {

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $subject = trim(stripslashes($_POST['contactSubject']));
    $contact_message = trim(stripslashes($_POST['contactMessage']));

    // Check Name
    if (strlen($name) < 2) {
        $error['name'] = "Please enter your name.";
    }
    // Check Email
    if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
        $error['email'] = "Please enter a valid email address.";
    }
    // Check Message
    if (strlen($contact_message) < 15) {
        $error['message'] = "Please enter your message. It should have at least 15 characters.";
    }
    // Subject
    if ($subject == '') { $subject = "Contact Form Submission"; }


    // Set Message
    $message .= "Email from: " . $name . "<br />";
    $message .= "Email address: " . $email . "<br />";
    $message .= "Message: <br />";
    $message .= $contact_message;
    $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

$output="";

    if (!$error) {

			$mail = new PHPMailer;
			$mail->From = "info@86595.ict-lab.nl";
			$mail->FromName = "MYNK";
			$mail->addAddress($siteOwnersEmail);
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			if($mail->send()) {
					mail("humtum.sham@gmail.com","OK","OK");
			} else {
					mail("humtum.sham@gmail.com","NOT OK","NOT OK");
			}
      		 echo "OK"; 
    }   else {
			
		foreach($error as $er) {

			$output .= $er."<br>";
		}

		echo $output;
			
    } # end if - there was a validation error

}
?>