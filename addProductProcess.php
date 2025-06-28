<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["br"];
$type = $_POST["ty"];
$title = $_POST["t"];
$link = $_POST["link"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

if ($category == "0") {
    echo ("Please Select a Category.");
}else if ($brand == "0") {
    echo ("Please Select a Brand.");
}else if ($type == "0") {
    echo ("Please Select a Type.");
}else if (empty($title)) {
    echo ("Please Enter a Title.");
}else if (strlen($title) >= 100) {
    echo ("Title shoud have lower than 100 characters.");
}else if (empty($link)) {
    echo ("Please add a trailer link.");
}else if (empty($qty)) {
    echo ("Please Enter the Quantity.");
}else if ($qty == "0" | $qty == "e" | $qty < 0) {
    echo ("Invalid input for Quantity.");
}else if (empty($cost)) {
    echo ("Please Enter the Price for the Product.");
}else if (!is_numeric($cost)){
    echo ("Invalid inout for the cost.");
}else if (empty($dwc)) {
    echo ("Please Enter the delivery fee inside Colombo.");
}else if (!is_numeric($dwc)){
    echo ("Invalid inout for the delivery cost inside Colombo.");
}else if (empty($doc)) {
    echo ("Please Enter the delivery fee for out of Colombo.");
}else if (!is_numeric($doc)){
    echo ("Invalid inout for the delivery cost out of Colombo.");
}else if (empty($desc)) {
    echo ("Please enter a Description.");
}else{
    
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product`
    (`category_id`,`brand_id`,`type_id`,`price`,`qty`,`description`,`title`,
    `status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`trailer`) VALUE 
    ('".$category."','".$brand."','".$type."','".$cost."','".$qty."','".$desc."','".$title."',
    '".$status."','".$email."','".$date."','".$dwc."','".$doc."','".$link."')");

    // echo("Product saved successfully");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 3 && $length > 0) {
        
        $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0; $x < $length; $x++){
            if (isset($_FILES["image".$x])) {
                
                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if (in_array($file_extention,$allowed_img_extentions)) {
                    
                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    }else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    }else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    }else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "products images/".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUE ('".$file_name."','".$product_id."')");

                }else {
                    echo ("Invalid image type.");
                }

            }
        }

        echo("Product image saved successfully");

    }else {
        echo ("Invalid image count");
    }

}

?>
