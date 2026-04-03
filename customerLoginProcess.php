<?php

session_start();
include "connection.php";

$email =  $_POST["em"];
$password = $_POST["pw"];
$rememberMe = $_POST["rm"];

if (empty($email)) {
    echo("* Please enter your email *");
}else if (strlen($email) > 100) {
    echo("* Email must contain lower than 100 characters *");
}else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    echo("* Invalid Email Address *");
} else if (empty($password)) {
    echo("* Please enter your password *");
} else if (strlen($password) > 9 || strlen($password) < 4) {
    echo("* Password must be 5 to 8 characters *");
} else {
    $customer_rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' AND `password`='".$password."' ");
    $customer_num = $customer_rs->num_rows;
    if ($customer_num == 1) {
        echo("success");
        $customer_data = $customer_rs->fetch_assoc();
        $_SESSION["u"] = $customer_data;

        if($rememberMe =="true"){
            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));
        }
    } else {
        echo("Invalid Email or Password");
    }
    
}



?>