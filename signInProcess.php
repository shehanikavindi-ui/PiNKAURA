<?php

session_start();
include "connection.php";

$email = $_POST["em"];
$password = $_POST["pw"];
$rememberMe = $_POST["rm"];

if(empty($email)){
    echo("Please enter your Email address");
}else if(strlen($email)>100){
    echo("Email Address must contain LOWER THAN 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email Address");
}else if(empty($password)){
    echo("Please enter your Password");
}else if(strlen($password)<5 || strlen($password)>10){
    echo("Password must contain BETWEEN 5 to 10 characters");
}else{
    
    $rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' AND `password`='".$password."'  ");
    $num = $rs->num_rows;

    if($num == 1){

        echo("success");
        $data = $rs->fetch_assoc();
        $_SESSION["u"] = $data;

        if($rememberMe =="true"){
            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));
        }

    }else{
        echo("Invalid Email or Password");
    }
}

?>