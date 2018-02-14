<?php
    require_once ('./include/connection.php');
    require_once ('./include/include_reader.php');
    require_once ('./include/include_html.php');
    require_once ('./include/include_menu.php');

try {

    $blogger_id = $_GET['blogger'];

    // This is the blogger that is being displayed 
    welcomeblogger($blogger_id);
    // show all blogs with this category  
    showblogsbyblogger($blogger_id);

    require_once ('./include/include_htmlfooter.php');
  }
// ERROR IF NO CONNECTION DATABASE
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
