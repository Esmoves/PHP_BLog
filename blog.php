<?php
require_once('./include/connection.php');
require_once('./include/include_reader.php');
require_once('./include/include_html.php');
require_once('./include/include_menu.php');


// ***************  Run the page ****************//

try 
{

  $blog_id = $_GET['blog'];
 // get blog by id
  getOneBlogFromDB($blog_id);
  
  // show comments for reader
  getcomments($blog_id);

  require_once('./include/include_commenting.php');

  require_once('./include/include_htmlfooter.php');

}catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

?>