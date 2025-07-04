<?php

session_start();
require "connection.php";

if (isset($_SESSION["p"])) {
    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];

    if (empty($title)) {
        echo ("Please Enter a Title.");
    } else if (strlen($title) >= 100) {
        echo ("Title shoud have lower than 100 characters.");
    } else {

        $length = sizeof($_FILES);
        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        Database::iud("DELETE FROM `images` WHERE `product_id`='" . $pid . "'");

        if ($length <= 3 && $length > 0) {

            for ($x = 0; $x < $length; $x++) {
                if (isset($_FILES["i" . $x])) {

                    $img_file = $_FILES["i" . $x];
                    $file_type = $img_file["type"];

                    if (in_array($file_type, $allowed_img_extentions)) {

                        $new_img_extention;

                        if ($file_type == "image/jpg") {
                            $new_img_extention = ".jpg";
                        } else if ($file_type == "image/jpeg") {
                            $new_img_extention = ".jpeg";
                        } else if ($file_type == "image/png") {
                            $new_img_extention = ".png";
                        } else if ($file_type == "image/svg+xml") {
                            $new_img_extention = ".svg";
                        }

                        $file_name = "products images/" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                        move_uploaded_file($img_file["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('" . $file_name . "','" . $pid . "')");

                        // echo ("ok");
                    } else {
                        echo ("File type not allowed");
                    }
                }
            }

            echo ("Product images has been updated");
        } else {
            echo ("Invalid image count!!!");
        }
    }
}
