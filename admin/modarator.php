<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0) && isset($_SESSION['Rule'])) {
  header('location:logout.php');
  }
  if ($_SESSION['Rule']==0){
    header('location:dashboard.php');
  }  
  else{
// Add Category Code
    if(isset($_POST['submit']))
    {
    //Getting Post Values
    $name=$_POST['name']; 
    $phone=$_POST['phone']; 
    $email=$_POST['email']; 
    $rule=$_POST['rule']; 
    $limit=$_POST['creationlimit']; 
    $pass=md5($_POST['password']); 
    $adminID = $_SESSION['admin'];

                $file_name = $_FILES['photo']['name'];
                $file_tmp_name = $_FILES['photo']['tmp_name'];

            if( empty($file_name))
                {
                $file_name = 'avatar.jpg';
                }
            else
                {
                $location = "dist/img/".$file_name;
                move_uploaded_file($file_tmp_name, $location);
                }



    $status = 0;
    $query=mysqli_query($con,"insert into tbladminmain(Name,PhoneNumber,Email,Rule,Password,Photo,Status) values('$name','$phone','$email','$rule','$pass','$file_name','$status')"); 
    $query=mysqli_query($con,"insert into plantable(PhoneNumber,Plan,Status) values('$phone','$limit','$status')"); 
        if($query){
            echo "<script>alert('Modarator added successfully.');</script>";   
            echo "<script>window.location.href='modarator.php'</script>";
        } else{
            echo "<script>alert('Something went wrong. Please try again.');</script>";   
            echo "<script>window.location.href='modarator.php'</script>";    
        }
    }

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Modarator</title>
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
                <li class="breadcrumb-item"><a href="#">Create Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Modarator</li>
                        </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Create Account</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">

                        <div class="row">
                        <div class="col-sm">
                        <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate >
                                                            
                        <div class="form-row">
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Name</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter Name" name="name" required>
                                <div class="invalid-feedback">Please provide a valid Name.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Phone Number</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter Phone no" name="phone" required>
                                <div class="invalid-feedback">Please provide a valid phone no.</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="validationCustom03">Email</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter your email" name="email">
                                <div class="invalid-feedback">Please provide a valid Email.</div>
                            </div>
                            <div class="col-md-6 mb-10">
                                <label for="validationCustom03">Rule</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter user rule" name="rule">
                                <div class="invalid-feedback">Please provide a valid Rule.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Password</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Creat Password" name="password" required>
                                <div class="invalid-feedback">Please provide a valid password</div>
                            </div>
                            <div class="col-md-6 col-12 mb-12">
                                <label for="validationCustom03">Account Limit</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Creat Password" name="creationlimit" required>
                                <div class="invalid-feedback">Please provide a valid password</div>
                            </div>
                            <div class="col-md-12 col-12 mb-12">
                                <label for="validationCustom03">Select Photo</label>
                                <input type="file" class="form-control" id="validationCustom03" placeholder="Select Photo" name="photo">
                                <div class="invalid-feedback">Please provide a valid photo.</div>
                            </div>
                        </div>
                       

                        <button class="btn btn-primary mt-3" type="submit" name="submit">Submit</button>
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