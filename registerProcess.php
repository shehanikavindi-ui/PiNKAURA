<?php

include "connection.php";

$fname = $_POST["fn"];
$lname = $_POST["ln"];
$email = $_POST["em"];
$password = $_POST["pw"];
$repeatpw = $_POST["rpw"];

if (empty($fname)) {
    echo ("Please enter your First Name..");
} else if (strlen($fname) > 20) {
    echo ("First name must contain LOWER THAN 20 Characters");
} else if (empty($lname)) {
    echo ("Please enter your last name..");
} else if (strlen($lname) > 20) {
    echo ("Last name must contain LOWER THAN 20 Characters");
} else if (empty($email)) {
    echo ("Please enter your Email..");
} else if (strlen($email) > 100) {
    echo ("Email must contain LOWER THAN 100 Characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (empty($password)) {
    echo ("Please enter your password..");
} else if (strlen($password) < 5 || strlen($password) > 10) {
    echo ("Password must contain between 5 to 10 characters");
}else if(!isset($repeatpw)){
    echo("Please re-enter your Password");
}else if($password != $repeatpw){
    echo("Passwords do not match");
}else{
    
    $rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' ");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("User with the same Email address already exists");
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `customer`
        (`fname`,`lname`,`email`,`password`,`created_at`)
        VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$date."') ");

        echo("success");
    }
}



?>