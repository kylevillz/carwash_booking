<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user") {
  header('location:index.php');
}

include_once 'header.php';

error_reporting(0);

$id = $_GET['id'];

$delete=$pdo->prepare("delete from tbl_user where userid=".$id);

if($delete->execute()){

  echo'<script type ="text/javascript">
  jQuery(function validation(){

    swal({
    title: "Good Job!",
    text: "Account has been deleted!",
    icon: "success",
    button: "Ok",
  });



  });

  </script>';

}


if(isset($_POST['btnsave'])){
  $username=$_POST['txtname'];
  $useremail=$_POST['txtemail'];
  $password=$_POST['txtpassword'];
  $userrole=$_POST['txtselect_option'];

  // echo $username .'-'. $useremail .'-'. $password .'-'. $userrole;
  if(!isset($username) || trim($username) == ''){

    echo '<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "ERROR!",
      text: "Name Field Empty! Try again",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';
  }elseif (!isset($userrole) || trim($userrole) == ''){
    echo '<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "ERROR!",
      text: "Role Field Empty! Try again",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';
  }elseif (!isset($password) || trim($password) == '') {
    echo '<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "ERROR!",
      text: "Password Field Empty! Try again",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';
  }


  else if(isset($_POST['txtemail'])){

    $row=$select=$pdo->prepare("select useremail from tbl_user where useremail='$useremail'");
    $select->execute();

    if($select->rowCount() > 0){
      echo'<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Warning!",
        text: "Email Already Exists!",
        icon: "warning",
        button: "Ok",
      });



      });

      </script>';
    }
    else {

      $insert=$pdo->prepare("insert into tbl_user(username,useremail,password,role)values(:name,:email,:pass,:role)");

      $insert->bindParam(':name',$username);
      $insert->bindParam(':email',$useremail);
      $insert->bindParam(':pass',$password);
      $insert->bindParam(':role',$userrole);

      if ($insert->execute()) {
        echo'<script type ="text/javascript">
        jQuery(function validation(){

          swal({
          title: "Good Job!",
          text: "Registration Successful!",
          icon: "success",
          button: "Ok",
        });



        });

        </script>';

      }
    }
  }
}



 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registration


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
        <!-- general form elements -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Register New Member</h3>
          </div>
          <form role="form" action="" method="post">
            <div class="box-body">
          <!-- /.box-header -->
          <!-- form start -->
          <div class="col-md-4">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="txtname" placeholder="Enter name" required>
            </div>
            <div class="form-group">
              <label >Email address</label>
              <input type="email" class="form-control" name="txtemail" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label >Password</label>
              <input type="password" class="form-control" name="txtpassword" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label>Role</label>
              <select class="form-control" name="txtselect_option">
                <option value="" disabled selected>Select role</option required>
                <option>user</option>
                <option>Admin</option>
              </select>
            </div>
            <div>
              <button type="submit" class="btn btn-info" name="btnsave">Save</button>
            </div>

          </div>
          <div class="col-md-8">
            <table class = "table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NAME</th>
                  <th>EMAIL</th>

                  <th>ROLE</th>
                  <th>STATUS</th>
                  <th>EDIT</th>
                </tr>

              </thead>
              <tbody>
                <?php

                $phrase='Admin';

                $select = $pdo->prepare("select * from tbl_user where role!='$phrase' order by userid desc");

                $select->execute();

                while ($row=$select->fetch(PDO::FETCH_OBJ)) {
                  echo'
                  <tr>
                  <td>'.$row->userid.'</td>
                  <td>'.$row->username.'</td>
                  <td>'.$row->useremail.'</td>

                  <td>'.$row->role.'</td>
                  <td>
                  '.$row->status.'
                  </td>

                  <td>
                  <a href = "editregistration.php?id='.$row->userid.'"  class="btn btn-info" role = "button" ><span class = "glyphicon glyphicon-edit" style = "color:#ffffff" data-toggle="tooltip" title="edit"></span></a>
                  </td>
                  </tr>';
                }







                 ?>

              </tbody>

            </table>

          </div>




            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>


          </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
