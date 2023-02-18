<?php

include_once 'connectdb.php';

$id = $_POST['empidd'];

$sql = "delete from tbl_employee where empid=$id";


$delete=$pdo->prepare($sql);

if($delete->execute()){


}else{
  echo'error in deleting';
}








 ?>
