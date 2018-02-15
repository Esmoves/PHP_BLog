<?php 
try{
  require_once ('./include/connection.php');
  require_once ('./include/include_admin.php');
  require_once ('./include/include_blogs.php');

  if(isset($_SESSION['name']))  
     {  
     
      require_once ('./include/include_htmlheader_admin.php');
      
      if ( empty($_POST['submit']) || empty($_GET['cat']))
      {
          $user = $_SESSION['name'];
          echo '<h2>Welcome - '.$user.'</h2>';  
          // show titels of all blogs by user
          // include buttun to edit or delete specific blogs
          manageblogs($user);  

         // button to logout
          echo '<br /><br /><button><a href="logout.php">Logout</a></button>';    
      }

    }else{    // if not logged in go to login page
      header("location:index.php"); 
     }  
}
catch(PDOException $e)
{
  echo "error".$e->getMessage();
}
?>
