        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="ion ion-ios-keypad"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="creat_ac.php">
                                <i class="ion ion-ios-keypad"></i>
                                <span class="nav-link-text">Create Account</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="ion ion-ios-keypad"></i>
                                <span class="nav-link-text">Secret Pin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-funds.php">
                                <i class="ion ion-ios-keypad"></i>
                                <span class="nav-link-text">Add Funds</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user-details.php">
                                <i class="ion ion-ios-keypad"></i>
                                <span class="nav-link-text">User Details</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="pricee.php">
                                <i class="ion ion-ios-keypad"></i>
                                <span class="nav-link-text">Price Plan</span>
                            </a>
                        </li>
                        
                   
                       <?php if(isset($_SESSION['Rule'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#cats_drp">
                                <i class="ion ion-ios-copy"></i>
                                <span class="nav-link-text">Admin Control</span>
                            </a>
                            <ul id="cats_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="modarator.php">Add Modarator</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="m_modarator.php">Manage Modarator</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="userdetails.php">Manage User</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="add-fundss.php">Add Funds</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" href="#">Add Bank</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" href="#">Manage Bank</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                      <?php }?>
                        </ul>
                 
                      
                      
                      
                  
                
                    <hr class="nav-separator">
            
                </div>
            </div>
        </nav>