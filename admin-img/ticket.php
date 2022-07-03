<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0)) {
    header('location:index.php');  	
  } else{
    if(isset($_GET['del'])){
        $picID = $_GET['del']; 
        $sql ="SELECT * FROM image WHERE ID=:picID";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':picID', $picID, PDO::PARAM_STR);
        $query-> execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        $filename =$result->PicName;
        $id=$_GET['id'];
        if($query->rowCount() > 0){
            $location = "./upload/".$filename;
            unlink($location);
            $sql = "delete FROM image WHERE ID='$picID'";
            $query=mysqli_query($con,$sql);
            header('location:ticket.php?id='.$id);
        }else{
            header('location:ticket.php?id='.$id);
        }
    }
    if(isset($_POST['add_pic'])){
        $Pair_id=$_GET['id'];
        $countfiles = count($_FILES['files']['name']);
        $sql2="INSERT INTO image (Pair, PicName)VALUES(:Pair_id,:filename)";

        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['files']['name'][$i];
            $file_tmp_name = $_FILES['files']['tmp_name'][$i];
            $extt = explode(".", $filename);
            $ext = end($extt);
            $valid_ext = array("png","jpeg","jpg");
            $query = $dbh->prepare($sql2);
			$query->bindParam(':Pair_id',$Pair_id,PDO::PARAM_STR);
			$query->bindParam(':filename',$filename,PDO::PARAM_STR);
            if(in_array($ext, $valid_ext)){
                $location = "./upload/".$filename;
			    move_uploaded_file($file_tmp_name, $location);
                $query->execute();
            }  
        }
    }
    if(isset($_POST['cng_pic'])){
        $PicID=$_POST['PicID'];
        $filename = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $extt = explode(".", $filename);
        $ext = end($extt);
        $valid_ext = array("png","jpeg","jpg");
        if(in_array($ext, $valid_ext)){
            $sql ="SELECT * FROM image WHERE ID=:PicID";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':PicID', $PicID, PDO::PARAM_STR);
            $query-> execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            $filename2 =$result->PicName;
            $location = "./upload/".$filename2;
            unlink($location);
            $query2=mysqli_query($con,"update image set PicName='$filename' where ID='$PicID'");
            $location = "./upload/".$filename;
			move_uploaded_file($file_tmp_name, $location); 
        }  
    }
    if(isset($_POST['update_info'])){
        $ID=$_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query2=mysqli_query($con,"update img_info set Title='$title', Description='$description'  where ID='$ID'");  
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Pic Edit</title>
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
            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header pt-3">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Listed Picture</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">

                        <div class="row">
                            <div class="col-sm">
                                <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                    <div>
                                        <div class="row">
                                            <?php
                                            if(isset($_GET['id'])){
                                                $id=$_GET['id'];
                                                $sql = "SELECT * FROM img_info LEFT JOIN image ON img_info.ID =image.Pair WHERE img_info.ID='$id'";
                                                $query=mysqli_query($con,$sql);
                                                $row=mysqli_fetch_array($query);
                                            }                 
                                            ?>
                                            <!-- <div class="col-12">
                                                <h1 style="text-align: center;">Thailand Lottery Ticket</h1>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="">
                                                    <div class="card-header" style="justify-content: center; text-align: center;">
                                                        <input type="text" class="form-control" style="text-align: center;" name="title" value="<?php echo $row['Title'];?>">
                                                        <input type="text" class="form-control mt-2" style="text-align: center;" name="description" value="<?php echo $row['Description'];?>">
                                                        <button type="submit" name="update_info" type="button" style="justify-content: center;" class="btn btn-primary mt-3" value="">Update</button>
                                                    </div>
                                                    <!-- <div class="card-body" >
                                                        
                                                    </div> -->
                                                    
                                                    <div class="card-footer">
                                                        
                                                            <?php 
                                                            $sql2="SELECT * FROM image where Pair='$id'";
                                                            $query2=mysqli_query($con,$sql2);
                                                                while($row2=mysqli_fetch_array($query2)){
                                                                ?> 
                                                            <div class="card mb-1">
                                                                <div class="card-body d-flex justify-content-center" style="overflow: hidden;">
                                                                    <a style="margin: -10px;" class="<?php echo $id?>" href="./upload/<?php echo $row2['PicName'];?>"><img style="max-width: 300px;" src="./upload/<?php echo $row2['PicName'];?>" alt="<?php echo $row2['PicName'];?>"></a>
                                                                </div>
                                                                <div style="text-align: center;" class="mb-3">
                                                                    <label id="<?php echo $row2['ID'];?>" class="btn btn-warning" onclick="chagnepic(event)" style="color: blue;" class="mr-25" data-toggle="tooltip" data-original-title="Edit admin limit"> <i id="<?php echo $row2['ID'];?>" class="icon-pencil"></i></label>
                                                                    <a href="ticket.php?id=<?php echo $id;?>&del=<?php echo $row2['ID'];?>" class="btn btn-warning"><p id="<?php echo $row2['ID'];?>" type="button" style="justify-content: center;"> Delete</p></a>
                                                                </div>
                                                            </div>
                                                            <?php 
                                                            }
                                                            ?>  
                                                    </div>
                                                        <div style="justify-content: center; text-align: center;" class="mt-3 mb-3">
                                                            <div class="p-3">
                                                                <input type="file" class="form-control" id="validationCustom03" placeholder="Select Photo" name="files[]" multiple>        
                                                            </div>
                                                            <button type="submit" name="add_pic" type="button" style="justify-content: center;" class="btn btn-success" value="">Add Pic</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Medicne Information</h5>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					<div class="modal-body" id="mbody">
                        <form method="POST" enctype="multipart/form-data">
                            <div style="justify-content: center; text-align: center;" class="mt-3 mb-3">
                                <div class="p-3">
                                    <input type="file" class="form-control" id="" placeholder="Select Photo" name="file">
                                    <input name="PicID" id="picID" for="" hidden value="">
                                </div>
                                <button type="submit" name="cng_pic" id="edit_<?php echo $row2['ID'];?>" type="button" style="justify-content: center;" class="btn btn-success" value="">Change Pic</button>                  
                            </div>
                        </form>     
					</div>
				</div>
			</div>
		</div>

     <script>
        function chagnepic(event) {
    var btn = event.target;
    //const picID = document.getElementById('picID');
    //$('#p_id').val(btn.id);
    //$('#picID').text(btn.id);
    //alert ("this is test"+btn.id);
    //$('#Total_new_limit2').text(t_value);
    $('#picID').val(btn.id);
	$('#exampleModal2').modal('show');

}
     </script>   
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