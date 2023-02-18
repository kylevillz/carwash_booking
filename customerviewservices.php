<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="user" OR $_SESSION['role']=="Admin") {
  header('location:index.php');
}




include_once 'header.php';


 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View service
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
            <h3 class="box-title"><a href="reservation.php" class="btn btn-primary" role="button">Back to Reservation</a></h3>
          </div>

            <div class="box-body">

              <?php
              $id= isset($_GET['id']) ? $_GET['id'] : '';

              $select = $pdo->prepare("select * from tbl_service where sid=$id");

              $select->execute();

              while($row=$select->fetch(PDO::FETCH_OBJ)){

                echo'<div class = "col-md-6">

                <center><p class="list-group-item list-group-item-success" ><b>Service Details</b></p></center>

                <ul class="list-group">
                 <li class="list-group-item"><b>ID</b><span class="badge">'.$row->sid.'</span></li>
                 <li class="list-group-item"><b>Service name</b><span class="label label-info pull-right">'.$row->servicename.'</span></li>
                 <li class="list-group-item"><b>Category</b><span class="label label-success pull-right">'.$row->category.'</span></li>
                 <li class="list-group-item"><b>Sale price</b><span class="label label-warning pull-right">'.$row->saleprice.'</span></li>
                 <li class="list-group-item"><b>Description: - </b><span class="">'.$row->description.'</span></li>
                </ul>

                </div>
                <div class = "col-md-6">

                <center><p class="list-group-item list-group-item-success"><b>Service image</b></p></center>

                <ul class="list-group">
                <center><img src = "admin/upload/'.$row->image.'" class = "img-responsive" width="45%" height="45%"></center>

                </ul>
                </div>





                ';




              }




               ?>



            </div>
            </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
