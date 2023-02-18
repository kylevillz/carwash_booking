<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user") {
  header('location:index.php');
}




include_once 'header.php';

$id= isset($_GET['id']) ? $_GET['id'] : '';

$select = $pdo->prepare("select * from tbl_user where userid=$id");

$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['userid'];


$status_db = $row['status'];


if(isset($_POST['btnupdate'])){

  $status_txt = $_POST['txtstatus'];

  $update = $pdo->prepare("update tbl_user set status=:status where userid=$id");
  $update->bindParam(':status',$status_txt);
  if($update->execute()){

    echo'<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Good Job!",
      text: "Update successful!",
      icon: "success",
      button: "Ok",
    });



    });

    </script>';

  }



}else{

     $error ='<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Warning!",
      text: "task failed",
      icon: "warning",
      button: "Ok",
    });



    });

    </script>';



  }





$select = $pdo->prepare("select * from tbl_user where userid=$id");

$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['userid'];


$status_db = $row['status'];






 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><a href="registration.php" class="btn btn-primary" role="button">Back to Registration list</a></h3>
          </div>

          <form action="" method="post" name="form" enctype="multipart/form-data">

            <div class="box-body">



                <div class="col-md-4">
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="txtstatus">
                      <option value="" disabled selected>Select status</option required>
                        <?php
                        $select=$pdo->prepare("select * from tbl_status order by statid desc");
                        $select->execute();

                        while($row=$select->fetch(PDO::FETCH_ASSOC)){

                          extract($row)

                         ?>
                      <option <?php if($row['status']==$status_db) {?>

                        selected="selected"
                      <?php } ?>>




                        <?php echo $row['status']; ?></option>

                      <?php
                      }
                      ?>

                    </select>
                  </div>

                  <div class="box-footer">


                    <button type="submit" class="btn btn-info" name="btnupdate">Update Service</button>

                  </div>



                  </div>








              </form>
              </div>

            </div>
          </div>

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
