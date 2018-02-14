<?php

function getuserid(){
    global $db;
    $useremail = $_SESSION['email'];
    $sql = "SELECT * FROM bloggers WHERE email = '$useremail'";
    $sth = $db->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['id'];
      return $user_id;  
}
    
function usersettings($useremail){ 
global $db;
$sql = "SELECT * FROM bloggers WHERE email = '$useremail'";
//// return first row
$sth = $db->prepare($sql);
$sth->execute();
$row = $sth->fetch(PDO::FETCH_ASSOC);

  echo "<table class='excerp'>";
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  echo "<table class='excerp'><tr><th colspan='2'>Settings user</th></tr>";
  echo "<tr><td>Name</td><td>" .$firstname. " " .$lastname. "</td></tr>";
  echo "<tr><td>Email</td><td>" .$email. "</td></tr>";
  echo "</table>";
  unset($row);
}

function getBlogger($user_id){
    global $db;
    $sql = "SELECT * FROM bloggers WHERE id= '$user_id'";

    //// return first row
    $sth = $db->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);

      $user_id = $row['id'];
      $username = $row['username'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $name = $firstname. " " .$lastname;
      $user_email = $row['email'];   
      return $name;
    }

?>