<?php
session_start();
//error_reporting(0);
include('includes/config.php');
// if (strlen($_SESSION['admin']==0)) {
//   header('location:createac.php');
//   } else{
    // Add product Code
    if(isset($_POST['submit']))
    {
        //Getting Post Values
        $ref = $_SESSION['admin'];
        $package=$_POST['package']; 
        $paymentby=$_POST['paymentby'];   
        $PaymentNumber=$_POST['PaymentNumber'];
        $taka=$_POST['taka'];
        $Tid=$_POST['Tid'];
        $query=mysqli_query($con,"insert packagetbl (Reference,Quantity,PaymentWay,PaymentNumber,Taka,T_id,Status) values('$ref','$package','$paymentby','$PaymentNumber','$taka','$Tid','0')"); 
        if($query){
            echo "<script>alert('Package purchase is successful. Wait for confermation');</script>";   
            echo "<script>window.location.href='package.php'</script>";
        } else{
            echo "<script>alert('Something went wrong. Please try again.');</script>";   
            echo "<script>window.location.href='dashboard.php'</script>"; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Product</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
    
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

<!-- Top Navbar -->
<?php //include_once('includes/navbar.php');
//include_once('includes/sidebar.php');
?>
       


        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->



        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
<li class="breadcrumb-item"><a href="#">Price Plan</a></li>
<li class="breadcrumb-item active" aria-current="page">Price</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Package Information</h4>
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
<label for="validationCustom03">Agent Package</label>
<ul>
    <li class="ml-3"> 🠶 1 to 3 = 2150 tk</li>
    <li class="ml-3"> 🠶 4 to 6 = 4000 tk</li>
    <li class="ml-3"> 🠶 7 to 10 = 6000 tk</li>
    <li class="ml-3"> 🠶 11 to 15 = 8000 tk</li>
    <li class="ml-3"> 🠶 16 to 20 = 9,500 tk</li>
    <li class="ml-3"> 🠶 21 to 40 = 16,000 tk</li>
    <li class="ml-3"> 🠶 41 to 100 = 20,000 tk</li>
    <li class="ml-3"> 🠶 101 to 500 = 25,000 tk</li>
</ul>
</div>
</div>


<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Choose Package</label>
<select class="form-control custom-select" name="package" required>
<option value="">Select Package</option>
<option value="1-3">1 to 3 = 2150 tk</option>
<option value="4-6">4 to 6 = 4000 tk</option>
<option value="7-10">7 to 10 = 6000 tk</option>
<option value="11-15">11 to 15 = 8000 tk</option>
<option value="16-20">16 to 20 = 9,500 tk</option>
<option value="21-40">21 to 40 = 16,000 tk</option>
<option value="41-100">41 to 100 = 20,000 tk</option>
<option value="101-500">101 to 500 = 25,000 tk</option>
</select>
<div class="invalid-feedback">Please select a package.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Payment method</label>
 <select class="form-control custom-select" name="paymentby" required>
<option value="">Select Payment Method</option>
<option value="Bkash">Bkash</option>
<option value="Nagad">Nagad</option>
<option value="Rocket">Rocket</option>
<option value="Mcash">Mcash</option>
</select>
<div class="invalid-feedback">Please select a payment mathod.</div>
</div>
</div>
 <div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Payment (taka)</label>
<input type="number" class="form-control" id="validationCustom03" placeholder="Enter your ammount" name="taka" required>
<div class="invalid-feedback">Please provide a valid amount.</div>
</div>
</div>   

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Phone Number</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Enter your phone number" name="PaymentNumber" required>
<div class="invalid-feedback">Please provide a valid Phone Number.</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Transection ID</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Enter Transection ID" name="Tid" required>
<div class="invalid-feedback">Please provide a valid Transection ID.</div>
</div>
</div>

<button class="btn btn-primary" type="submit" name="submit">Submit</button>
<a href="createac.php"><p class="btn btn-primary" type="" name="">Sign Up</p></a>
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
<?php //} ?>