<?php

function managecategories(){
 global $db;
 $sql = "SELECT * FROM categorie";
 echo "<table class='excerp'><tr><th colspan='2'>Categories</th></tr>";
 foreach($db->query($sql) as $row) {
    $categorie = $row['naam'];
    $categorie_id = $row['id'];
    $link = "<a href='./categories.php?cat=" .$categorie_id. "'>";
    
    echo "<tr><td>" .$categorie. "</td>";
    echo "<td>" .$link. "delete</a></td>";
    echo "</tr>";
    
  }
  echo "</table>";  
  unset($row);
}

function deletecat($cat_id){
  global $db;
  $sql = "DELETE FROM categorie WHERE id = '$cat_id'";
  $stmt = $db->prepare($sql);
  if ($stmt->execute()){
      header('location:./categories.php');
    }
 }

 function insertnewcat($newcatname){
  global $db;
  $sql = "INSERT INTO categorie (naam) VALUES ( :naam )";
  $query = $db->prepare( $sql );
  if( $query->execute( array(':naam'=>$newcatname ) ) ){
     header('location:./categories.php');
  }
 }

 ?>