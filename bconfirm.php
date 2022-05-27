<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
        if(isset($_POST['Confirm']))
        {
        $adminid=$_SESSION['aid']; //phone Number
        $account = $_SESSION['account'];
        $Money=$_SESSION['money'];
        $pin=$_POST['PIN']; 
        $query=mysqli_query($con,"Select * FROM secretpin where Account='$account'");
        $row=mysqli_fetch_array($query); 
        if($row['Pin']==$pin){ 
            //swal("Good job!", "You clicked the button!", "success");
            
            $query=mysqli_query($con,"Select * FROM accountbalance where UserName='$account'");
            $row=mysqli_fetch_array($query);
            $correntBal =$row['AcBal'];
            $newBal =$correntBal-$Money;
            $query=mysqli_query($con,"update accountbalance set Acbal='$newBal' where UserName='$account'");
            unset ($_SESSION['money']); 
            echo "<script>alert('Cash Out Successfull & new Balance : $newBal.');</script>"; 
            ?>
            <script>window.location.href='dashboard.php'</script>";<?php
        }
        else{
            echo "<script>alert('PIN not correct.');</script>";  
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Cashout</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
<li class="breadcrumb-item"><a href="#">Bank Transfer</a></li>
<?php 
$adminid=$_SESSION['aid'];
$query=mysqli_query($con,"select * from tbladmin where MobileNumber='$adminid'");
$row=mysqli_fetch_array($query);
?>
<li class="breadcrumb-item active" aria-current="page">Secret Pin</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
               <!-- Title -->
               <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Secret PIN</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>


<div class="form-row">
<div class="col-md-6 mb-10">
<label style="color: rgb(252, 3, 127)" for="validationCustom03"><strong> Secret PIN</strong></label>
<input type="text" class="form-control" placeholder="your secret pin" id="validationCustom03" value="" name="PIN">
<p style="color: rgb(252, 100, 200)" class="text-center" for="validationCustom03">--To get secret pin please contact authority</p>
</div>
</div>
                        
<button class="btn" style="color: rgb(255, 255, 255); background-color: rgb(252, 3, 127)" type="submit" name="Confirm">Confirm</button>

</form>
</div>
</div>
</section>
                     
</div>
</div>
</div>


            <!-- Footer -->
<?php include_once('includes/footer.php');?>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>

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