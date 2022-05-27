<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0)) {
  header('location:logout.php');
  } else{
    // Add Category Code
    $reference = $_SESSION['admin'];
    $compid=substr(base64_decode($_GET['compid']),0,-5);
    $query=mysqli_query($con,"Select * from plantable where PhoneNumber='$reference'");
    $row=mysqli_fetch_array($query);
    $plan = $row['Plan'];
    $query=mysqli_query($con,"select id from tbladmin where Reference='$reference' ");
    $listedcat=mysqli_num_rows($query);
    
    if(isset($_POST['submit']))
    {
            //Getting Post Values
            $name=$_POST['name']; 
            $phone=$_POST['phone']; 
            $email=$_POST['email']; 
            $NID=$_POST['NID']; 
            $balance=$_POST['balance']; 
            $baccount=$_POST['B_account']; 
            $pass=md5($_POST['password']); 
            $pin=$_POST['pin']; 
            $adminID = $_SESSION['admin'];

            $file_name = $_FILES['photo']['name'];
			$file_tmp_name = $_FILES['photo']['tmp_name'];
            if( empty($file_name))
			{
                //no change
			}
            else{
			$location = "../dist/img/".$file_name;
			move_uploaded_file($file_tmp_name, $location);
            }


            $cnt = 1;
            $query1=mysqli_query($con,"update  tbladmin set (AdminName,UserName,AkhamaNumber,Email,photo,MobileNumber,password,Reference,Status) values('$name','$baccount','$NID','$email','$file_name','$phone','$pass','$adminID','$cnt')"); 
            $query2=mysqli_query($con,"insert into accountbalance(UserName,AcBal) values('$baccount','$balance')"); 
            $query3=mysqli_query($con,"insert into secretpin(Account,Pin,AdminId,Status) values('$baccount','$pin','$adminID','$cnt')");
        if($query1){
        echo "<script>alert('Category added successfully.');</script>";   
        echo "<script>window.location.href='creat_ac.php'</script>";
        } else{
            echo "<script>alert('Something went wrong. Please try again.');</script>";   
            echo "<script>window.location.href='creat_ac.php'</script>";    
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Job</title>
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
                <li class="breadcrumb-item"><a href="#">Update Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Account</li>
                        </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Update Account</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">

                        <div class="row">
                        <div class="col-sm">
                        <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate >
                        <?php 
                        $query = mysqli_query($con,"SELECT tbladmin.Email,tbladmin.AkhamaNumber,tbladmin.photo, tbladmin.UserName, tbladmin.AdminName,tbladmin.MobileNumber,tbladmin.Status, tbladmin.Reference, accountbalance.AcBal,secretpin.Pin FROM ((tbladmin INNER JOIN accountbalance ON accountbalance.UserName = tbladmin.UserName) INNER JOIN secretpin ON tbladmin.UserName = secretpin.Account AND tbladmin.UserName='$compid')");
                        $row=mysqli_fetch_array($query);
                        ?>     
                        

                        <div class="form-row">
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Name</label>
                                <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['AdminName'];?>" placeholder="Enter Name" name="name" required>
                                <div class="invalid-feedback">Please provide a valid Name.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Phone Number</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter Phone no" name="phone"  value="<?php echo $row['MobileNumber'];?>" required>
                                <div class="invalid-feedback">Please provide a valid phone no.</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="validationCustom03">Email</label>
                                <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['Email'];?>" placeholder="Enter your email" name="email">
                                <div class="invalid-feedback">Please provide a valid Email.</div>
                            </div>
                            <div class="col-md-6 mb-10">
                            <label for="validationCustom03">Akhama/ Passport / NID</label>
                            <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['AkhamaNumber'];?>" placeholder="Enter Akhama/ Passport / NID" name="NID">
                            <div class="invalid-feedback">Please provide a valid NID.</div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Balance</label>
                                <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['AcBal'];?>"  placeholder="Enter Balance (tk)" name="balance" required>
                                <div class="invalid-feedback">Please provide a valid amount.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Bank Account</label>
                                <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['UserName'];?>"  name="B_account" disabled required>
                                <div class="invalid-feedback">Please provide a valid bank account.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Secret PIN</label>
                                <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['Pin'];?>" placeholder="Enter your secret PIN" name="pin" required>
                                <div class="invalid-feedback">Please provide a valid PIN.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Want to change? Select Photo</label>
                                <input type="file" class="form-control" id="validationCustom03"  placeholder="Want to change?" name="photo">
                                <div class="invalid-feedback">Please provide a valid photo.</div>
                            </div>

                        </div>
                        <!-- <button class="btn btn-primary mt-3 mb-3" type="submit" name="submit">Update</button> -->
                        <?php 
                        $msg=$plan*.80;
                        if($listedcat>$msg){ ?>
                        <p style="font-size:12px;">Your account creation limite is <?php echo $plan; ?>. You all ready created  <?php echo $listedcat; ?> Accounts. Please Upgrade your account to avoid any interruption. Thank you</p>
                        <?php  } 
                        if ($listedcat>=$plan){
                        ?>
                        <p style="font-size:12px;">You can not create new account only update is available. Your account creation limite is <?php echo $plan; ?>. So Please Upgrade your Account or contact +8801306-440448, Upgrade plan <a href="#"> click here</a> </p>
                        
                        <?php } ?>

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