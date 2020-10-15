<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>
               
                <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

               <?php
                
                if(isset($_GET['category'])){
                    
                    $post_category = $_GET['category'];
                    
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    
                        if(isset($_SESSION['username']) && is_admin($_SESSION['username'])){

                            $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category = ?");
                            
                            
                            
                            

                        } else {

                             $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category = ? and post_status = ? ");

                            $published = 'published';
                            
                            
                        }
                    
                    if(isset($stmt1)){
                        
                        /****************************** IF THE FORMAT IS Integer = put 'i' *****************************/
                        /****************************** IF THE FORMAT IS String = put 'is' *****************************/
                        
                        mysqli_stmt_bind_param($stmt1, "i", $post_category);
                        
                        mysqli_stmt_execute($stmt1);
                        
                        mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);
                        
                        $stmt = $stmt1;
                        
                        
                    } else {
                        
                         mysqli_stmt_bind_param($stmt2, "is", $post_category, $published);
                        
                        mysqli_stmt_execute($stmt2);
                        
                        mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

                        $stmt = $stmt2;
                    }
                
                
//                $select_all_posts_query = mysqli_query($connection, $query);
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) === 0){
                        
                        echo "<h1 class='text-center'> NO POSTS IN THIS CATEGORY</h1>"; 
                    }                        
                    
                    
                    while(mysqli_stmt_fetch($stmt)):
    /*                    $post_category = $row['post_category'];
                        $post_id = $row ['post_id'];
                        $post_title = $row ['post_title'];
                        $post_author = $row ['post_author'];
                        $post_date = $row ['post_date'];
                        $post_image = $row ['post_image'];
                        $post_content = substr($row ['post_content'],0,200);*/
                        
                        ?>
                        
                        <h1 class="page-header">

                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>    
                        
            <?php endwhile; mysqli_stmt_close($stmt);} else {
                    
                    header("Location: index.php");
                    
                }?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
       <?php include "includes/footer.php"; ?>