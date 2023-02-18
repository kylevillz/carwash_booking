<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer") {
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
            <h3 class="box-title"><a href="employeelist.php" class="btn btn-primary" role="button">Back to Employee list</a></h3>
          </div>

            <div class="box-body">

              <?php
              $id= isset($_GET['id']) ? $_GET['id'] : '';

              $select = $pdo->prepare("select * from tbl_employee where empid=$id");

              $select->execute();

              while($row=$select->fetch(PDO::FETCH_OBJ)){

                echo'<div class = "col-md-6">

                <center><p class="list-group-item list-group-item-success" ><b>Employee Details</b></p></center>

                <ul class="list-group">
                 <li class="list-group-item"><b>ID</b><span class="badge">'.$row->empid.'</span></li>
                 <li class="list-group-item"><b>Service name</b><span class="label label-success pull-right">'.$row->fname.'</span></li>
                 <li class="list-group-item"><b>Category</b><span class="label label-success pull-right">'.$row->lname.'</span></li>
                 <li class="list-group-item"><b>Birth date</b><span class="label label-success pull-right">'.$row->dob.'</span></li>
                 <li class="list-group-item"><b>Email address</b><span class="label label-success pull-right">'.$row->email.'</span></li>
                 <li class="list-group-item"><b>Status</b><span class="label label-success pull-right">'.$row->status.'</span></li>
                 <li class="list-group-item"><b>Experience</b><span class="label label-success pull-right">'.$row->experience.'</span></li>
                 <li class="list-group-item"><b>Phone number</b><span class="label label-success pull-right">'.$row->phonenum.'</span></li>
                </ul>

                </div>
                <div class = "col-md-6">

                <center><p class="list-group-item list-group-item-success"><b>Service image</b></p></center>

                <ul class="list-group">
                <center><img src = "upload/'.$row->image.'" class = "img-responsive" width="45%" height="45%"></center>

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
