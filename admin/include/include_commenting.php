<?php

// get the comments of the blog with option to to delete them
  function getcommentsfordelete($blog_id){
    global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
    echo "<table class='comments'>";
    echo "<tr><th colspan='2'>Comments</th></tr>";
    
    $sql="SELECT c.id AS comment_id, c.comment
    FROM comments c
    INNER JOIN blogs b 
    ON b.id = c.blog_id
    WHERE b.id= '$blog_id'
    AND c.deleted = 'false'";  
    foreach($db->query($sql) as $row) {
        echo "<tr><td>" .$row['comment']. "</td>";
        echo "<td><a href='blog.php?action=delete&blog=".$blog_id. "&comment=" .$row['comment_id']. "'>";
        echo "delete</a></td></tr>"; 
      }
      echo "</table>";
      unset($row);
  } 

// delete the comment
  function deletecomment($comment_id){
    global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
    $sql = "UPDATE comments SET deleted=true WHERE id = '$comment_id'";
    $stmt = $db->prepare($sql);
    if ($stmt->execute()){        
          echo "<script>alert('Comment deleted!')</script>";     
    }
 }

 // close a blog for commenting
  function closeblog($blog_id){
    global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
    $sql = "UPDATE blogs SET closed=true WHERE id = $blog_id";
    $stmt = $db->prepare($sql);
    if ($stmt->execute()){        
          echo "<script>alert('Blog is closed for commenting!')</script>";     
    }
 }

 // open a blog for commenting
  function openblog($blog_id){
    global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
    $sql = "UPDATE blogs SET closed=false WHERE id = $blog_id";
    $stmt = $db->prepare($sql);
    if ($stmt->execute()){        
          echo "<script>alert('Blog is open for commenting!')</script>";     
    }
 }


?>