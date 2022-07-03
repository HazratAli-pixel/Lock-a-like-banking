<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['img']==0)) {
    include_once('./includes/address.php');
    $_SESSION['U_id']=$_GET['id'];
    header('location:index2.php');  	
  } else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Lottery Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div style="background-color: rgb(224, 224, 235);" class="container pt-3">
    <div class="row">
    <?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql = "SELECT * FROM img_info LEFT JOIN image ON img_info.ID =image.Pair WHERE img_info.ID='$id'";
        $query=mysqli_query($con3,$sql);
        $row=mysqli_fetch_array($query);
    }                 
    ?>
        <div class="col-12">
            <h1 style="text-align: center;">Thailand Lottery Ticket</h1>
        </div>
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <p style="text-align: center;"><?php echo $row['Title'];?></p>
                </div>
                <div class="card-body">
                    <p style="text-align: center;"><?php echo $row['Description'];?></p>
                </div>
                <div class="card-footer">
                    <div class="">
                        <?php 
                        $sql2="SELECT * FROM image where Pair='$id'";
                        $query2=mysqli_query($con3,$sql2);
                            while($row2=mysqli_fetch_array($query2)){
                            ?> 
                                <div class="card mb-1">
                                    <div class="card-body d-flex justify-content-center " style="overflow-y: scroll;">
                                        <a style="margin: 20px;" class="<?php echo $id?>" href="admin-img/upload/<?php echo $row2['PicName'];?>"><img style="max-width: 600px;" src="admin-img/upload/<?php echo $row2['PicName'];?>" alt="<?php echo $row['PicName'];?>"></a>
                                    </div>
                                </div>
                            <?php 
                            }
                            ?>                        
                    </div>
                </div>
                <?php unset($_SESSION['img']);
unset($_SESSION['current_link']); ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php }?>