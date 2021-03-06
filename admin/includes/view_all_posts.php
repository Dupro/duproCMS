<?php 

include("delete_modal.php");

if(isset($_POST['checkBoxArray'])){
    
    
    foreach($_POST['checkBoxArray'] as $postValueId){
        
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options){
            case 'published':
                
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";    
                
                $update_to_publish_status = mysqli_query($connection, $query);
                
                confirm($update_to_publish_status);
                
                break;
                
            case 'draft':
                
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";    
                
                $update_to_draft_status = mysqli_query($connection, $query);
                
                confirm($update_to_draft_status);
                
                break;
                
            case 'delete':
                
            $query = "DELETE FROM posts WHERE post_id = {$postValueId}";    
                
                $update_to_delete_status = mysqli_query($connection, $query);
                
                confirm($update_to_delete_status);
                
                break;
                
                
                
            case 'clone':
                
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);
                
                while ($row = mysqli_fetch_array($select_post_query)){
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
                
                $query = "INSERT INTO posts(post_category, post_title, post_author, post_date, post_user, post_status, post_image, post_tags, post_content) ";
                
                $query .= "VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_user}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                $copy_query = mysqli_query($connection, $query);
                if(!$copy_query){
                    die ("QUERY FAILED" . mysqli_error($connection));
                }
                
                break;
                
        }
        
    }
    
}


?>
  

  
  
  <form action="" method="POST">
   

   
   
   <table class="table table-bordered table-hover" >

        <div id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        </select>
        </div>

        <div class="col-xs-4">
        <input type="submit" class="btn btn-success" name="submit" value="Apply">
        <a href="./posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>

   
   
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th class='text-center'>Id</th>
            <th class='text-center'>Users</th>
            <th class='text-center'>Title</th>
            <th class='text-center'>Category</th>
            <th class='text-center'>Status</th>
            <th class='text-center'>Image</th>
            <th class='text-center'>Tags</th>
            <th class='text-center'>Comments</th>
            <th class='text-center'>Date</th>
            <th class='text-center'>View Post</th>
            <th class='text-center'>Edit</th>
            <th class='text-center'>Delete</th>
            <th class='text-center'>Post Views</th>
        </tr>
    </thead>
    <tbody>
                   
<?php
   // $query = "SELECT * FROM posts ORDER BY post_id DESC";
        
        /********************************** LEFT JOIN TABLES **********************************/
         $user = currentUser();
        
        $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category, posts.post_status, posts.post_image, ";
        $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
        $query .= "FROM posts ";
        $query .= "LEFT JOIN categories ON posts.post_category = categories.cat_id ";
        $query .= "WHERE posts.post_user = '$user' ";
        $query .= "ORDER BY posts.post_id DESC";
        // 
        //  OVO KAD DODAM NE RADI IZ NEKOG RAZLOGA puca mysqli_fetch_assoc parameter 1 to be mysqli_result boolean // given
        //$query .= "WHERE post.post_user = '$user'";
        
    $select_posts = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_posts)){
    $post_id  = $row ['post_id'];
    $post_user = $row ['post_user'];
    $post_author = $row ['post_author'];
    $post_title = $row ['post_title'];
    $post_category = $row ['post_category'];
    $post_status = $row ['post_status'];
    $post_image = $row ['post_image'];
    $post_tags = $row ['post_tags'];
    $post_comment_count = $row ['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];
    $category_id = $row['cat_id'];
    $category_title = $row['cat_title'];
        
        
    echo "<tr>";
        
    ?>
       
        <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
        
    <?php
        
    echo "<td>{$post_id}</td>";
        
        if(!empty($post_author)){
            echo "<td>{$post_author}</td>";
        } elseif (!empty($post_user)) {
            
            echo "<td>{$post_user}</td>";
        }
        
        
        
        
    echo "<td>{$post_title}</td>";
        
        
/*        $query = "SELECT * FROM categories WHERE cat_id='{$post_category}' ";
        $select_categories_id = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories_id)){
        $cat_id = $row ['cat_id']; 
        $cat_title = $row ['cat_title'];
        }*/
        
        
    echo "<td>{$category_title}</td>";
        
        
        
        
        
        
    echo "<td class='text-center'>{$post_status}</td>";
    echo "<td class='text-center'><a href='../post.php?p_id={$post_id}'><img width='150' src='../images/{$post_image}' alt='image'></td></a>";
    echo "<td class='text-center'>{$post_tags}</td>";
        
        
        
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_query = mysqli_query($connection, $query);
        
//          BUG        
//        $row = mysqli_fetch_array($send_comment_query);
//        $comment_id = $row['comment_id'];
        $count_comments = mysqli_num_rows($send_comment_query);
        
        
    echo "<td class='text-center'><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
        
        
        
        
        
        
        
        
        
        
    echo "<td class='text-center'>{$post_date}</td>";
    echo "<td class='text-center'><a class='btn btn-success' href='../post.php?p_id={$post_id}'>View Post</a></td>";  
    echo "<td class='text-center'><a class='btn btn-warning' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>"; 
        
//    echo "<td class='text-center'><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";   
        
        
        ?>
            <form method="post" action="">
                
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <?php 
                
                
                
                echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                
                ?>
            </form>
            
            
            
            
            
            
            
            
            
         <?php
        
        
        
  //  echo "<td class='text-center'><a rel='$post_id' class='btn btn-danger delete_link' href='javascript:void(0)' >Delete</a></td>";   
        
        
        
        
        
        
        
    echo "<td class='text-center'><a class='btn btn-info' href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
    echo "</tr>";        
        
    }

?>
                   
                    
                </tbody>
                
            </table>
            </form>
            
     <?php

if(isset($_POST['delete'])){
    $the_post_id = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    
    confirm($delete_query);
    
    header("Location: posts.php");
    exit;
}
if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =". mysqli_real_escape_string($connection, $_GET['reset']) ." ";
    $reset_query = mysqli_query($connection, $query);
    
    confirm($reset_query);
    
    header("Location: posts.php");
    exit;
}
          
        ?>
        
<script>

$(document).ready(function(){

    
    $(".delete_link").on('click', function(){
    
    var id = $(this).attr("rel");
        
    var delete_url = "posts.php?delete="+ id +" ";
    
    $(".modal_delete_link").attr("href", delete_url);
    
    $("#myModal").modal('show');
    
    });

});




</script> 

      
     