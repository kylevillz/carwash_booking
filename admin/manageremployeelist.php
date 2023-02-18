<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user" OR $_SESSION['role']=="Admin" OR $_SESSION['role']=="cashier") {
  header('location:index.php');
}



include_once 'headermanager.php';


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
            <h3 class="box-title"><a href="manageraddemployee.php" class="btn btn-primary" role="button">Add employee</a></h3>
          </div>

            <div class="box-body">
              <table id = "tableemployee" class = "table table-striped"  >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Role</th>
                    <th>Birth date</th>
                    <th>Blood type</th>
                    <th>Email address</th>
                    <th>Status</th>
                    <th>Years of Experience</th>
                    <th>Phone number</th>
                    <th>Image</th>
                    <th>View</th>
                    <th>Edit</th>

                  </tr>

                </thead>
                <tbody>

                  <?php
                  $phrase="carwash";
                  $phrase1="cashier";
                  $select=$pdo->prepare("select * from tbl_employee where role='$phrase' OR role='$phrase1' order by empid desc");

                  $select->execute();

                  while($row=$select->fetch(PDO::FETCH_OBJ)){

                    echo'<tr>
                    <td>
                    '.$row->empid.'
                    </td>
                    <td>
                    '.$row->fname.'
                    </td>
                    <td>
                    '.$row->lname.'
                    </td>
                    <td>
                    '.$row->role.'
                    </td>
                    <td>
                    '.$row->dob.'
                    </td>
                    <td>
                    '.$row->blood_type.'
                    </td>
                    <td>
                    '.$row->email.'
                    </td>
                    <td>
                    '.$row->status.'
                    </td>
                    <td>
                    '.$row->experience.'
                    </td>
                    <td>
                    '.$row->phonenum.'
                    </td>
                    <td>
                    <img src = "upload/'.$row->image.'" class = "img-rounded" width = "40px" height = "40px">
                    </td>
                    <td>
                    <a href = "managerviewemployee.php?id='.$row->empid.'"  class="btn btn-success" role = "button" ><span class = "glyphicon glyphicon-eye-open" style = "color:#ffffff" data-toggle="tooltip" title="view"></span></a>
                    </td>
                    <td>
                    <a href = "managereditemployee.php?id='.$row->empid.'"  class="btn btn-info" role = "button" ><span class = "glyphicon glyphicon-edit" style = "color:#ffffff" data-toggle="tooltip" title="edit"></span></a>
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
     $('#tableemployee').DataTable({

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
