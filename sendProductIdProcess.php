<?php

session_start();

require "connection.php";

$email = $_SESSION["u"]["email"];
$pid = $_GET["id"];

// echo ($email);
// echo ($pid);

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' AND `user_email`='".$email."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){

    $product_data = $product_rs->fetch_assoc();

    $_SESSION["p"] = $product_data;
    echo ("SUCCESS");

}else{

    echo ("Something went wrong");

}

// WHERE `id`='".$product["category_id"]."'
?>