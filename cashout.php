<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Add company Code
if(isset($_POST['cashout']))
{
$adminid=$_SESSION['aid'];   
$password=md5($_POST['password']);    
$query=mysqli_query($con,"Select * FROM tbladmin where MobileNumber='$adminid'");
$row=mysqli_fetch_array($query); 
if($row['Password']==$password){  
    $_SESSION['money'] = $_POST['money'];    
    $_SESSION['BankName'] = $_POST['BankName'];
    ?>
    <script>window.location.href='confirm.php'</script>";
<?php
}
else{
    echo "<script>alert('Password not correct.');</script>";  
}
// if($query){
// echo "<script>alert('Admin details updated successfully.');</script>";   
// echo "<script>window.location.href='profile.php'</script>";
//} 
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
<li class="breadcrumb-item"><a href="#">cashout</a></li>
<?php 
$adminid=$_SESSION['aid'];
$query=mysqli_query($con,"select * from tbladmin where MobileNumber='$adminid'");
$row=mysqli_fetch_array($query);
?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $row['AdminName'];?></li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
               <!-- Title -->
               <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Cash Out</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
<?php 
//Getting admin name
$adminid=$_SESSION['aid'];
$query=mysqli_query($con,"select * from tbladmin where MobileNumber='$adminid'");
while($row=mysqli_fetch_array($query)){
?>   




<div class="form-row">
<div class="col-md-6 mb-10">
<label style="color: rgb(252, 3, 127)" for="validationCustom03"><strong>Bank Name</strong></label>

<select class="form-control"  id="select-state" placeholder="Select a Bank..." name="BankName" required>
    <option style="color:rgb(222,212,212)" >Select a Bank...</option>
    <?php 
    $sql = "SELECT * from  bankname ORDER BY BankName";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    foreach($results as $result){ ?>
    <option value="<?php echo htmlentities($result->BankName);?>"><?php echo htmlentities($result->BankName);?></option>

    <?php } ?>
  </select>




<div class="invalid-feedback">Please provide a valid  name.</div>
</div>
</div>
<?php 
$adminid=$_SESSION['aid'];
$query=mysqli_query($con,"select * from tbladmin where MobileNumber='$adminid'");
$row=mysqli_fetch_array($query);
?>


<div class="form-row">
<div class="col-md-6 mb-10">
<label style="color: rgb(252, 3, 127)" for="validationCustom03"><strong> Account No</strong></label>
<input type="number" class="form-control" id="validationCustom03" value="<?php echo $row['UserName'];?>" name="AcNo">
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label style="color: rgb(252, 3, 127)" for="validationCustom03"><strong> Amount of money</strong></label>
<input type="number" class="form-control" placeholder="Amount of money" id="validationCustom03" name="money" required>
<div class="invalid-feedback"></div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label style="color: rgb(252, 3, 127)" for="validationCustom03"><strong> Password</strong></label>
<input type="password" class="form-control" id="validationCustom03" value="" name="password" required>
</div>
</div>



<?php } ?>
                             
<button class="btn" style="color: rgb(255, 255, 255); background-color: rgb(252, 3, 127)" type="submit" name="cashout">Submit</button>
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