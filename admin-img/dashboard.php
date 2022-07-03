<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin']==0)) {
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
        $reference = $_SESSION['admin'];
        $query=mysqli_query($con,"SELECT * FROM img_info where Reference='$reference' ");

        ?>

        <div class="col-lg-12 col-md-12">
        <div class="card text-center">
            <div class="card-body table-wrap">
                <table id="datable_1" style="overflow-x: scroll;" style="text-align: left;" class="table table-hover w-100 display pb-30">
                    <thead class="">
                        <tr>
                            <th>SL</th>
                            <th>Picture</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>PIN</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                            <th>Button</th>
                        </tr>
                    </thead>
                    <tbody style="overflow: scroll;">
                    <?php
                    $cnt = 1;
                    while($row=mysqli_fetch_array($query))
                        {   
                            ?> 
                            <tr>
                            <td><?php echo $cnt;?></td>
                            <td>
                            <?php
                            $id = $row['ID'];
                            //$rno=mt_rand(10000,99999); 
                            $query2=mysqli_query($con,"SELECT * FROM image where Pair='$id' ");
                            while($row2=mysqli_fetch_array($query2)){
                                ?> 
                                <img height="50px" width="70px" src="../admin-img/upload/<?php echo $row2['PicName'];?>" alt="<?php echo $row['PicName'];?>">
                               <?php 
                            }?>
                            </td>
                            <td ><?php echo $row['Title'];?></td>
                            <!-- <td id="limit_<?php echo $row['ID'];?>"><?php echo $row['Description'];?></td> -->
                            <td id="limit_<?php echo $row['ID'];?>">http://thailandcitybank.com/ticket.php?id=<?php echo $id;?></td>
                           <td> <?php echo $row['Pin'];?></td>

                            <!-- <td><?php 
                            if($row['Status']==0){
                                ?>
                                <a href="m_modarator.php?close=<?php echo base64_encode($row['ID'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="want to close?"> <button type="button" class="btn btn-success">Active</button></a>
                                <?php
                            }
                            else { ?>
                                <a href="m_modarator.php?active=<?php echo base64_encode($row['ID'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="want to active?"><button type="button" class="btn btn-warning">Close</button></a>
                               <?php } ?>
                            </td> -->
                            <td>
                            <!-- <a href="m_modarator.php?catid=<?php echo base64_encode($row['PhoneNumber'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i></a> -->
                            <!-- <label style="color: blue;" class="mr-25" data-toggle="tooltip" data-original-title="Edit admin limit"> <i id="<?php echo $row['PhoneNumber'];?>" onclick="add_limit(event)" class="icon-pencil"></i></label> -->
                            <a href="ticket.php?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="edit"> <i class="icon-pencil txt-danger"></i> </a>
                            <a href="m_modarator.php?del=<?php echo base64_encode($row['PhoneNumber'].$rno);?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="icon-trash txt-danger"></i> </a>
                            </td>
                            <td>
                                <button id="<?php echo $row['ID'];?>" onclick="copy_link(event)" class="btn btn-primary">link</button>
                                <input hidden type="text" id="link_<?php echo $row['ID'];?>" value="http://thailandcitybank.com/ticket.php?id=<?php echo $id;?>">
                            
                            </td>
                            </tr>
                            <?php 
                            $cnt++;
                        } 
                        ?>
                    </tbody>
                </table>
            
            </div>
           
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
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
	<script src="vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="dist/js/vectormap-data.js"></script>
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    <script src="vendors/apexcharts/dist/apexcharts.min.js"></script>
	<script src="dist/js/irregular-data-series.js"></script>
    <script src="dist/js/init.js"></script>
    <script src="dist/index.js"></script>
	
</body>

</html>
<?php } ?>