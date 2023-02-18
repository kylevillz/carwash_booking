<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=rs_db','root','');

  // echo "connection succesful";
} catch (PDOException $e) {

  echo $e->getmessage();

}

 ?>
