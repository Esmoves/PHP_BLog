<?php 
try{
  require_once ('./include/connection.php');
  require_once ('./include/include_admin.php');
  require_once ('./include/include_blogs.php');

  if(isset($_SESSION['email']))  
     {  
     
      require_once ('./include/include_htmlheader_admin.php');
      
      if ( empty($_POST['submit']) || empty($_GET['cat']))
      {
          $user = $_SESSION['name'];
          $useremail = $_SESSION['email'];
          echo '<h2>Welcome - '.$user.'</h2>';  
          // show titels of all blogs by user
          // include buttun to edit or delete specific blogs
          manageblogs($useremail);  

         // button to logout
          echo '<br /><br /><button><a href="logout.php">Logout</a></button>';    
      }

    }else{    // if not logged in go to login page
      // header("location:index.php"); 
      echo $_SESSION['email'];
     }  
}
catch(PDOException $e)
{
  echo "error".$e->getMessage();
}
?>
