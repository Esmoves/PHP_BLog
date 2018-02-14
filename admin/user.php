<?php
// login tutorial
include_once('connection.php');

class User{

  private $db;

  public function __construct(){
    $this->db = new Connection();
    $this->db = $this->db->dbConnect();
  }

  public function Login($username, $password){
      if(!empty($username) && !empty($password)){
        $st = $this->db->prepare("SELECT * FROM bloggers WHERE username=? AND password=?");
        $st->bindParam(1, $username);
        $st->bindParam(2, $password);
        $st->execute();

        if($st->rowCount()== 1){
          echo "User verified";
        }
        else
          { 
            echo "incorrect username or password";
          }

    } else {
      echo "Enter username and password";
    }
  }
}