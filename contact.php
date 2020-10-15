<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>

   
   
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
 
    <!-- Page Content -->
    <div class="container">
    <div id="RegistrationRow">
<section id="login">
    <div class="container">
      <?php
        
        
//        
//        // the message
//$msg = "First line of text\nSecond line of text";
//
//// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);
//
//// send email
//mail("dupro28@gmail.com","My subject",$msg);
//        
        
        
        

if(isset($_POST['submit'])){
    
$to = "dupro28@gmail.com";
$subject = wordwrap($_POST['subject'], 70);
$body = $_POST['body'];
$header ="From: " .$_POST['email'];

    // send email
mail($to, $subject, $body, $header);
    }

?>  
        <div class="row">
            <div class="col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
                <div class="form-wrap">
                <h1 class="text-center">Contact Us</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
<!--
                      <?php // if ($message) { ?>
                       <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h5 class="text-center"> <?php // echo $message; ?></h5>
</div>
                      <?php // } ?>
-->
                       
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Subject</label>
                            <input type="email" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                        
                         <div class="form-group">
                            <textarea class="form-control" name="body" id="body" cols="50" rows="10" placeholder="Enter your message"></textarea>
                        </div>
<!--                        <button class="btn btn-success btn-lg btn-block" name="submit" type="submit">Register</button>-->
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

</div>
        <hr>



<?php include "includes/footer.php";?>
