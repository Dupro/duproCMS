<?php

if(isset($_POST['create_post'])){
    
    $post_title = $_POST['title'];
//    $post_author = $_POST['post_author'];
    $post_user = $_POST['post_user'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-Y');
    
    
    
    move_uploaded_file($post_image_tmp, "../images/$post_image" );
    
    
    
    $query = "INSERT INTO posts(post_category, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    
    $query .="VALUES ({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
    
    $create_post_query = mysqli_query($connection, $query);
    
    confirm($create_post_query);
    
    $the_post_id = mysqli_insert_id($connection);

            echo "<div class='alert alert-success' role='alert'>Post Created. <a href='../post.php?p_id=$the_post_id' class='alert-link'>View Post</a> | <a href='posts.php' class='alert-link'>Veiw More Posts</a></div>";
    
    
    
    
    
}







?>
   

   
   
   
   
   
   <form action="" method="post" enctype="multipart/form-data" >
    <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
    </div>
<div class="form-group">
   <label for="category">Category</label>
    <select name="post_category" id="post_category" class="form-control">
        <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
        
            confirm($select_categories);
        
            while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row ['cat_id']; 
            $cat_title = $row ['cat_title'];
            
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
            
            }
        ?>
    </select>
    </div>
    
    <div class="form-group">
   <label for="Users">Users</label>
    <select name="post_user" id="" class="form-control">
        <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
        
            confirm($select_users);
        
            while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row ['user_id']; 
            $username = $row ['username'];
            
            echo "<option value='{$username}'>{$username}</option>";
            
            }
        ?>
    </select>
    </div>
    
    
<!--
        <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author">
    </div>
-->
        <div class="form-group">
    <select name="post_status" id="">
        <option value="draft">Post Status</option>
        <option value="draft">Draft</option>
        <option value="published">Publish</option>
    </select>
    </div>
        <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
    </div>
        <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
    </div>
        <div class="form-group">
    <label for="post_content">Post Content</label>
            <textarea type="text" class="form-control" name="post_content" id="body" cols='30' rows='10'></textarea>
    </div>
        <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
    
</form>