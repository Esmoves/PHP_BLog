<?php

function getusername($blog_id){
   global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
    $sql = "SELECT *, blogs.id 
    FROM blogs 
    JOIN bloggers
    ON blogs.user_id = bloggers.id
    WHERE blogs.id = '$blog_id'";
    //// return first row
    $sth = $db->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $blogger = $row['username'];
    return $blogger;
}

//**** INDEX **************//
// **  get all blogs sorted on newest first *******//


function getAllBlogsFromDB(){
 global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
  $sql = "SELECT *, blogs.id AS bid 
  FROM blogs
  INNER JOIN bloggers
  ON blogs.user_id = bloggers.id
  ORDER BY blogs.id DESC
  LIMIT 10";
  foreach($db->query($sql) as $row) {
     if (!empty($row)){
        $blog_id= $row['bid'];
        $link = "<a href='./blog.php?blog=" .$blog_id. "'>";
        echo "<table class='excerp'>";
        echo "<tr><th colspan='1'>" . $link . $row['titel']. "</a><br />";
        echo "<em> By " .$row['username']. "</em></th></tr>";

        if(!empty($row['id_hoofdimg'])){
          // show image 
          echo "<tr><td>";
          echo "<img src='./user_images/" .$row['id_hoofdimg']. "' height='200px' />";
          echo "</td></tr>";
        }

        echo "<tr><td class='tekst'>" . $link . $row['excerp']. "</a></td></tr>";
        
        echo "<tr><td class='category'><em>Category: ";
        getCategory($blog_id);
        echo "</em></td></tr>";

        echo "</table>";
      }
      else { 
        echo "<p>Nothing to show.</p>";
      }
    }
    unset($row);
}


// ***  get ONE BLOG from one user_id AND blog_id ****//
//***** SHOW THE CATEGORY ****************//
//***** SHOW THE COMMENTS *************//


function getUserId_foroneblog(){
global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
    $sql = "SELECT * FROM bloggers";
    foreach($db->query($sql) as $row){
      $user_id = $row['id'];
      $username = $row['username'];
      $blog_id = $_GET['blog'];
       //  getOneBlogFromDB($user_id, $username, $blog_id);
      }
      unset($row);
}

function getBloggerbyBlogid($user_id){
  global $db;

  $sql = "SELECT * FROM bloggers WHERE id='$user_id'";
  foreach($db->query($sql) as $row) {
    $username= $row['username'];
    echo "<em> By " .$username. "</em></th></tr>";
  }
  unset($row);
}

function getCategory($blog_id){
   global $db;
    $sql = "SELECT * FROM categorie 
    INNER JOIN connectcatwithblog
    ON categorie.id = connectcatwithblog.categorie_id
    INNER JOIN blogs
    ON connectcatwithblog.blog_id = blogs.id
    WHERE connectcatwithblog.blog_id= '$blog_id'";
    foreach($db->query($sql) as $row) {
      $category = $row['naam'];
      echo $category;
      echo " || ";
    }
    unset($row);
}

// Get the actual blog
function getOneBlogFromDB($blog_id){
 global $dbServername, $dbUsername, $dbPassword, $dbname, $db;

  $sql = "SELECT * FROM blogs WHERE id='$blog_id'";
  foreach($db->query($sql) as $row) {
        echo "<table class='excerp'>";
        echo "<tr><th colspan='1'>" .$row['titel']. "<br />";
        getBloggerbyBlogid($row['user_id']);
        echo "</th</tr>";

        echo "<tr><td class='category'>categories: ";
        getCategory($row['id']);
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

// get the comments of the blog
  function getcomments($blog_id){
    global $db;
    echo "<table class='comments'>";
    
    $sql="SELECT c.comment, b.closed, r.name
    FROM comments c
    INNER JOIN blogs b 
    ON b.id = c.blog_id
    INNER JOIN readers r
    ON c.reader_id = r.id
    WHERE b.id= '$blog_id'
    AND c.deleted = 'false'";     
    $sth = $db->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if($row['closed'] == true){
      echo "Closed for commenting.";
      echo "</table>";
    }
    else{
      // get the comments in a row
      foreach($db->query($sql) as $row) {
        echo "<tr><td>".$row['name']."</td>";
        echo "<td>" .$row['comment']. "</td></tr>";
      }
      echo "</table>";
      unset($row); 
     }
      
  }





