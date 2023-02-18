<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user") {
  header('location:index.php');
}



include_once 'header.php';


 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservation List
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
            <h3 class="box-title"><a href="addreservation.php" class="btn btn-primary" role="button">Add reservation</a></h3>
          </div>

            <div class="box-body">
              <table id = "tablereservation" class = "table table-striped"  >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Service name</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Payment type</th>
                    <th>Employee assigned</th>
                    <th>Payment status</th>
                    <th>Appointment status</th>
                    <th>User</th>
                    <th></th>

                  </tr>

                </thead>
                <tbody>

                  <?php
                  $phrase="Not yet done";
                  $phrase1="";

                  $select=$pdo->prepare("select * from tbl_appointment where CURRENT_DATE = reserve_date AND appointment_status='Done';");

                  $select->execute();

                  while($row=$select->fetch(PDO::FETCH_OBJ)){

                    echo'<tr>
                    <td>
                    '.$row->appointmentid.'
                    </td>
                    <td>
                    '.$row->name.'
                    </td>
                    <td>
                    '.$row->servicename.'
                    </td>
                    <td>
                    '.$row->saleprice.'
                    </td>
                    <td>
                    '.$row->reserve_date.'
                    </td>
                    <td>
                    '.$row->reserve_time.'
                    </td>
                    <td>
                    '.$row->payment_type.'
                    </td>
                    <td>
                    '.$row->employee.'
                    </td>
                    <td>
                    '.$row->payment_status.'
                    </td>
                    <td>
                    '.$row->appointment_status.'
                    </td>
                    <td>
                    '.$row->user.'
                    </td>
                    <td>
                    <a href = "editreservation.php?id='.$row->appointmentid.'"  class="btn btn-info" role = "button" ><span class = "glyphicon glyphicon-edit" style = "color:#ffffff" data-toggle="tooltip" title="edit"></span></a>
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
     $('#tablereservation').DataTable({

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
