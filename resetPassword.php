<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vcode = $_POST["v"];

// echo ($email);
// echo ($np);
// echo ($rnp);
// echo ($vcode);

if (empty($email)) {
    echo ("Missing Email Address");
}else if(empty($np)){
    echo ("Please insert a New Password");
}else if (strlen($np) < 5 || strlen($np) > 20) {
    echo ("Invalid Password");
}else if (empty($rnp)) {
    echo ("Please Re-type your New Password");
}else if ($np != $rnp) {
    echo ("Password does not matched");
}else if (empty($vcode)) {
    echo ("Please enter your Verification Code");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND
    `varification_code`='".$vcode."'");
    $n = $rs->num_rows;

    if ($n == 1) {

        Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`='".$email."'");
        echo ("SUCCESS");

    }else {
        echo ("Invalid Email or Verification Code");
    }

}

?>