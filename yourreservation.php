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
        Current Reservation
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
        <div class="box box-info">
          <div class="box-header with-border">

          </div>


              <div class="box-footer">


                <table id = "tableappointment" class = "table table-striped"  >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Customer name</th>
                      <th>Service name</th>
                      <th>Reservation date</th>
                      <th>Reservation time</th>
                      <th>Payment type</th>
                      <th>Cancel reservation</th>

                    </tr>

                  </thead>
                  <tbody>

                    <?php
                    $empty = "";
                    $phrase = "Not yet done";
                    $select=$pdo->prepare("select * from tbl_appointment where name='". $_SESSION['username']."' AND  customerid = '".$_SESSION['customerid'] ."' AND appointment_status='$empty' OR name='". $_SESSION['username']."' AND  customerid = '".$_SESSION['customerid'] ."'AND appointment_status= '$phrase' ");

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
                      '.$row->reserve_date.'
                      </td>
                      <td>
                      '.$row->reserve_time.'
                      </td>
                      <td>
                      '.$row->payment_type.'
                      </td>
                      <td>
                      <button id='.$row->appointmentid.'  class="btn btn-danger btndelete"><span class = "glyphicon glyphicon-trash" style = "color:#ffffff" data-toggle="tooltip" title="delete"></span></button>
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
       $('#tableappointment').DataTable({

         "order":[[0,"desc"]]




       });
    });
    </script>

    <script>

    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();


   });

    </script>
    <script>
    $(document).ready(function(){
      $('.btndelete').click(function(){

        var tdh = $(this);
        var id= $(this).attr("id");

        swal({
    title: "Are you sure?",
    text: "Once you cancel this reservation, it will not be recovered!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: 'reservationdelete.php',
        type:'post',
        data:{
          appointmentidd:id
        },
        success: function(data){
          tdh.parents('tr').hide();
        }



      });
      swal("Your reservation has been deleted!", {
        icon: "success",
      });
    } else {
      swal("Your reservation is safe!");
    }
  });
        // alert(id);


      });
    });


    </script>


  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
