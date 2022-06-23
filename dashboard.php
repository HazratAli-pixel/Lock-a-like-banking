<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard</title>
    <link href="vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">

            <?php
            $adminid=$_SESSION['aid'];
            $query=mysqli_query($con,"select * from tbladmin where MobileNumber='$adminid'");
            $row=mysqli_fetch_array($query);
            $listedcat=mysqli_num_rows($query);
            ?>

<div class="col-lg-6 col-md-12">
<div style="background-color: rgb(252, 3, 127)" class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5">
<div >
<span  class="d-block font-15 text-white font-weight-500">Information</span>
</div>
<div>
</div>
</div>
<div class="pl-80" >
<span class="d-block display-7 text-white "> <strong>Name : <?php echo $row['AdminName'];?></strong></span>
<small class="d-block text-white">Phone : <?php echo $row['MobileNumber'];?></small>
<small class="d-block text-white">Ac No: <?php echo $row['UserName'];?></small>
<small class="d-block text-white">Akhama (NID) : <?php echo $row['AkhamaNumber'];?></small>
</div>
</div>
</div>
</div>

            <?php
            $adminid= $row['UserName'];
            $query=mysqli_query($con,"select * from accountbalance where UserName='$adminid'");
            $row=mysqli_fetch_array($query);
            $listedcat=mysqli_num_rows($query);
            ?>

<div class="col-lg-6 col-md-12">
<div style="background-color: rgb(252, 3, 127)" class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5">
<div >
<span  class="d-block font-15 text-white font-weight-500">Available Balance</span>
</div>
<div>
</div>
</div>
<div class="text-center mb-4">
<span class="display-4 text-white mt-3"><?php echo $row['AcBal'];?></span>
<span class="display-8 text-white mb-3">tk</span>
</div>
</div>
</div>
</div>



<div class="card border-success ml-2" style="max-width: 10rem; min-width: 7rem;">
  <div class="card-body text-success">
  <span class="d-block text-center display-4 text-dark mb-5"><img src="dist/img/money-transfer.png" alt="user" style="width: 50px;" class="avatar-img"></span>
    <p  class="card-text "><strong><a href="banktrans.php" style="color: rgb(252, 3, 127)" class="stretched-link">Bank Transfer</a></strong></p>
  </div>
</div>

<div class="card border-success ml-2" style="max-width: 10rem; min-width: 7rem;">
  <div class="card-body text-success">
  <span class="d-block text-center display-4 text-dark mb-5"><img src="dist/img/send.jpg" alt="user" style="width: 50px;" class="avatar-img"></span>
    <p  class="card-text "><strong><a href="cashout.php" style="color: rgb(252, 3, 127)" class="stretched-link">Cash Out</a></strong></p>
  </div>
</div>

<div class="card border-success ml-2" style="max-width: 10rem; min-width: 7rem;">
  <div class="card-body text-success">
  <span class="d-block text-center display-4 text-dark mb-5"><img src="dist/img/send-money2.png" alt="user" style="width: 50px;" class="avatar-img"></span>
    <p  class="card-text "><strong><a href="#" style="color: rgb(252, 3, 127)" class="stretched-link">Send Money</a></strong></p>
  </div>
</div>

<div class="card border-success ml-2" style="max-width: 10rem; min-width: 7rem;">
  <div class="card-body text-success">
  <span class="d-block text-center display-4  text-dark mb-5"><img src="dist/img/deposit.png" alt="user" style="width: 50px;" class="avatar-img"></span>
    <p  class="card-text "><strong><a href="deposit.php" style="color: rgb(252, 3, 127)" class="stretched-link">Deposit</a></strong></p>
  </div>
</div>

<div class="card border-success ml-2" style="max-width: 10rem; min-width: 7rem;">
  <div class="card-body text-success">
  <span class="d-block text-center display-4 text-dark mb-5"><img src="dist/img/payment.png" alt="user" style="width: 50px;" class="avatar-img"></span>
    <p  class="card-text "><strong><a href="#" style="color: rgb(252, 3, 127)" class="stretched-link">Payment</a></strong></p>
  </div>
</div>


</div>
					
            </div>
            <!-- /Container -->
			
            <!-- Footer -->
<?php include_once('includes/footer.php');?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
    <script src="dist/js/validation-data.js"></script>

	
</body>

</html>
<?php } ?>