<?php

include_once 'connectdb.php';

$id = $_POST['sidd'];

$sql = "delete from tbl_service where sid=$id";


$delete=$pdo->prepare($sql);

if($delete->execute()){
  

}else{
  echo'error in deleting';
}








 ?>
