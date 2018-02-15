<?php
    require_once('./include/connection.php');
    require_once('./include/include_admin.php');
    require_once('./include/include_blogs.php');
    require_once('./include/include_commenting.php');
    require_once('../include/include_reader.php');
    require_once('./include/include_htmlheader_admin.php');

try {
  if(isset($_SESSION["name"])) {  
     // check if a comment is deleted
      if(!empty($_GET['action']) ){
        if($_GET['action'] == 'delete' && !empty($_GET['comment'])){ 
          $comment_id= $_GET['comment'];
          deletecomment($comment_id);
        }
        if($_GET['action'] == 'close' && !empty($_GET['blog'])){ 
          $blog_id= $_GET['blog'];
          closeblog($blog_id);
        } 
        if($_GET['action'] == 'open' && !empty($_GET['blog'])){ 
          $blog_id= $_GET['blog'];
          openblog($blog_id);
        } 
      }
      else {
        $blog_id = $_GET['blog'];

        // get blog info
        $sql_blog = "SELECT closed FROM blogs WHERE id = $blog_id";
        $sth = $db->prepare($sql_blog);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $closed = $row['closed'];
        
        if($closed == false ){
          echo '<br /><br /><button style="width:500px;"><a href="blog.php?action=close&blog=' .$blog_id. '">Close this blog for commenting</a></button>';
        }else{
        echo '<br /><br /><button style="width:500px;"><a href="blog.php?action=open&blog=' .$blog_id. '">Open this blog for commenting</a></button>';
        }
        // show comments for blogger with delete option
        getcommentsfordelete($blog_id);

         // get blog by user_id
        getOneBlogFromDB($blog_id);
      }
  } else { 
      location('./index.php'); 
  }

}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }





?>






</div>
</body>
</html>