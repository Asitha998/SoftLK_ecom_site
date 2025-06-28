<?php

session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["email"]) && isset($_POST["name"])) {
    if ($_SESSION["au"]["email"] == $_POST["email"]) {

        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `category_name` LIKE '%" . $cname . "%'");
        $category_num = $category_rs->num_rows;

        if ($category_num == 0) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `varification_code`='" . $code . "' WHERE `email`='" . $umail . "'");

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
            $mail->addAddress($umail);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Admin Verification Code for Add New Category.';
            $bodyContent = '<h1 style="color:red">Your Varification code is <p style="color:green"> ' . $code . ' </p><h1/>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo ("Varification code send failed");
            } else {
                echo ("SUCCESS");
            }
            // email code
        } else {
            echo ("This category Already Exist");
        }
    } else {
        echo ("Invalid User");
    }
} else {
    echo ("Something Went Wrong");
}
