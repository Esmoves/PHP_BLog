<?php
try{
  require_once ('./include/connection.php');
  require_once ('./include/include_html.php');
  require_once ('./include/include_menu.php');

  if(isset($_POST['sendwithmail'])){
  	$email = $_POST['email'];

  	 // Check to see if a user exists with this e-mail
    $query = $db->prepare('SELECT email FROM bloggers WHERE email = :email');
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
		function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
		{
		    $str = '';
		    $max = mb_strlen($keyspace, '8bit') - 1;
		    for ($i = 0; $i < $length; ++$i) {
		        $str .= $keyspace[random_int(0, $max)];
		    }
		    return $str;
		}
		$newpass = random_str(8);
		$pass_hash = password_hash($newpass, PASSWORD_DEFAULT);
		//insert the new, secured password into the database
		$sql = "UPDATE bloggers SET password = '$pass_hash' WHERE email = '$email'";
		$query = $db->prepare( $sql );
		if( $query->execute()) {
			// if insert is succesful, send email with new password
			$to = $email;
			$from = "esmeraldatijhoff@yahoo.com";
			$subject = "Your password has been reset for your blog";
			$txt = "Hi!\nYour password has been reset for the blog\n Your new password is" .$newpass. "\nPlease visit www.wijzijncodegorilla.nl/esmeraldatijhoff/blog to login\n Greetings from the IT team of Tijhoff inc!";
			$headers = "From: $from\r\n";
			// send email
			if(mail($to, $subject, $txt, $headers)){
				echo "A message with your new password has been send to your email account.";
			}
			else{
				echo "Sorry, email could not be send.";
			}
	 	}
	  }
	  else{
	  	echo "Email address is unknown";
	  }
	}
	// if no form has been send, show forms
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