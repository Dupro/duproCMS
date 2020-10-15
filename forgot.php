<?php 

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>


<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>

<?php

// Load Composer's autoloader
require 'vendor/autoload.php';

?>

<?php

if(!ifItIsMethod('get') && !isset($_GET['forgot'])){
    
    redirect('index');
}

if(ifItIsMethod('post')){
    
    if(isset($_POST['email'])){
        
        $email = $_POST['email'];
        
        $length = 50;
        
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        
        if(email_exists($email)){
            
            if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")) {
                    
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
                /******
                ****
                **** configure SMTP MAILER
                ***
                *******/
                
                $mail = new PHPMailer();
                
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = Config::SMTP_HOST;                    // Set the SMTP server to send through
            $mail->Username   = Config::SMTP_USER;                     // SMTP username
            $mail->Password   = Config::SMTP_PASSWORD;                               // SMTP password
            $mail->Port       = Config::SMTP_PORT;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->CharSet = 'UTF-8';

            $mail->isHTML(true);
            $mail->addAddress($email);
            $mail->setFrom('dupro28@gmail.com', 'Dupro Pro');
            $mail->Subject = 'This is a test email.';
            $mail->Body = '<p>Please click here to reset your password.</p>

            <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.' ">http://localhost/cms/reset.php?email='.$email.'&token='.$token.' </a>










                ';
                
                if($mail->send()){

                    $emailSent = true;
                } else {

                    echo "MAIL NOT SENT";
                }
                
            }
        }
        
    }
}





?>





<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                        
                        
                        <?php 
                            
                            if(!isset($emailSent)): ?>
                        


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                
                                <?php else: ?>
                                    <h2>Please check your email</h2>
                               <?php endif; ?>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

