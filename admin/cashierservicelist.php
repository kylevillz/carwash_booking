<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="Admin" OR $_SESSION['role']=="user" OR $_SESSION['role']=="Manager") {
  header('location:index.php');
}



include_once 'headercashier.php';


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
            <h3 class="box-title">Service list</h3>
          </div>

            <div class="box-body">
              <table id = "tableservice" class = "table table-striped"  >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Service name</th>
                    <th>Category</th>
                    <th>Sale price</th>
                    <th>Employee assigned</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>View</th>

                  </tr>

                </thead>
                <tbody>

                  <?php
                  $select=$pdo->prepare("select * from tbl_service order by sid desc");

                  $select->execute();

                  while($row=$select->fetch(PDO::FETCH_OBJ)){

                    echo'<tr>
                    <td>
                    '.$row->sid.'
                    </td>
                    <td>
                    '.$row->servicename.'
                    </td>
                    <td>
                    '.$row->category.'
                    </td>
                    <td>
                    '.$row->saleprice.'
                    </td>
                    <td>
                    '.$row->employee.'
                    </td>
                    <td>
                    '.$row->description.'
                    </td>
                    <td>
                    <img src = "upload/'.$row->image.'" class = "img-rounded" width = "40px" height = "40px">
                    </td>
                    <td>
                    <a href = "cashierviewservices.php?id='.$row->sid.'"  class="btn btn-success" role = "button" ><span class = "glyphicon glyphicon-eye-open" style = "color:#ffffff" data-toggle="tooltip" title="view"></span></a>
                    </td>

                        </tr>';




                  }







                   ?>












                </tbody>

              </table>


            </div>
            </div>

    </section>
    <!-- /.content -->
  </div>
  <script>
   $(document).ready(function() {
     $('#tableservice').DataTable({

       "order":[[0,"desc"]]




     });
  });
  </script>

  <script>

  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();


 });

  </script>


  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
