<?php

include_once 'connectdb.php';

$id = $_POST['customeridd'];

$sql = "delete from tbl_customer where customerid=$id";


$delete=$pdo->prepare($sql);

if($delete->execute()){


}else{
  echo'error in deleting';
}








 ?>
