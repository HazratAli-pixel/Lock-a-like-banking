<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0)) {
  header('location:logout.php');
  } else{
// Code for deletion       
    if(isset($_GET['add'])){  
        $ref=$_SESSION['admin'];  
        $cmpid=substr(base64_decode($_GET['add']),0,-5);
        $time = $_GET['time'];
        $query1=mysqli_query($con,"select * from deposit where Account='$cmpid' AND Reference='$ref' AND Inputdate='$time'");
        $row1=mysqli_fetch_array($query1);
        $C_balance = $row1['Amount'];

        $query2=mysqli_query($con,"select * from accountbalance where UserName='$cmpid'");
        $row2=mysqli_fetch_array($query2);
        $P_balance = $row2['AcBal'];

        $balance = $C_balance+$P_balance;
        $query3=mysqli_query($con,"update accountbalance set AcBal='$balance' where UserName='$cmpid'"); 

        $query4=mysqli_query($con,"update deposit set Status='1' where Account='$cmpid' AND Reference='$ref' AND Inputdate='$time' "); 

    
    echo "<script>alert('Funds are Added.');</script>";   
    echo "<script>window.location.href='add-funds.php'</script>";
    }
    if(isset($_GET['del'])){  
        $ref=$_SESSION['admin'];  
        $cmpid=substr(base64_decode($_GET['del']),0,-5);
        $time = $_GET['time'];
        $query=mysqli_query($con,"DELETE FROM deposit where Account='$cmpid' AND Reference='$ref' AND Inputdate='$time'");
        

    echo "<script>alert('Funds are deleted.');</script>";   
    echo "<script>window.location.href='add-funds.php'</script>";
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage User</title>
    <!-- Data Table CSS -->
    <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    
   
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">
<!-- Top Navbar -->
<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">User Info</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
<div class="hk-pg-header">
 <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Manage User Info</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div style="overflow-x:scroll;">
                                        <table style="min-width: 600px;"  id="datable_1" class=" table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Account</th>
                                                    <th>Bank Name</th>
                                                    <th>Amount</th>
                                                    <th>Comment</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rno=mt_rand(10000,99999); 
                                                $ref=$_SESSION['admin'];
                                                $query = mysqli_query($con,"SELECT * FROM deposit where Reference='$ref' order by Status");
                                                $cnt=1;
                                                while($row=mysqli_fetch_array($query))
                                                {
                                                    
                                                ?>                                                
                                                <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['Account'];?></td>
                                                <td><?php echo $row['BankName'];?></td>
                                                <td><?php echo $row['Amount'];?></td>
                                                <td><?php 
                                                if($row['Status']==0){
                                                    ?>
                                              <button type="button" class="btn btn-warning">Pending</button>
                                                
                                            
                                            <?php }else { ?> <button type="button" class="btn btn-success">Success</button> <?php }
                                                
                                                
                                                ;?></td>
                                                
                                                <td>
                                                 <!--<a href="edit-pin.php?compid=<?php echo base64_encode($row['Account'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="reject"> <i class="icon-pencil"></i></a> -->
                                                
                                                <?php if ($row['Status']!=1){ ?>
                                                <a href="add-funds.php?add=<?php echo base64_encode($row['Account'].$rno);?>&time=<?php echo $row['Inputdate'];?>"  class="mr-25" data-toggle="tooltip" data-original-title="Add" onclick="return confirm('Do you really want to add?');"> <i class="icon-plus txt-danger"></i> </a> 
                                                <a href="add-funds.php?del=<?php echo base64_encode($row['Account'].$rno);?>&time=<?php echo $row['Inputdate'];?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to Delete?');"> <i class="icon-trash txt-danger"></i> </a><?php } ?>
                                                </td>
                                                </tr>
                                                <?php 
                                                $cnt++;
                                                } ?>
                                                                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

            <!-- Footer -->
<?php include_once('includes/footer.php');?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /HK Wrapper -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
</body>
</html>
<?php } ?>