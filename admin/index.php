<?php
try{
	require_once ('./include/connection.php');
    require_once ('./include/include_htmlheader_admin.php');

	if(isset($_POST['signup'])){
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];

		// @param string Secure the password with a hash, than save it to database.
		$pass = $_POST['password'];
		$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
	 	$insert = $db->prepare("INSERT INTO bloggers (username, password, email, lastname, firstname)
			VALUES(:username, :password, :email, :lastname, :firstname) ");
		$insert->bindParam(':username',$username);
		$insert->bindParam(':password',$hashed_password);
		$insert->bindParam(':email',$email);
		$insert->bindParam(':lastname',$lastname);
		$insert->bindParam(':firstname',$firstname);
		$insert->execute();

		$_SESSION['name']=$username;

		header('location:profile.php');

		// Validate the login form, start a session with the username as $_SESSION['name']
	}elseif(isset($_POST['signin'])){
		$name = $_POST['name'];
		$pass = $_POST['pass'];

		$select = $db->prepare("SELECT * FROM bloggers WHERE username = '$name'");
		$select->setFetchMode(PDO::FETCH_ASSOC);
		$select->execute();
		$data=$select->fetch();
 		// Verifies the password against the (database-) stored password's hash or returns $checkpassword set to either true or false
		$hashed_password_db = $data['password'];

		if( password_verify ( $pass, $hashed_password_db ) )
		 {
			$_SESSION['name']=$data['username'];
		   
			echo "<script>alert('login succesful')</script>";
			header("location:profile.php");  
		}
		else  {
		 	echo "<script>alert('login failed. Incorrect password or username')</script>";
		}
 	}
 	elseif(isset($_SESSION["name"])) {
 		echo "<h2>Welcome!</h2>";
 		echo "<p>Please use the navigation on your left to upload, edit or delete blogs and comments.</p>";
 	} 
 	elseif(!isset($_SESSION["email"])) {
?>
<!-- login form -->
<div id="login" style="width:500px ; float:right; height:250px;">
	<div style="padding-left:25px;">

	<h2>Login</h2>
		<form method="post">
			<input type="text" name="name" placeholder="username"><br><br>
			<input type="password" name="pass" placeholder="**********"><br><br>
			<input type="submit" name="signin" value="SIGN IN">
		</form>
	</div>
</div>

<!-- Register form -->
<div style="width:500px ; float:left;">
	<div style="padding-left:25px;">

		<h2>Create An Account</h2>
		<form method="post">
			<input type="text" name="username" placeholder="User Name" /><br><br>
			<input type="text" name="firstname" placeholder="First Name" /><br><br>
			<input type="text" name="lastname" placeholder="Last Name" /><br><br>
			<input type="text" name="email" placeholder="example@example.com" /><br><br>
			<input type="password" name="password" placeholder="password" /><br><br>
			<input type="submit" name="signup" value="SIGN UP" />
		</form>
	</div>
</div>

 <!-- show button to reset password -->
 <div style="margin-bottom: 80px;">
    <h3 style="color:black; margin: 50px 0 10px 20px; ">Forgot your password? Get a new one!</h3>
    <button style="margin-left: 20px;"><a href="passwordrecovery.php">Reset Password</a></button>
</div>
<?php 
	}
} catch(PDOException $e) {
	echo "error".$e->getMessage();
}
?>