<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0)) {
  header('location:logout.php');
  } 
   if ($_SESSION['Rule']==0){
    header('location:dashboard.php');
  } 
  else{
// Code for deletion   
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tbladminmain where PhoneNumber='$cmpid'");
$query=mysqli_query($con,"delete from plantable where PhoneNumber='$cmpid'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='m_modarator.php'</script>";
}

if(isset($_POST['submit'])){
    $phone = $_POST['phones'];
    $limit = $_POST['Total_new_limit'];
    $query=mysqli_query($con,"update plantable set Plan='$limit' where PhoneNumber='$phone'");
    }

if(isset($_GET['close'])){    
    $cmpid=substr(base64_decode($_GET['close']),0,-5);
    $sts=1;
    $query=mysqli_query($con,"update tbladminmain set Status='$sts' where PhoneNumber='$cmpid'");
    echo "<script>window.location.href='m_modarator.php'</script>";
    }
if(isset($_GET['active'])){    
    $cmpid=substr(base64_decode($_GET['active']),0,-5);
    $sts=0;
    $query=mysqli_query($con,"update tbladminmain set Status='$sts' where PhoneNumber='$cmpid'");
    echo "<script>window.location.href='m_modarator.php'</script>";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Modarator</title>
    <!-- Data Table CSS -->
    <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<li class="breadcrumb-item"><a href="#">Manage Modarator</a></li>
<li class="breadcrumb-item active" aria-current="page">information</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
<div class="hk-pg-header">
 <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Manage Modarator</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Account Limit</th>
                                                    <th>Created AC</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$rno=mt_rand(10000,99999);  
$query=mysqli_query($con,"select tbladminmain.PhoneNumber, tbladminmain.Name, tbladminmain.Status, plantable.Plan from tbladminmain inner join plantable on tbladminmain.PhoneNumber =plantable.PhoneNumber");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>                                                
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['Name'];?></td>
<td ><?php echo $row['PhoneNumber'];?></td>
<td id="limit_<?php echo $row['PhoneNumber'];?>"><?php echo $row['Plan'];?></td>
<?php
$phone = $row['PhoneNumber'];
$query2=mysqli_query($con,"select id from tbladmin where Reference='$phone' ");
$Create_AC = $listedcat=mysqli_num_rows($query2);
?>
<td><?php echo $Create_AC ?></td>

<td><?php 
if($row['Status']==0){
    ?>
     <a href="m_modarator.php?close=<?php echo base64_encode($row['PhoneNumber'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="want to close?"> <button type="button" class="btn btn-success">Active</button></a>
    <?php
}
else { ?>
    <a href="m_modarator.php?active=<?php echo base64_encode($row['PhoneNumber'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="want to active?"><button type="button" class="btn btn-warning">Close</button></a>
    <?php
}

?></td>
<td>
<!-- <a href="m_modarator.php?catid=<?php echo base64_encode($row['PhoneNumber'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i></a> -->
<label style="color: blue;" class="mr-25" data-toggle="tooltip" data-original-title="Edit admin limit"> <i id="<?php echo $row['PhoneNumber'];?>" onclick="add_limit(event)" class="icon-pencil"></i></label>
<a href="m_modarator.php?del=<?php echo base64_encode($row['PhoneNumber'].$rno);?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="icon-trash txt-danger"></i> </a>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Medicne Information</h5>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					<div class="modal-body" id="mbody">
                    <div class="card-body">
                            <form method="post" class="row">
                            <div class="">
                                <div class="row mb-3">
                                    <label for="" class="col-sm-4 col-form-label text-start text-sm-end">Old Limit : </label>
                                    <div class="col-sm-8">
                                        <label id ="o_limit" class="form-control" name="o_limit" for=""></label>
                                        <input type="text" id="p_id" hidden name="phones">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-4 col-form-label text-start text-sm-end">New  limit: </label>
                                    <div class="col-sm-8">
                                        <input type="text" onkeyup="total_limit()" id="n_limit" class="form-control" name="n_limit" placeholder="Enter new limit">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-4 col-form-label text-start text-sm-end">Total : </label>
                                    <div class="col-sm-8">
                                        <label id ="Total_new_limit2" class="form-control"></label>
                                        <input type="text" hidden id ="Total_new_limit" class="form-control" name="Total_new_limit">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="col-md-12">
                                <div class="d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
                                    <button style="min-width: 150px;" type="submit" class="btn btn-success" name="submit" >Submit</button>
                                </div>
                            </div>					
                            </form>	
                        </div>
					</div>
				</div>
			</div>
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
    <script src="dist/index.js"></script>
</body>
</html>
<?php } ?>