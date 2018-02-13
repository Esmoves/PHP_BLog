<?php
    require_once ('./include/connection.php');
    require_once ('./include/include_reader.php');
    require_once ('./include/include_html.php');
    require_once('./include/include_menu.php');
    try {
         
     getAllBlogsFromDB();

     require_once ('./include/include_htmlfooter.php');

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>