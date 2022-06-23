<?php
session_start();
//error_reporting(0);
include('includes/config.php');
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Search Job</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
    
	<!-- HK Wrapper -->
	<div class="hk-wrapper">
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Search By Date</h4>
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
                    <label for="validationCustom03">Select Date</label>
                    <input type="date" class="form-control" id="validationCustom03" name="deadline" required>
                    <div class="invalid-feedback">Please provide a valid date.</div>
                    </div>
                    </div>

                                                    
                    <button class="btn btn-primary" type="submit" name="search">search</button>
                    </form>
                    </div>
                    </div>
                    </section>
                    <!--code for search result -->
                    <?php if(isset($_POST['search'])){?>
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Job Title</th>
                                                    <th>link</th>
                                                    <th>Short link</th>
                                                    <th>Deadline</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $deadline=$_POST['deadline'];
                                            $query=mysqli_query($con,"select * from job_info where deadline like '%$deadline%'");
                                            $cnt=1;
                                            while($row=mysqli_fetch_array($query))
                                            {    
                                            ?>
                                            <form method="post" action="search-product.php?action=add&pid=<?php echo $row["id"]; ?>">                                                  
                                            <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td><a target="_blank" href="<?php echo $row['link'];?>">Job link</a></td>
                                            <td><?php echo $row['url'];?></td>
                                            <td><?php echo $row['deadline'];?></td>
                                            <td>
                                            
                                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo $row['link'];?>&layout=button&size=large&width=77&height=28&appId" width="77" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                            </td>
                                            </tr>
                                            </form>
                                            <?php 
                                            $cnt++;
                                            } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php } ?> 
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
    <style type="text/css">
        #btnEmpty {
    background-color: #ffffff;
    border: #d00000 1px solid;
    padding: 5px 10px;
    color: #d00000;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    margin: 10px 0px;


    </style>

</body>
</html>
<?php } ?>