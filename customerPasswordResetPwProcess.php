<?php

include "connection.php";

$email = $_POST["em"];
$newPw = $_POST["pw"];
$rePw = $_POST["rpw"];
$vcode = $_POST["vc"];

if (empty($newPw)) {
    echo("New password cannot be empty");
} else if (strlen($newPw) < 4 || strlen($newPw) > 9) {
    echo(" Password must be 5 to 8 characters ");
} else if(empty($rePw)) {
    echo ("Please Re-enter Your Password");
} else if($newPw != $rePw) {
    echo ("Passwords do not match. Check again !!");
} else if (empty($vcode)) {
    echo ("Please enter your verification code");
} else {

    $customer_rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' AND `vcode`='".$vcode."' ");
    $customer_num = $customer_rs->num_rows;

    if ($customer_num == 1) {
        Database::iud("UPDATE `customer` SET `password`='".$newPw."' WHERE `email`='".$email."' ");
        echo("success");
    } else {
        echo("Invalid Verification code");
    }
    
}

?>