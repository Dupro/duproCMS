<?php include "includes/db.php"; ?>
<?php  include "admin/functions.php"; ?>
<?php include "includes/header.php"; ?>
<?php 

// phpinfo();
echo loggedInUserId();

if(userLikedThisPost(107)){
    echo "USER LIKED IT";
} else {
    echo "DID NOT LIKE IT";
}

?>