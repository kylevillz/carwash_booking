<?php
include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail']=="" OR $_SESSION['role']=="customer" OR $_SESSION['role']=="user") {
  header('location:index.php');
}




include_once 'header.php';

if(isset($_POST['btnsave'])){
  $category = $_POST['txtcategory'];
  $status =$_POST['txtstatus'];

  if(!isset($category) || trim($category) == ''){

    echo'<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Error!",
      text: "Field is Empty",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';

  }

  elseif(empty($category)){
    $error = '<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Error!",
      text: "Field is Empty",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';

    echo $error;
  }elseif(!isset($error)){

    $insert=$pdo->prepare("insert into tbl_category(category) values(:category)");

    $insert->bindParam(':category',$category);

    if($insert->execute()){

      echo '<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Good Job!",
        text: "Task successful",
        icon: "success",
        button: "Ok",
      });



      });

      </script>';

    }else{

      echo '<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Warning!",
        text: "task failed",
        icon: "warning",
        button: "Ok",
      });



      });

      </script>';

    }


  }
}//btnadd ends here

if(isset($_POST['btnupdate'])){
  $category = $_POST['txtcategory'];
  $status = $_POST['txtstatus'];
  $id = $_POST['txtid'];

  if(!isset($category) || !isset($status)|| trim($category) == ''){

    echo'<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Error!",
      text: "Field is Empty",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';

  }

  elseif(empty($category)){
    $errorupdate = '<script type ="text/javascript">
    jQuery(function validation(){

      swal({
      title: "Error!",
      text: "Field is Empty!",
      icon: "error",
      button: "Ok",
    });



    });

    </script>';
    echo $errorupdate;

  }
  elseif(!isset($errorupdate)){
    $update = $pdo->prepare("update tbl_category set category=:category,status=:status where catid=".$id);
    $update->bindParam(':category',$category);
    $update->bindParam(':status',$status);

    $update->execute();

        echo '<script type ="text/javascript">
        jQuery(function validation(){

          swal({
          title: "Good Job!",
          text: "Category is Updated",
          icon: "success",
          button: "Ok",
        });



        });

        </script>';




  }else{

      echo '<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Warning!",
        text: "task failed",
        icon: "warning",
        button: "Ok",
      });



      });

      </script>';

    }
  }//btnupdate ends Here


  if(isset($_POST['btndelete'])){

    $delete = $pdo->prepare("delete from tbl_category where catid=".$_POST['btndelete']);
    if ($delete->execute()) {
      echo'<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Good Job!",
        text: "Your Category is Deleted",
        icon: "success",
        button: "Ok",
      });



      });

      </script>';
    }else{
      echo '<script type ="text/javascript">
      jQuery(function validation(){

        swal({
        title: "Warning!",
        text: "task failed",
        icon: "warning",
        button: "Ok",
      });



      });

      </script>';

    }

  }




 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category List

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
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Add Category</h3>
          </div>

            <div class="box-body">
            <form role="form" action="" method="post">
            <?php

            if(isset($_POST['btnedit'])){

              $select = $pdo->prepare("select * from tbl_category where catid=".$_POST['btnedit']);

              $select->execute();

              if ($select) {
                $row=$select->fetch(PDO::FETCH_OBJ);

                echo '<div class="col-md-4">
                      <div class="form-group">
                        <label>CATEGORY</label>

                        <input type="hidden" class="form-control" value="'.$row->catid.'" name="txtid" placeholder="Enter category">
                        <input type="text" class="form-control" value="'.$row->category.'" name="txtcategory" placeholder="Enter category">


                      </div>
                      <input type="text" class="form-control" value="'.$row->status.'" name="txtstatus" placeholder="Enter status">


                      <div>
                        <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
                      </div>

                    </div>';
              }


            }else{
              echo'<div class="col-md-4">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="txtcategory" placeholder="Enter category">
                    </div>



                    <div>
                      <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
                    </div>

                  </div>';
            }





             ?>
          <!-- /.box-header -->
          <!-- form start -->

          <div class="col-md-8">
            <table id="tablecategory" class = "table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>CATEGORY</th>
                  <th>STATUS</th>
                  <th>EDIT</th>

                </tr>

              </thead>
              <tbody>

                <?php
                $select=$pdo->prepare("select * from tbl_category order by catid desc");

                $select->execute();

                while($row=$select->fetch(PDO::FETCH_OBJ)){

                  echo'<tr>
                  <td>
                  '.$row->catid.'
                  </td>
                  <td>
                  '.$row->category.'
                  </td>
                  <td>
                  '.$row->status.'
                  </td>
                  <td>
                  <button type="submit" value="'.$row->catid.'" class="btn btn-success" name="btnedit"><span class = "glyphicon glyphicon-edit" style = "color:#ffffff" title="delete"></span></button>
                  </td>


                      </tr>';




                }







                 ?>












              </tbody>

            </table>

          </div>


</form>

            </div>
            <!-- /.box-body -->



        </div>

    </section>
    <!-- /.content -->
  </div>
  <script>
   $(document).ready(function() {
     $('#tablecategory').DataTable({

       "order":[[0,"desc"]]

     });
  });
  </script>
  <!-- /.content-wrapper -->
  <?php

include_once 'footer.php';

 ?>
