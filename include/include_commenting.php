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
  if(isset($_POST['register_reader'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $insert = $db->prepare("INSERT INTO readers ( name, email, password )
      VALUES(:name, :email, :password) ");
    $insert->bindParam(':name',$name);
    $insert->bindParam(':email',$email);
    $insert->bindParam(':password',$pass);
    $insert->execute();

    $_SESSION['reader_name']=$name;
    echo "<script>alert('Registration succesful. You are now logged in')</script>";
    echo "<script>alert('".$_SESSION['reader_name'].")</script>";
  }
  elseif(isset($_POST['signin_reader'])){
     $name = $_POST['name'];
     $pass = $_POST['pass'];
     $select = $db->prepare("SELECT * FROM readers WHERE name='$name' AND password='$pass'");
     $select->setFetchMode(PDO::FETCH_ASSOC);
     $select->execute();
     $data=$select->fetch();
     if($data['name']!=$name AND $data['password']!=$pass)
     {
        echo "<script>alert(invalid username or password')</script>";
     }
     elseif($data['name']==$name AND $data['password']==$pass)
     {
      $_SESSION['reader_name']=$data['name'];
      echo "<script>alert('login succesful')</script>";
     }
  }
  elseif (empty($_SESSION['reader_name'])) {
    // if not logged in, show inlog / register form
    ?>  
    <h3 style="margin-left: 90px; color: black; font-size: 1.2em;">Login to leave a comment</h3>
    <form method="post" id="register_reader" class="loginreader">
      <h3>Register</h3>
      <input type="text" name="name" placeholder="username"><br><br>
      <input type="text" name="email" placeholder="example@example.com"><br><br>
      <input type="password" name="pass" placeholder="**********"><br><br>
      <input type="submit" name="register_reader" value="register">
    </form>

    <form method="post" id="login_reader" class="loginreader">
      <h3>Login</h3>
      <input type="text" name="name" placeholder="username"><br><br>
      <input type="password" name="pass" placeholder="**********"><br><br>
      <input type="submit" name="signin_reader" value="sign in">
    </form>

    <?php
  }
elseif(!empty($_SESSION['reader_name'])) {
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