<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>

<?php 

// Setting Language Variables

if(isset($_GET['lang']) && !empty($_GET['lang'])){
     
    $_SESSION['lang'] = $_GET['lang'];
    
    if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
        
        echo "<script type='text/javascript'>location.reload(); </script>";
        
    }
}
    if(isset($_SESSION['lang'])){
        
        include "includes/languages/" . $_SESSION['lang']. ".php";
    } else {
        
        include "includes/languages/en.php";
    }
    


?>
   
   
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
 
    <!-- Page Content -->
    <div class="container">
    
    <form method="get" class="navbar-form navbar-right" action="" id="language_form">
        <div class="form-group">
            <select name="lang" class="form-control" onchange="changeLanguage()">
                <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en'){ echo "selected";} ?>>English</option>
                <option value="srb" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'srb'){ echo "selected";} ?>>Srpski</option>
            </select>
        </div>
        
    </form>
    
    
    <div id="RegistrationRow">
<section id="login">
    <div class="container">
      <?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $error = [
        
        'username'=> '',
        'email'=> '',
        'password'=> ''
        ];
        
    
    if(strlen($username) < 4){
        
        $error['username'] = 'Username needs to be longer than 4 characters.';
    }
    if($username == ''){
        
        $error['username'] = 'Username cannot be empty';
    }
    if(username_exists($username)){
        
        $error['username'] = 'Username already exist, choose another one.';
    }
    if($email == ''){
        
        $error['email'] = 'Email cannot be empty';
    }
    if(email_exists($email)){
        
        $error['email'] = 'Email already exist, <a href="index.php">Please login </a>';
    }
    if($password == ''){
        
        $error['password'] = 'Password cannot be empty';
    }
    if(strlen($password) < 4){
        
        $error['password'] = 'Password needs to be longer than 4 characters.';
    }

    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
        register_user($username, $email, $password);
        
        login_user($username, $password);
        
    }
    
}

?>  
        <div class="row">
            <div class="col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
                <div class="form-wrap text-center">
                <h1><?php echo _REGISTER; ?></h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
<!--
                       <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
-->
                       
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASWORD; ?>">
                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                        </div>
<!--                        <button class="btn btn-success btn-lg btn-block" name="submit" type="submit">Register</button>-->
                        <input type="submit" name="register" id="btn-login" class="btn btn-success btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

</div>
        <hr>
<script>
        
    function changeLanguage(){
        
        document.getElementById('language_form').submit();
    }
    
</script>


<?php include "includes/footer.php";?>
