<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user") {
  header('location:index.php');
}




include_once 'header.php';

if(isset($_POST['btnaddreservation']) || isset($_POST['txtname'])){
  error_reporting(1);
  $name = $_POST['txtname'];
  $servicename = $_POST['txtselect_option'];
  $saleprice = $_POST['txtprice'];
  $date = $_POST['txtdate'];
  $time = $_POST['txttime'];
  $payment_type = $_POST['payment_type'];


if(!empty($name) AND !empty($servicename) AND !empty($date) AND !empty($time) AND !empty($payment_type)){
  $insert=$pdo->prepare("insert into tbl_appointment(name,servicename,saleprice,reserve_date,reserve_time,payment_type)
  values(:name,:servicename,:saleprice,:reserve_date,:reserve_time,:payment_type)");

  $insert->bindParam(':name',$name);
  $insert->bindParam(':servicename',$servicename);
  $insert->bindParam(':saleprice',$saleprice);
  $insert->bindParam(':reserve_date',$date);
  $insert->bindParam(':reserve_time',$time);
  $insert->bindParam(':payment_type',$payment_type);


  if($insert->execute()){

    echo'<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Good Job!",
      text: "Reservation successful!",
      icon: "success",
      button: "Ok",
    });



    });

    </script>';

  }else{
    echo'<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Error!",
      text: "Upload failed!",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';

  }

  }
  }


 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Book Appointment
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

            <h3 class="box-title"><a href="reservationlist.php" class="btn btn-primary" role="button">Go back to reservation list</a></h3>


          </div>

          <form role="form" action="" method="post">

            <div class="box-body">


                <div class="col-md-6">

                  <div class="form-group">
                    <label>Full name</label>
                    <input type="text" class="form-control" name="txtname"  placeholder="Enter name..." required>
                  </div>


                  <div class="form-group service">
                    <label for="service">Service name</label>
                    <select class="form-control" name="txtselect_option">
                      <option value="" disabled selected>Select service</option required>
                        <?php
                        $select=$pdo->prepare("select * from tbl_service order by sid desc");
                        $select->execute();

                        while($row=$select->fetch(PDO::FETCH_ASSOC)){

                          extract($row)

                         ?>
                      <option data-price="<?php echo $row['saleprice']; ?>"><?php echo $row['servicename']; ?></option>

                      <?php
                      }
                      ?>

                    </select>
                  </div>


                  <div class="form-group">
                    <label >Time</label> <small>(Available time are 6:30 am to 9:00 pm)</small>
                    <input type="time"  class="form-control" name="txttime" placeholder="Enter price..." required>
                  </div>



                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label >Date</label>
                    <input type="date" min="1" step="1" class="form-control" name="txtdate" placeholder="Enter price..." required>
                  </div>
                  <div class="form-group">
                    <label for"price">Price</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                      ₱
                    </div>
                    <input type="text" name="txtprice"class="form-control price-input"   readonly>
                  </div>
                  </div>
                  <div class="form-group">
                    <label>Mode of payment</label>
                    <select class="form-control" name="payment_type">
                      <option value="" disabled selected>Select payment type</option required>
                        <?php
                        $select=$pdo->prepare("select * from tbl_payment order by paymentid desc");
                        $select->execute();

                        while($row=$select->fetch(PDO::FETCH_ASSOC)){

                          extract($row)

                         ?>
                      <option><?php echo $row['payment_type']; ?></option>

                      <?php
                      }
                      ?>

                    </select>
                  </div>




                  </div>



              </div>

              <div class="box-footer">


                <button type="submit" class="btn btn-info" name="btnaddreservation">Book appointment</button>




              </div>
              <div class="box-footer">


                <table id = "tableservice" class = "table table-striped"  >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Service name</th>
                      <th>Category</th>
                      <th>Sale price</th>
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
                      '.$row->description.'
                      </td>
                      <td>
                      <img src = "upload/'.$row->image.'" class = "img-rounded" width = "40px" height = "40px">
                      </td>
                      <td>
                      <a href = "viewservices.php?id='.$row->sid.'"  class="btn btn-success" role = "button" ><span class = "glyphicon glyphicon-eye-open" style = "color:#ffffff" data-toggle="tooltip" title="view"></span></a>
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

    <script>

    $('.service').on('change', function() {
  $('.price-input')
  .val(
    $(this).find(':selected').data('price')
  );
});

    </script>

    <!-- /.content -->

  <!-- /.content-wrapper -->
  <?php

  include_once 'footer.php';

  ?>
