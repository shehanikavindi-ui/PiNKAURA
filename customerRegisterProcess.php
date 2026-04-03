<?php

include "connection.php";

$fname = $_POST["fn"];
$lname = $_POST["ln"];
$email = $_POST["em"];
$password = $_POST["pw"];
$repeatPassword = $_POST["rpw"];

if (empty($fname)) {
    echo("* Please Enter Your First name *");
} else if (strlen($fname) > 20) {
    echo("* First Name must contain lower than 20 characters *");
} else if (empty($lname)) {
    echo("* Please Enter Your Last name *");
} else if (strlen($lname) > 20) {
    echo("* Last Name must contain lower than 20 characters *");
} else if (empty($email)) {
    echo("* Please Enter Your Email Address *");
} else if (strlen($email) > 100) {
    echo("* Email must contain lower than 100 characters *");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo("* Invalid Email address *");
} else if (empty($password)) {
    echo("* Please Enter Your Password *");
} else if (strlen($password) > 9 || strlen($password) < 4) {
    echo("* Password must be 5 to 8 characters *");
} else if(empty($repeatPassword)) {
    echo ("Please Re-enter Your Password");
} else if($password != $repeatPassword) {
    echo ("Passwords do not match. Check again !!");
} else {
    
    $user_rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' ");
    $user_num = $user_rs->num_rows;

    if ($user_num > 0) {
        echo("This Email is already registered");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimeZone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `customer` 
        (`fname`,`lname`,`email`,`password`,`created_at`,`status_id`)
        VALUES ('".$fname."', '".$lname."', '".$email."', '".$password."', '".$date."', '1') ");

        echo("success");
    }
}

?>