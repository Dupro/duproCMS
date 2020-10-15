<?php

if(isset($_GET['edit_user'])){
    
    $the_user_id = $_GET['edit_user'];
    
    $query = "SELECT * FROM users WHERE user_id= $the_user_id ";
    $select_users_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users_query)){
        $user_id  = $row ['user_id'];
        $username = $row ['username'];
        $db_user_password = $row ['user_password'];
        $user_firstname = $row ['user_firstname'];
        $user_lastname = $row ['user_lastname'];
        $user_email = $row ['user_email'];
        $user_image = $row ['user_image'];
        $user_role = $row ['user_role'];
        
        }
    
    






if(isset($_POST['edit_user'])){
    

    
    // $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    
/*    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];*/
    
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//    $post_date = date('d-m-Y');
    
    
    
//    move_uploaded_file($post_image_tmp, "../images/$post_image" );
    
//    $query = "SELECT randSalt FROM users";
//    $select_randsalt_query = mysqli_query($connection, $query);
//    if(!$select_randsalt_query){
//        die("Query Failed" . mysqli_error($connection));
//    }

//    $row = mysqli_fetch_array($select_randsalt_query);
//    $salt = $row['randSalt'];
//    $hashed_password = crypt($user_password, $salt);
    
    if(!empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $query_user_pass = mysqli_query($connection, $query_password);
        
            confirm($query_user_pass);
        
        $row = mysqli_fetch_array($query_user_pass);
        $db_user_pass = $row['user_password'];
        
    
    if ($db_user_password != $user_password) {
        
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array ('cost' => 12));
    } else {
        $hashed_password = $user_password;
        
    }
        $query = "UPDATE users SET ";
        $query .= "user_id = '{$user_id}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = {$the_user_id} ";

            $query_update_user = mysqli_query($connection, $query);
    
            if (!$query_update_user){
                die("QUERY FAILED" . mysqli_error($connection));
            }
        
            echo "<div class='alert alert-success' role='alert'>User Updated. | <a href='users.php' class='alert-link'>View Users</a></div>";        
        
        
    }
    
    
        }
    
        

    

    
    
    
}





 else {
    
    header("Location: index.php");
    
}

?>
   

   
   
   
   
   
   <form action="" method="post" enctype="multipart/form-data" >
    <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
        <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    
    
    
    
<div class="form-group">
    <select name="user_role" id="">
       <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
       <?php
       if($user_role == 'admin'){
       echo "<option value='subscriber'>subscriber</option>";
       } else {
        echo "<option value='admin'>admin</option>";
           
       }
        ?>       
        
    </select>
    </div>
        
<!--        <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
    </div>-->
       
       
       
        <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>
        <div class="form-group">
    <label for="user_email">Email</label>
            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
        <div class="form-group">
    <label for="user_password">Password</label>
            <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>
        <div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_user" value="EDIT User">
    </div>
    
</form>