<?php
include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["email"];

$customer_rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."' ");
$customer_num = $customer_rs->num_rows;

if ($customer_num == 1) {
    do {
        $vcode = str_pad(rand(0,999999), 6, '0', STR_PAD_LEFT);
        $vcode_check_rs = Database::search("SELECT * FROM `customer` WHERE `vcode`='".$vcode."' ");
    } while ($vcode_check_rs->num_rows > 0);

    Database::iud("UPDATE `customer` SET `vcode`='".$vcode."' WHERE `email`='".$email."' ");

    // email code
    $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pinkauracosmetics@gmail.com'; //sender's email
        $mail->Password = 'jydfcwqexwynomcc'; //app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('pinkauracosmetics@gmail.com', 'Verify Account');
        $mail->addReplyTo('pinkauracosmetics@gmail.com', 'Verify Account');
        $mail->addAddress($email); //reciever's email
        $mail->isHTML(true);
        $mail->Subject = 'Verification code | For the Verification of Your PiNK AURA Account';
        $bodyContent = '<p style="font-size:25px;">Your verification code is <b>'.$vcode.'</b> </p>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo("Verification sending failed");
        }else{
            echo("success");
        }

} else {
    echo ("Something went wrong! Register Again !! ");
}


?>