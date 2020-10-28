<?php include "includes/db.php"; ?>
<?php include "admin/functions.php"; ?>
<?php include "includes/header.php"; ?>
                <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

   
   <?php

if(isset($_POST['liked'])){
    
    // 1 - Fetching the right post
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    
    $query = "SELECT * FROM posts WHERE post_id= $post_id";
    $postResult = mysqli_query($connection, $query);    
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];
    
    if(mysqli_num_rows($postResult) >= 1) {
        
        echo $post['post_id'];
    }
    
    
    // 2 - update post with likes
    
    mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id= $post_id");
    
    // 3 - create likes for post
    
    mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    exit();

}


if(isset($_POST['unliked'])){

    echo 'UNLIKED';
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
//
//    // 1 - Fetching The right post
//    
    $query = "SELECT * FROM posts WHERE post_id= $post_id";
    $postResult = mysqli_query($connection, $query);    
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];
  
    //2 = DELETE Likes
    
    mysqli_query($connection, "DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");

    
    //3 = UPDATE With Decrementing Likes
    
    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id= $post_id");
    exit();
    
}

?>
   
   
   
   
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

               <?php
                
                if(isset($_GET['p_id'])){
                    
                    $the_post_id = $_GET['p_id'];
                    
                     $update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");

        mysqli_stmt_bind_param($update_statement, "i", $the_post_id);

        mysqli_stmt_execute($update_statement);

        // mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
    


     if(!$update_statement) {

        die("query failed" );
    }


    if(isset($_SESSION['username']) && is_admin($_SESSION['username']) ) {


         $stmt1 = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content, post_views_count FROM posts WHERE post_id = ?");


    } else {
        $stmt2 = mysqli_prepare($connection , "SELECT post_title, post_author, post_date, post_image, post_content, post_views_count FROM posts WHERE post_id = ? AND post_status = ? ");

        $published = 'published';



    }



    if(isset($stmt1)){

        mysqli_stmt_bind_param($stmt1, "i", $the_post_id);

        mysqli_stmt_execute($stmt1);

        mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_image, $post_content, $post_views_count);

      $stmt = $stmt1;


    }else {


        mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);

        mysqli_stmt_execute($stmt2);

        mysqli_stmt_bind_result($stmt2, $post_title, $post_author, $post_date, $post_image, $post_content, $post_views_count);

     $stmt = $stmt2;

    }




    while(mysqli_stmt_fetch($stmt)) {
//                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
//                    $send_query = mysqli_query($connection, $view_query); 
//                    
//                    if(!$send_query){
//                        die("QUERY FAILED" );
//                    }
//                    
//                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
//                        
//                        $query = "SELECT * FROM posts WHERE post_id= $the_post_id";
//                        
//                    } else {
//                        
//                        $query = "SELECT * FROM posts WHERE post_id= $the_post_id AND post_status = 'published'";
//                        
//                    }
//                    
//                
//                $select_all_posts_query = mysqli_query($connection, $query);
//                    
//                     if(mysqli_num_rows($select_all_posts_query) <1){
//                        
//                        echo "<h1 class='text-center'> NO POSTS AVAILABLE</h1>"; 
//                    } else{
//                    
//                    
//                    
//                    
//                    
//                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
//                        $post_title = $row ['post_title'];
//                        $post_author = $row ['post_author'];
//                        $post_date = $row ['post_date'];
//                        $post_image = $row ['post_image'];
//                        $post_content = $row ['post_content'];
//                        $post_views_count = $row ['post_views_count'];
                        ?>
                        
                        <h1 class="page-header">
                    Posts
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?><span class="navbar-text navbar-right"> Post Views: <?php echo $post_views_count; ?></span></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <?php         // FREEING RESULT
mysqli_stmt_free_result ( $stmt )
      //  mysqli_stmt_free_result($stmt); ?>
                
                       

           <?php

                if(isLoggedIn()){ ?>


                    <div class="row">
                        <p class="pull-right"><a
                                class="<?php echo userLikedThisPost($the_post_id) ? 'unlike' : 'like'; ?>"
                                href=""><span class="<?php echo userLikedThisPost($the_post_id) ? 'glyphicon glyphicon-thumbs-down' : 'glyphicon glyphicon-thumbs-up'; ?>"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo userLikedThisPost($the_post_id) ? ' I liked this before' : 'Want to like it?'; ?>"



                                ></span>
                                <?php echo userLikedThisPost($the_post_id) ? ' Unlike' : ' Like'; ?>




                            </a></p>
                    </div>


              <?php  } else { ?>

                    <div class="row">
                        <p class="pull-right login-to-post">You need to <a href="/cms/login.php">Login</a> to like </p>
                    </div>


                <?php }


            ?>



                <div class="row">
                    <p class="pull-right likes">Like: <?php getPostlikes($the_post_id); ?></p>
                </div>
                        <div class="clearfix"></div>
                        
                        
            <?php 
                    
                    
                    
                    } 
                
                
                
                
                
                
                
                
                
                
                ?>
               
               
               
                <!-- Blog Comments -->

               
               <?php 
                
               if(isset($_POST['create_comment'])) {
                   
                   
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                   
                   if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";

                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                           $create_comment_query = mysqli_query($connection, $query);

                           if(!$create_comment_query){
                               die('QUERY FAILED' . mysqli_error($connection));
                           }
                       
                       
//                           $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
//                           $query .= "WHERE post_id= $the_post_id ";
//
//                           $update_comment_count = mysqli_query($connection,$query);
                   } else {
                       
                       // echo "<script>alert('Fields cannot be empty!')</script>";
                       echo "<h4 class='alert alert-danger'>Please fill in the required fields!</h4>";
                       
                   }
   
               }
                

        
                
                ?>
               
               
               
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    
                    
                    
                    <form role="form" action="" method="post">
                        <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="Your Email">Your Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                        <label for="Your Comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3" ></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary" id="LeaveComment">Submit</button>
                    </form>                
                </div>

                <hr>

                <!-- Posted Comments -->

               
               <?php 
                
                $query = "SELECT * FROM comments WHERE comment_post_id={$the_post_id} ";
                $query .= "AND comment_status= 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);
                if (!$select_comment_query) {
                    
                    die('Query Failed' . mysqli_error($connection));
                    
                }
                while ($row = mysqli_fetch_array($select_comment_query)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
?>
                  
                                  <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php 
                    echo $comment_content;
                    ?>
                    </div>
                </div>
                  
                  
                  
                   <?php  

                    }  } else {
                        header("Location: index.php");



                    }?>
               
               
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
       <?php include "includes/footer.php"; ?>
       
      
     
    
   
  
 <script>
        $(document).ready(function(){
            
        //   $("[data-toggle='tooltip']").tooltip();
            var post_id = <?php echo $the_post_id; ?>
                
                var user_id = <?php echo loggedInUserId(); ?>
                
            // LIKEING
            
            $('.like').click(function(){
                $.ajax({
                    url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            });
               // UNLIKING
            
             $('.unlike').click(function(){
                $.ajax({
                    url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            });
            
            
        });
     
  
     
           
        
        
        </script>