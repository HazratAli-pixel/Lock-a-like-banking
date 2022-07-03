<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['img']!=0)) {
    header('location:ticket.php?id='.$_SESSION['img']);
    } 
    else{
if(isset($_POST['submit']))
  {
    $pin = $_POST['pin'];
    $id = $_SESSION['U_id'];
    $status = 0;
    $query=mysqli_query($con3,"select * from img_info where ID='$id' && Pin='$pin' && Status='$status'");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
        $_SESSION['img']=$ret['ID'];
        if(strlen($_SESSION['current_link'])==0){
            header('location:ticket.php?id='.$_SESSION['img']);
        }
        else{
            header("location:".$_SESSION['current_link']);
        }
    }
    else{
        echo "<script>window.location.href='index2.php'</script>";
        echo "<script>alert('Invalid details. Please try again.');</script>";   
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Lottery Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .center {
            margin: auto;
            width: 100%;
            border: 3px solid green;
            padding: 10px;
        }
    </style>
</head>

  
<body>
<div style="background-color: rgb(224, 224, 235);" class="container center">
    <div class="row">
        <div class="col-12">
            <h1 style="text-align: center;">Thailand Lottery Ticket</h1>
        </div>
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <p style="text-align: center;" class="mt-1">Please Enter your pin</p>
                </div>
                <div class="card-body">
                    <form method="POST" style="text-align: center;">
                        <h3 >PIN</h3>
                        <input name="pin" type="text" required>
                        <hr>
                        <button style="font-size: 20px;" type="submit" name="submit" class="btn btn-success">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<?php }?>