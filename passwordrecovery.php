<?php
try{
  require_once ('./include/connection.php');
  require_once ('./include/include_html.php');
  require_once ('./include/include_menu.php');

  if(isset($_POST['sendwithmail'])){
  	$email = $_POST['email'];

  	 // Check to see if a user exists with this e-mail
    $query = $conn->prepare('SELECT email FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $userExists = $query->fetch(PDO::FETCH_ASSOC);
    $conn = null;
     if ($userExists["email"])
    {
    	/**
		 * Generate a random string, using a cryptographically secure 
		 * pseudorandom number generator (random_int)
		 * 
		 * @param string $keyspace A string of all possible characters
		 *                         to select from
		 * @return string
		 */
		function random_str($lenght, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
		{
		    $str = '';
		    $max = mb_strlen($keyspace, '8bit') - 1;
		    for ($i = 0; $i < $length; ++$i) {
		        $str .= $keyspace[random_int(0, $max)];
		    }
		    return $str;
		}

		$newpass = random_str(8);
		echo $newpass;
		echo "<br />";
		$pass_hash = password_hash($newpass, PASSWORD_DEFAULT);

	  }
	}
	else{
	?>

	<h2>Get a new password</h2>
	<form action="passwordrecovery.php" method="POST">
		<label for="email">Email</label><br />
		<input type="tekst" name="email" placeholder="name@email.com" />
		<br /><br />
		<input type="submit" name="sendwithmail" value="send" />
	</form> 


	<?php

	require_once ('./include/include_htmlfooter.php');
	}

}catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

  ?>