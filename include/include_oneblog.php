<?php
// get the author
  function getBloggerbyBlogid($user_id){
  global $db;
  $sql = "SELECT * FROM bloggers WHERE id='$user_id'";
  foreach($db->query($sql) as $row) {
    $username= $row['username'];
    echo "<em> By " .$username. "</em></th></tr>";
  }
  unset($row);
}

function getCategory($category){
  global $db;
  $sql = "SELECT * FROM categorie WHERE id='$category'";
  foreach($db->query($sql) as $row) {
    $category = $row['naam'];
    echo $category;
  }
  unset($row);
}

// Get the actual blog
function getOneBlogFromDB($blog_id){
  global $db;
  $sql = "SELECT * FROM blogs WHERE id='$blog_id'";
  foreach($db->query($sql) as $row) {
        echo "<table class='excerp'>";
        echo "<tr><th colspan='1'>" .$row['titel']. "<br />";
        getBloggerbyBlogid($row['user_id']);
        echo "</th</tr>";
        echo "<tr><td class='category'>categories: ";
        getCategory($row['category']);
        echo "</td></tr>";

        if(!empty($row['id_hoofdimg'])){
          // show image 
          echo "<tr><td>";
          echo "<img src='./user_images/" .$row['id_hoofdimg']. "' height='200px' />";
          echo "</td></tr>";
        }

        // show text
        echo "<tr><td class='tekst'>" .$row['tekst']. "</td></tr>";  
        echo "</table>";
    }
    unset($row);
}

?>