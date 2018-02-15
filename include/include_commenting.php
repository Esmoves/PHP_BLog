<?php
try{
  require_once ('./include/connection.php');

  if(!empty($_POST['submitcomment'])){

    $comment = htmlspecialchars($_POST['comment']);
    $blog_id = $_POST['blog_id'];
    $reader_name = $_SESSION['reader_name'];
    $sql = "SELECT id FROM readers WHERE name = '$reader_name'";
    $sth = $db->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $reader_id = $row['id'];

    $sql = "INSERT INTO comments ( blog_id, comment, deleted, reader_id ) VALUES ( :blog_id, :comment, :deleted, :reader_id)";
    $query = $db->prepare( $sql );
    $query->execute( array( ':blog_id'=>$blog_id, ':comment'=>$comment, ':deleted'=>'0', ':reader_id'=>$reader_id   )); 

    header('location:blog.php?blog='.$blog_id.'');
  
}
elseif(!empty($_SESSION['reader_name'])) {
    $blog_id = $_GET['blog'];
    // show the comment form 
    echo "<br />";
    echo '<form action="blog.php" method="post" name="comment" class="inputform">';
    echo '<label for="comment">Send us your comment</label><br>';
    echo '<input type="hidden" name="blog_id" value="' .$blog_id. '" />';
    echo '<textarea class="excerp" type="text" name="comment"></textarea><br />';
    echo '<input type="submit" name="submitcomment" value="send" />'; 
  } 

}catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

?>