     <nav class="navbar navbar-expand-xl fixed-top hk-navbar" style="background-color: rgb(252, 3, 127)">
            <a id="navbar_toggle_btn" style="color: rgb(255, 255, 255);" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><i class="ion ion-ios-menu"></i></a>
            <a style="color: rgb(255, 255, 255);" class="navbar-brand" href="dashboard.php">Central Bank of thailand
            </a>
            <ul class="navbar-nav hk-navbar-content">

                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                            <?php 
                                //Getting admin name
                                $adminid=$_SESSION['aid'];
                                $query=mysqli_query($con,"select * from tbladmin where MobileNumber='$adminid'");
                                $row=mysqli_fetch_array($query);
                                ?>
                                <div class="avatar">
                                    <img src="dist/img/<?php echo $row['photo'];?>" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>                          
                                <div class="media-body">
                                    <span style="color: rgb(255, 255, 255);"><?php echo $row['AdminName'];?><i class="zmdi zmdi-chevron-down"></i></span>
                                </div>
                            </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="profile.php"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                        <a class="dropdown-item" href="change-password.php"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                        <div class="dropdown-divider"></div>
                        <div class="sub-dropdown-menu show-on-hover">
                            <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                      
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>