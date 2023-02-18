<?php
include_once 'connectdb.php';
session_start();



include_once 'headermanager.php';

if(isset($_POST['btnaddemployee'])){
  $fname = $_POST['txtfname'];
  $lname = $_POST['txtlname'];
  $dob = $_POST['txtdob'];
  $role = $_POST['txtrole'];
  $email = $_POST['txtemail'];
  $status = $_POST['txtselect_option'];
  $years = $_POST['txtyear'];
  $phonenum = $_POST['txtphone'];

$file_name = $_FILES['file']['name'];
$file_type = $_FILES['file']['type'];
$file_size = $_FILES['file']['size'];
$file_tem_loc = $_FILES['file']['tmp_name'];
$file_store = "upload/".$file_name;
$f_extension = explode('.',$file_name);
$f_extension = strtolower(end($f_extension));

$f_newfile = uniqid().'.'.$f_extension;
$file_store = "upload/".$f_newfile;


if ($f_extension == 'jpg' || $f_extension == 'png' || $f_extension == 'gif' || $f_extension == 'jpeg') {

  if($file_size>=5000000) {
    $error ='<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Warning!",
      text: "Max file should be 5MB!",
      icon: "warning",
      button: "Ok",
    });



    });

    </script>';
    echo $error;

  }else{
    if (move_uploaded_file($file_tem_loc, $file_store)) {

      $upload = $f_newfile;
      if(!isset($error)){
        $insert=$pdo->prepare("insert into tbl_employee(fname,lname,dob,role,email,status,experience,phonenum,image)
        values(:fname,:lname,:dob,:role,:email,:status,:experience,:phonenum,:image)");

        $insert->bindParam(':fname',$fname);
        $insert->bindParam(':lname',$lname);
        $insert->bindParam(':dob',$dob);
        $insert->bindParam(':role',$role);
        $insert->bindParam(':email',$email);
        $insert->bindParam(':status',$status);
        $insert->bindParam(':experience',$years);
        $insert->bindParam(':phonenum',$phonenum);
        $insert->bindParam(':image',$upload);

        if($insert->execute()){

          echo'<script type ="text/javascript">
          jQuery(function validation(){

            swal({
            title: "Good Job!",
            text: "Image is successfuly uploaded!",
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
  }
}else{
  $error = '<script type ="text/javascript">
  jQuery(function validation(){

    swal({
    title: "Warning!",
    text: "Only Jpg, Jpeg, Png and Gif file is allowed!",
    icon: "warning",
    button: "Ok",
  });



  });

  </script>';
  echo $error;
}


}


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
            <h3 class="box-title"><a href="manageremployeelist.php" class="btn btn-primary" role="button">Back to employee list</a></h3>
          </div>

          <form action="" method="post" name="form" enctype="multipart/form-data">



            <div class="box-body">
              <div class="col-md-6">


                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="txtfname" placeholder="Enter name..." required>
                </div>
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="txtlname" placeholder="Enter name..." required>
                </div>

                <div class="form-group">
                  <label>Date of Birth</label>
                  <input type="date" class="form-control" name="txtdob" placeholder="Enter name..." required>
                </div>

                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="txtrole">
                    <option value="" disabled selected>Select role</option required>
                      <?php
                      $select=$pdo->prepare("select * from tbl_role_employee");
                      $select->execute();

                      while($row=$select->fetch(PDO::FETCH_ASSOC)){

                        extract($row)

                       ?>
                    <option><?php echo $row['role']; ?></option>

                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" class="form-control" name="txtemail" placeholder="Enter name..." required>
                </div>




              </div>


              <div class="col-md-6">

                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="txtselect_option">
                    <option value="" disabled selected>Select status</option required>
                      <?php
                      $select=$pdo->prepare("select * from tbl_status");
                      $select->execute();

                      while($row=$select->fetch(PDO::FETCH_ASSOC)){

                        extract($row)

                       ?>
                    <option><?php echo $row['status']; ?></option>

                    <?php
                    }
                    ?>

                  </select>
                </div>
                <div class="form-group">
                <div class="form-group">
                  <label>Years of Experience</label>
                  <input type="number" min="1" step="1" class="form-control" name="txtyear" placeholder="Enter name..." required>
                </div>

                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="tel" class="form-control" name="txtphone" placeholder="+63 123 456 789" required>
                </div>

                <div class="form-group">
                  <label >Upload image</label>
                  <input type="file" class="input-group" name="file" required>

                </div>




              </div>





            </div>

          </div>
          <div class="box-footer">


            <button type="submit" class="btn btn-warning" name="btnaddemployee">Add Employee</button>

          </div>
          </form>

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
