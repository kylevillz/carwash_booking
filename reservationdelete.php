<?php

include_once 'connectdb.php';

$id = $_POST['appointmentidd'];

$sql = "delete from tbl_appointment where appointmentid=$id";


$delete=$pdo->prepare($sql);

if($delete->execute()){


}else{
  echo'error in deleting';
}








 ?>
