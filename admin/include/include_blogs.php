<?php

// show all blogs with options to edit or delete blogs//
// show if blog has comments //
function manageblogs($user){
  global $db;
  echo "<table class='excerp'>";
  echo "<th colspan='4'>Manage your blogs</th>";
  $sql = "
  SELECT *, b.id AS bid 
  FROM blogs b
  INNER JOIN bloggers a 
  ON b.user_id = a.id 
  WHERE a.username = '$user'
  ORDER BY b.id DESC";
  $db->query($sql);
  foreach($db->query($sql) as $row) {
        $blog_id= $row['bid'];
        $link = "<a href='../blog.php?blog=" .$blog_id. "''>";
        echo "<tr><td>" . $link . $row['titel']. "</a></td>";
        echo "<td><a href='./editblog.php?action=edit&user=" .$row['user_id']. "&blog=" .$blog_id. "'>edit</a></td>";
        echo "<td><a href='./editblog.php?action=delete&user=" .$row['user_id']. "&blog=" .$blog_id. "'>delete</a></td>";
        echo "<td><a href='./comments.php?blog=" .$blog_id. "'>Comments</a></td>";
        echo "</tr>";
        }
        echo "</table>";
      }

// Edit a blog //
function editmyblog($blog_id){
    global $db;
    $titel= $_POST['titel'];
    $tekst= $_POST['tekst'];
    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size']; 
    $excerp= $_POST['excerp'];

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== added for upload purposes
  
    $sql = "UPDATE blogs 
    SET titel='$titel', tekst='$tekst', excerp= '$excerp'
    WHERE id = '$blog_id'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    echo $stmt->rowCount() . " records UPDATED successfully";
    }

// Delete a blog //
function deleteblog($blog_id){
  if (confirm("Weet u zeker dat u deze blog wilt verwijderen?"))
    {
      global $db;
      $sql = "DELETE FROM blogs WHERE id = '$blog_id'";
      $stmt = $db->prepare($sql);
      $stmt->execute();
    }
}


function upload(){
  global $db;
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== added for upload purposes
  $titel= $_POST['titel'];
  $tekst= $_POST['tekst'];
  $excerp= $_POST['excerp'];

  // get user_id
  $useremail = $_SESSION['email'];
  $sql_user = "SELECT * FROM bloggers WHERE email = '$useremail'";
  foreach($db->query($sql_user) as $user){
    $user_id = $user['id'];
  }  

  // if illustration is given, upload img   
  if(!empty($_FILES['image']['name'])){
    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size']; 

    // handle the header img
    $upload_dir = '../user_images/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    // rename uploading image
    $userpic = rand(1000,1000000).".".$imgExt;
    // allow valid image file formats
    if(in_array($imgExt, $valid_extensions)){   
      // Check file size '5MB'
      if($imgSize < 5000000)    {
        move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
      else{
       echo "<script type= 'text/javascript'>alert('Sorry, your file is too large.');</script>";
      }
     }
     else{
      echo "<script type= 'text/javascript'>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>"; 
     }
    }
    else $userpic = "";
   
    // start the actual upload section
    $sql = "INSERT INTO blogs ( user_id, titel, tekst, id_hoofdimg, excerp, category ) VALUES ( :user_id, :titel, :tekst, :id_hoofdimg, :excerp, :category)";
    $query = $db->prepare( $sql );
    if( $query->execute( array(':user_id'=>$user_id, ':titel'=>$titel, ':tekst'=>$tekst, ':id_hoofdimg'=>$userpic, ':excerp'=>$excerp, 'category'=>'' ) ) )
      {   
        $last_id = $db->lastInsertId();
        foreach($_POST['category'] as $value)
         {
          $sql2 = "INSERT INTO connectcatwithblog (blog_id, categorie_id) VALUES ($last_id, '$value')";
          $sth = $db->prepare($sql2);
          $sth->execute();
         }

        echo "<script type= 'text/javascript'>alert('New Blog Inserted Successfully');</script>";
        header('location: manageblogs.php');
    }
    else{
      echo "<script type= 'text/javascript'>alert('Blog not successfully Inserted.');</script>";
     }
  }



?>