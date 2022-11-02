
<?php include('../constant/layout/head.php');?>
<?php include('../constant/layout/header.php');?>

<?php include('../constant/layout/sidebar.php');?> 
<link rel="stylesheet" href="popup_style.css">
  <!--  Project Developed by: MayuriK. 
 for any PHP, Codeignitor or Laravel work contact me through www.mayurik.com  -->
 <?php
//session_start();
//error_reporting(0);
include('../constant/connect.php');

       
       

?>
<?php
        $id=$_GET['id'];
        //echo $id;exit;
        $sql="Select * from plan  Where pid='".$_GET['id']."'";
        $res=mysqli_query($con, $sql);
        //echo $sql;exit;
                     if($res){
                                $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
                                //print_r($row);exit;
                
                              }
                        
        ?>
  <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Edit Plan Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Plan</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">

                                    <form class="form-horizontal" method="POST"  name="userform" enctype="multipart/form-data" action="updateplan.php" id="form1" name="form1">

                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">PLAN ID</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="planid" id="planID" readonly value='<?php echo $row['pid'] ?>' class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                  

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">PLAN NAME</label>
                                                <div class="col-sm-9">
                                                 <input name="planname" id="planName" type="text" value='<?php echo $row['planName'] ?>' class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">PLAN DESCRIPTION</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="desc" id="planDesc"  value='<?php echo $row['description'] ?>' class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">PLAN VALIDITY</label>
                                                <div class="col-sm-9">
                                                 <input type="number" name="planval" id="planVal" value='<?php echo $row['validity'] ?>' class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>

                                      <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">PLAN AMOUNT</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="amount" id="planAmnt" value='<?php echo $row['amount'] ?>' class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" id="submit" value="UPDATE PLAN" class="btn btn-primary btn-flat m-b-30 m-t-30">UPDATE PLAN</button>
                                         <button type="reset" name="reset" id="reset" value="Reset" class="btn btn-primary btn-flat m-b-30 m-t-30">Reset</button>

                
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               
                <!-- /# row -->

                <!-- End PAge Content -->
    

<?php include('../constant/layout/footer.php');?>
  <!--  This Project Developed by: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me through https://www.mayurik.com  -->

