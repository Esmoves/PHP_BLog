<?php
// See the password_hash() example to see where this came from.

$pass = 'password';
$hash = password_hash($pass, PASSWORD_DEFAULT);

echo "password: ";
echo $pass;
echo "<br /> hashed password: ";
echo $hash;
echo "<br />";

if (password_verify($pass, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>