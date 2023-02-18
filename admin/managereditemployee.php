<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user" OR $_SESSION['role']=="Admin" OR $_SESSION['role']=="cashier") {
  header('location:index.php');
}




include_once 'headermanager.php';

$id= isset($_GET['id']) ? $_GET['id'] : '';

$select = $pdo->prepare("select * from tbl_employee where empid=$id");

$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['empid'];

$fname_db = $row['fname'];
$lname_db = $row['lname'];
$dob_db = $row['dob'];
$role_db = $row['role'];
$email_db = $row['email'];
$status_db = $row['status'];
$experience_db = $row['experience'];
$phonenum_db = $row['phonenum'];
$image_db = $row['image'];

if(isset($_POST['btnupdate'])){
  $fname_txt = $_POST['txtfname'];
  $lname_txt = $_POST['txtlname'];
  $dob_txt = $_POST['txtdob'];
  $role_txt = $_POST['txtrole'];
  $email_txt = $_POST['txtemail'];
  $status_txt = $_POST['txtstatus'];
  $experience_txt = $_POST['txtexperience'];
  $phonenum_txt = $_POST['txtphonenum'];


$file_name = $_FILES['file']['name'];

if(!empty($file_name)){

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

        $f_newfile;
        if(!isset($error)){
          $update = $pdo->prepare("update tbl_employee set fname=:fname, lname=:lname,
          dob=:dob, role=:role, email=:email,status=:status,experience=:experience,phonenum=:phonenum, image=:image where empid=$id");

          $update->bindParam(':fname',$fname_txt);
          $update->bindParam(':lname',$lname_txt);
          $update->bindParam(':dob',$dob_txt);
          $update->bindParam(':role',$role_txt);
          $update->bindParam(':email',$email_txt);
          $update->bindParam(':status',$status_txt);
          $update->bindParam(':experience',$experience_txt);
          $update->bindParam(':phonenum',$phonenum_txt);
          $update->bindParam(':image',$f_newfile);

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






}else{

  $update = $pdo->prepare("update tbl_employee set fname=:fname, lname=:lname,
  dob=:dob, role=:role, email=:email,status=:status,experience=:experience,phonenum=:phonenum, image=:image where empid=$id");

  $update->bindParam(':fname',$fname_txt);
  $update->bindParam(':lname',$lname_txt);
  $update->bindParam(':dob',$dob_txt);
  $update->bindParam(':role',$role_txt);
  $update->bindParam(':email',$email_txt);
  $update->bindParam(':status',$status_txt);
  $update->bindParam(':experience',$experience_txt);
  $update->bindParam(':phonenum',$phonenum_txt);
  $update->bindParam(':image',$image_db);

  if($update->execute()){

      echo $error = '<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Good Job!",
        text: "Service list is Updated",
        icon: "success",
        button: "Ok",
      });



      });

      </script>';


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

    echo $error;

  }
}


}

$select = $pdo->prepare("select * from tbl_employee where empid=$id");

$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['empid'];

$fname_db = $row['fname'];
$lname_db = $row['lname'];
$dob_db = $row['dob'];
$role_db = $row['role'];
$email_db = $row['email'];
$status_db = $row['status'];
$experience_db = $row['experience'];
$phonenum_db = $row['phonenum'];
$image_db = $row['image'];





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
            <h3 class="box-title"><a href="manageremployeelist.php" class="btn btn-primary" role="button">Back to Employee list</a></h3>
          </div>

          <form action="" method="post" name="form" enctype="multipart/form-data">

            <div class="box-body">


                <div class="col-md-6">
                  <div class="form-group">
                    <label>First name</label>
                    <input type="text" class="form-control" name="txtfname" value="<?php echo $fname_db;?>" placeholder="Enter name..." required>
                  </div>
                  <div class="form-group">
                    <label>Last name</label>
                    <input type="text" class="form-control" name="txtlname" value="<?php echo $lname_db;?>" placeholder="Enter name..." required>
                  </div>
                  <div class="form-group">
                    <label>Birth date</label>
                    <input type="text" class="form-control" name="txtdob" value="<?php echo $dob_db;?>" placeholder="Enter name..." required>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="txtrole">
                      <option value="" disabled selected>Select role</option required>
                        <?php
                        $select=$pdo->prepare("select * from tbl_role_employee order by roleid desc");
                        $select->execute();

                        while($row=$select->fetch(PDO::FETCH_ASSOC)){

                          extract($row)

                         ?>
                      <option <?php if($row['role']==$role_db) {?>

                        selected="selected"
                      <?php } ?>>




                        <?php echo $row['role']; ?></option>

                      <?php
                      }
                      ?>

                    </select>
                  </div>

                  <div class="form-group">
                    <label>Email address</label>
                    <input type="text" class="form-control" name="txtemail" value="<?php echo $email_db;?>" placeholder="Enter name..." required>
                  </div>



                </div>
                <div class="col-md-6">
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
                  <div class="form-group">
                    <label >Years of experience</label>
                    <input type="number" min="1" step="1" class="form-control" name="txtexperience" value="<?php echo $experience_db;?>" placeholder="Enter price..." required>
                  </div>
                  <div class="form-group">
                    <label >Phone number</label>
                    <textarea class="form-control" name="txtphonenum"  rows="5" placeholder="Enter..."><?php echo $phonenum_db;?></textarea>
                  </div>

                  <div class="form-group">
                    <label >Upload image</label>
                    <img src = "upload/<?php echo $image_db;?>" class = "img-responsive" width = "200px" height = "200px">
                    <input type="file" class="input-group" name="file" >

                  </div>



                  </div>







              <div class="box-footer">


                <button type="submit" class="btn btn-info" name="btnupdate">Update Service</button>

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
