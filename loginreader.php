<?php
try{
  require_once ('./include/connection.php');
  require_once ('./include/include_html.php');
  require_once ('./include/include_menu.php');

  if(isset($_POST['register_reader'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    // check if the username already excists
    $checkname = $db->prepare("SELECT name FROM readers WHERE name='$name'");
    $checkname->setFetchMode(PDO::FETCH_ASSOC);
    $checkname->execute();
//    $name=$checkname->fetch();
   
    if($checkname->rowCount() == 0)
    {
      $insert = $db->prepare("INSERT INTO readers ( name, email, password )
        VALUES(:name, :email, :password) ");
      $insert->bindParam(':name',$name);
      $insert->bindParam(':email',$email);
      $insert->bindParam(':password',$pass_hash);
      $insert->execute();

      $_SESSION['reader_name']=$name;
      echo "<script>alert('Registration succesful. You are now logged in')</script>";
    }
    else{
      echo "<script>alert('Name already excists. Please choose a different name.')</script>";
    }
  }
  elseif(isset($_POST['signin_reader'])){
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $select = $db->prepare("SELECT * FROM readers WHERE name='$name'");
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();
    $data=$select->fetch();

    $hash = $data['password'];
    
    if($data['name']!=$name)
    {
       echo "<script>alert('invalid username')</script>";
    }
    elseif(!password_verify($pass, $hash)){
     echo "<script>alert('invalid password')</script>";
    }
    elseif($data['name']==$name AND password_verify($pass, $hash))
    {
     $_SESSION['reader_name']=$data['name'];
     echo "<script>alert('login succesful')</script>";
    }
    else{
      header('location:index.php');
    }
  }

 // if not logged in, show register form
if (empty($_SESSION['reader_name'])) {
    ?>  
    <h3 style="margin-left: 30px; color: black; font-size: 1.2em;">Login to leave a comment as a reader</h3>
    <form method="post" id="register_reader" class="loginreader">
      <h3>Register</h3>
      <input type="text" name="name" placeholder="username"><br><br>
      <input type="text" name="email" placeholder="example@example.com"><br><br>
      <input type="password" name="pass" placeholder="**********"><br><br>
      <input type="submit" name="register_reader" value="register">
    </form>
    
    <!--  show login form -->
    <form method="post" id="login_reader" class="loginreader">
      <h3>Login</h3>
      <input type="text" name="name" placeholder="username"><br><br>
      <input type="password" name="pass" placeholder="**********"><br><br>
      <input type="submit" name="signin_reader" value="sign in">
    </form>  

    <!-- show button to reset password -->
    <h3 style="color:black; margin-left: 20px; ">Forgot your password? Get a new one!</h3>
    <button style="margin-left: 20px;"><a href="passwordrecovery.php">Change Password</a></button>
    <?php
  require_once ('./include/include_htmlfooter.php');
  }


}catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

?>