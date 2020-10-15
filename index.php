<?php include "includes/db.php"; ?>
<?php include "admin/functions.php"; ?>
<?php include "includes/header.php"; ?>
                <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

   
   
   
   <?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'eu',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'e16910858e16f97e2336',
    'f6469fb0303b82523782',
    '1051784',
    $options
  );

  $data['message'] = 'User Subascribed';
  $pusher->trigger('channel-1', 'event-1', $data);
?>
   
   
   
   
   
   
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              
               <?php
                $per_page = 5;
                
                if(isset($_GET['page'])){
                    
                    $page =$_GET['page'];
                } else {
                    
                    $page = "";
                }
                
                if($page == "" || $page == 1){
                    
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }
                
                
                
                
                

                

                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){

                        $post_query_count = "SELECT * FROM posts ";

                    } else {

                        $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' ";

                    }
            
                
                // PAGINATION SYSTEM
                
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);
                
                if($count <1){
                    
                    echo "<h1 class='text-center'> NO POSTS AVAILABLE</h1>";
                    
                } else {
                
                
                $count = ceil($count / $per_page);
                
                // END OF PAGINATION SYSTEM
                
                
                $query = "$post_query_count LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row ['post_id'];
                        $post_title = $row ['post_title'];
                        $post_author = $row ['post_user'];
                        $post_date = $row ['post_date'];
                        $post_image = $row ['post_image'];
                        $post_content = substr($row ['post_content'],0,200);
                        $post_status = $row ['post_status'];
                        $post_views_count = $row['post_views_count'];
                        
                        
                            
                        ?>
                        
                        <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> <span class="navbar-text navbar-right"> Post Views: <?php echo $post_views_count; ?></span></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>    
                        
            <?php } 

                }?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <!--PAGINATION-->
        
        <ul class="pager">
            <?php 
            
            for($i = 1; $i <= $count; $i++){
                
                if($i == $page){
                    
                    echo " <li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                    
                } else {
                
                echo " <li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
            
            ?>
        <!--PAGINATION END-->
            
            
        </ul>
        
        
        
        
        
       <?php include "includes/footer.php"; ?>