<table class="table table-bordered table-hover" >
    <thead>
        <tr>
            <th class='text-center'>Id</th>
            <th class='text-center'>Author</th>
            <th class='text-center'>Comment</th>
            <th class='text-center'>Email</th>
            <th class='text-center'>Status</th>
            <th class='text-center'>In Response to</th>
            <th class='text-center'>Date</th>
            <th class='text-center'>Approve</th>
            <th class='text-center'>Unapprove</th>
            <th class='text-center'>Delete</th>
        </tr>
    </thead>
    <tbody>
                   
<?php
    $query = "SELECT * FROM comments ";
    $select_comments = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_comments)){
    $comment_id  = $row ['comment_id'];
    $comment_post_id = $row ['comment_post_id'];
    $comment_author = $row ['comment_author'];
    $comment_content = $row ['comment_content'];
    $comment_email = $row ['comment_email'];
    $comment_status = $row ['comment_status'];
    $comment_date = $row ['comment_date'];
        
        
    echo "<tr>";
    echo "<td class='text-center'>{$comment_id}</td>";
    echo "<td class='text-center'>{$comment_author}</td>";
    echo "<td>{$comment_content}</td>";
        
//        
//        $query = "SELECT * FROM categories WHERE cat_id='{$post_category}' ";
//        $select_categories_id = mysqli_query($connection, $query);
//        while($row = mysqli_fetch_assoc($select_categories_id)){
//        $cat_id = $row ['cat_id']; 
//        $cat_title = $row ['cat_title'];
//        }
//        
//        
//    echo "<td>{$cat_title}</td>";
//        
//        
        
        
        
        
    echo "<td class='text-center'>{$comment_email}</td>";
    echo "<td class='text-center'>{$comment_status}</td>";
        
        
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        $select_post_id_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td class='text-center'><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            
        }
        
        
        
        
        
        
        

        
        
        
        
    echo "<td class='text-center'>{$comment_date}</td>";
    echo "<td class='text-center'><a class='btn btn-success' href='comments.php?approve=$comment_id'>Approve</a></td>"; 
    echo "<td class='text-center'><a class='btn btn-warning' href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";   
    echo "<td class='text-center'><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='comments.php?delete=$comment_id'>Delete</a></td>";   
    echo "</tr>";        
        
    }

?>
                   
                    
                </tbody>
                
            </table>
            
     <?php


if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    $approve_comment_query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $approve_comment_query);

    
    header("Location: comments.php");
}




if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];
    $unapprove_comment_query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection, $unapprove_comment_query);

    
    header("Location: comments.php");
}









if(isset($_GET['delete'])){
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($connection, $query);

    
    header("Location: comments.php");
    exit;
}
          
         
        
       
      
     ?>