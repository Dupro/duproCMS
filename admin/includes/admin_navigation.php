        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              <!-- <li><a href="">Users Online: <?php // echo users_online() ?></a></li>-->
              
               <li><a href="">Users Online: <span class="usersonline"><?php users_online(); ?></span></a></li>
               <li><a href="../index.php">HOME Site</a></li>
                
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                    
                    <?php 
                        if(isset($_SESSION['username'])){
                        echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; 
                        }
                        ?> 
                    
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
<?php
                        $dashboard_class = "";
                        
                        $posts_class = "";
                        
                        $categories_class = "";
            
                        $comments_class = "";
                        
                        $users_class = "";
                        
                        $profile_class = "";
                        
                        $pageName = basename($_SERVER['PHP_SELF']);
                        
                        $dashboard = 'index.php';
                        
                        $posts = 'posts.php';
                        
                        $categories = 'categories.php';
            
                        $comments = 'comments.php';
            
                        $users = 'users.php';
                        
                        $profile = 'profile.php';
                            
                        if($pageName == $dashboard) {
                            
                            $dashboard_class = "active";
                            
                        } else if ($pageName == $posts){
                            
                            $posts_class = "active";
                            if ($post_class = "active"){
                                
                                $post_dropdown_collapse = "collapse-in";                            
                            } 
                            
                        } else if ($pageName == $categories){
                            
                            $categories_class = "active";
                        }
                        else if ($pageName == $comments){

                            $comments_class = "active";
                        }
                        else if ($pageName == $users){

                            $users_class = "active";
                        }
                        else if ($pageName == $profile){

                            $profile_class = "active";
                        }

            
            
            ?>
            
            
            
            
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php echo $dashboard_class; ?>">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo $posts_class; ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li class="<?php echo $posts_class; ?>">
                                <a href="./posts.php">View all Posts</a>
                            </li>
                            <li>
                                <a href="./posts.php?source=add_post">Add new post</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $categories_class; ?>">
                        <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>

                    <li class="<?php echo $comments_class; ?>">
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    <li class="<?php echo $users_class; ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                            <li>
                                <a href="./users.php?source=add_user">Add user</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $profile_class; ?>">
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>