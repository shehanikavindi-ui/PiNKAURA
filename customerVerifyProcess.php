<?php

include "connection.php";

$email = $_POST["em"];
$vcode = $_POST["vc"];

$customer_rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' ");
$customer_num = $customer_rs->num_rows;

if ($customer_num == 1) {
    $customer_data = $customer_rs->fetch_assoc();
    if ($customer_data["vcode"] == $vcode) {
        Database::iud("UPDATE `customer` SET `status_id`='6' WHERE `email`='".$email."' ");
        echo("success");
    } else {
        echo("oops! wrong code. please check your email");
    }
    
}

?>