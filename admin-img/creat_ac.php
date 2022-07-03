<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0)) {
  header('location:logout.php');
  } else{
    // Add Category Code
    $reference = $_SESSION['admin'];
    $query=mysqli_query($con,"Select * from plantable where PhoneNumber='$reference'");
    $row=mysqli_fetch_array($query);
    $plan = $row['Plan'];
    $query=mysqli_query($con,"select id from tbladmin where Reference='$reference' ");
    $listedcat=mysqli_num_rows($query);
    
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $pin = $_POST['pin'];
        $sql="INSERT INTO img_info (Title, Description, Reference,Pin)VALUES(:title,:description,:reference,:pin)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':title',$title,PDO::PARAM_STR);
			$query->bindParam(':description',$description,PDO::PARAM_STR);
			$query->bindParam(':reference',$reference,PDO::PARAM_STR);
			$query->bindParam(':pin',$pin,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
        
        $countfiles = count($_FILES['files']['name']);
        $sql2="INSERT INTO image (Pair, PicName)VALUES(:lastInsertId,:filename)";

        // Loop all files
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['files']['name'][$i];
            $file_tmp_name = $_FILES['files']['tmp_name'][$i];
            $extt = explode(".", $filename);
            $ext = end($extt);
            $valid_ext = array("png","jpeg","jpg");
            $query = $dbh->prepare($sql2);
			$query->bindParam(':lastInsertId',$lastInsertId,PDO::PARAM_STR);
			$query->bindParam(':filename',$filename,PDO::PARAM_STR);
            if(in_array($ext, $valid_ext)){
                $location = "./upload/".$filename;
			    move_uploaded_file($file_tmp_name, $location);
                $query->execute();
            }    
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
                <li class="breadcrumb-item"><a href="#">Create Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Account</li>
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
                            <div class="col-md-6 col-12 mb-3">
                                <label for="validationCustom03">Select Photo</label>
                                <input type="file" class="form-control" id="validationCustom03" placeholder="Select Photo" name="files[]" multiple>
                                <div class="invalid-feedback">Please provide a valid photo.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="validationCustom03">Title</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter your title" name="title" required>
                                <div class="invalid-feedback">Please provide a valid Name.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="validationCustom03">Description</label>
                                <textarea type="text" style="resize: none;" class="form-control" id="validationCustom03" placeholder="Enter Description"  maxlength="500" name="description" rows='3' required> </textarea>
                                <div class="invalid-feedback">Please provide a valid phone no.</div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="validationCustom03">Secret PIN</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter your secret PIN" name="pin" required>
                                <div class="invalid-feedback">Please provide a valid PIN.</div>
                            </div>
                        </div> 
                        <button class="btn btn-primary mt-3 mb-3" type="submit" name="submit">Submit</button>
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