<?php

try {

  $db= new PDO("mysql:host=localhost;dbname=coderapp;charset=utf8",'root','');
  //echo "Bağlantı başarılı";

} catch (PDOEpxception $e) {
  echo $e->getMessage();
}


?>
