<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {
    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `varification_code`='".$code."' WHERE `email`='".$email."'");

        // email code
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kollaseedr@gmail.com';
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
        echo ("You are not a valid user");
    }
} else {
    echo ("Email field shoudn't be empty");
}
?>