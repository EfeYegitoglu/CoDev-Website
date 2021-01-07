<?php

include 'baglan.php';

$mailName = $_POST['mailName'];
$emailAdress = $_POST['emailAdress'];
$mailSubject = $_POST['mailSubject'];
$mailMessage = $_POST['mailMessage'];

$to ="softwarecodev@gmail.com";
$headers = 'Content-Type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: ' .$emailAdress ;
$message = "Kimden: " .$mailName . "</pre>" . "</pre>" . $mailMessage;
mail($to,$mailSubject,$message,$headers);
header("Location:../../index.php");
?>
