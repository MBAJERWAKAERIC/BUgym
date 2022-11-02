<?php include('../constant/layout/head.php');?>
<?php include('../constant/layout/header.php');?>
<?php include('../constant/layout/sidebar.php');
?>
 

  <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Edit Routines</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Routines</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="addroutine.php"><button class="btn btn-primary">Add Routines</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
        <tr>
          <th>Sl.No</th>
          <th>Routine Name</th>
          <th>Routine Details</th>
          <th>Delete Routine</th>
        </tr>
      </thead>    
        <tbody>
          <?php
          $query  = "select * from timetable";
          //echo $query;
          $result = mysqli_query($con, $query);
          $sno    = 1;

          if (mysqli_affected_rows($con) != 0) 
          {
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
            {

                ?>  
                  
                  <tr>
                    <td><?php echo $sno ?></td>
                     <td><?php echo $row['tname']; ?></td>
                  
                  
                  
                 <td>
                  <a href="editdetailroutine.php?id=<?php echo $row['tid'];?>"><button type="button" class="btn btn-primary btn-flat m-b-30 m-t-30" value="Edit Routine">Edit Routine</button></a></td>
                 <td>
                  <a href="deleteroutine.php?id=<?php echo $row['tid'];?>"><button type="button" class="btn btn-danger btn-flat m-b-30 m-t-30" onclick="return confirm('Are you sure to delete this record?')"value="Delete Routine">Delete Routine</button></a>
                </td>
                </tr>
                  
              <?php 
              $sno++; 
              $msgid = 0;
              }
              
          }

          ?>  

        </tbody>
                                      
                                    </table>
                                </div>
                            </div>
                        </div>
               
                <!-- /# row -->

                <!-- End PAge Content -->
           

<?php include('../constant/layout/footer.php');?>
  <!--  This Project Developed by: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me through https://www.mayurik.com  -->

