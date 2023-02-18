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
        Customer List
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
          </div>

            <div class="box-body">
              <table id = "tablecustomer" class = "table table-striped"  >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full name</th>
                    <th>Email address</th>
                    <th>Status</th>
                    <th>Edit</th>
                  </tr>

                </thead>
                <tbody>

                  <?php
                  $select=$pdo->prepare("select * from tbl_customer order by customerid desc");

                  $select->execute();

                  while($row=$select->fetch(PDO::FETCH_OBJ)){

                    echo'<tr>
                    <td>
                    '.$row->customerid.'
                    </td>
                    <td>
                    '.$row->username.'
                    </td>
                    <td>
                    '.$row->useremail.'
                    </td>
                    <td>
                    '.$row->status.'
                    </td>
                    <td>
                    <a href = "editcustomer.php?id='.$row->customerid.'"  class="btn btn-info" role = "button" ><span class = "glyphicon glyphicon-edit" style = "color:#ffffff" data-toggle="tooltip" title="edit"></span></a>
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
     $('#tablecustomer').DataTable({

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
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {

    $.ajax({
      url: 'customerdelete.php',
      type:'post',
      data:{
        customeridd:id
      },
      success: function(data){
        tdh.parents('tr').hide();
      }



    });
    swal("Customer Account has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Customer Account not deleted!");
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
