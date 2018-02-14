<?php
  require_once ('./include/connection.php');
  require_once ('./include/include_admin.php');
  require_once ('./include/include_htmlheader_admin.php');
  require_once ('./include/include_menu.php');

//*************************************************************************//
//*************************************************************************//
// ***************  Run the page!!!!!  ************************************//
//*************************************************************************//
//*************************************************************************//
try {
            $categorie_id = $_GET['cat'];

            // This is the category that is being displayed 
            welcomecategory($categorie_id);
            // show all blogs with this category  
            showblogsbycategorie($categorie_id);
            ?>

<?php 
    require_once ('./include/include_htmlfooter.php');
  }
// ERROR IF NO CONNECTION DATABASE
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
