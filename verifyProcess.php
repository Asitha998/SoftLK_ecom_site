<?php

session_start();
require "connection.php";

if (isset($_GET["v"])) {
    
    $v = $_GET["v"];

    $admin = Database::search("SELECT * FROM `admin` WHERE `varification_code`='".$v."'");
    $num = $admin->num_rows;

    if ($num == 1) {
        $admin_data = $admin->fetch_assoc();
        $_SESSION["au"] = $admin_data;
        echo ("SUCCESS");
    }else {
        echo ("invalid verification code.");
    }

}else {
    echo ("Please enter your verification code");
}

?>