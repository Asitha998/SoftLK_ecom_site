<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid();

        Database::iud("UPDATE `user` SET `varification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        // email code
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kollaseedsr@gmail.com';
        $mail->Password = 'xgurknjxnfkpaazq';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('kollaseedr@gmail.com', 'Admin Verification');
        $mail->addReplyTo('kollaseedr@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Admin Login Verification Code.';
        $bodyContent = '<h1 style="color:blue">Your Varification code is <p style="color:red"> '.$code.' </p><h1/>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo("Varification code send failed");
        }else {
            echo("SUCCESS");
        }

    } else {
        echo ("Invalid Email address.");
    }
}
