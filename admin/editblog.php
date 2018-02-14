<?php
try{
  require_once ('./include/connection.php');
  require_once ('./include/include_admin.php');
  require_once ('./include/include_blogs.php');
  require_once ('./include/include_htmlheader_admin.php');
  
  if(isset($_SESSION["email"]))  
    {  

  // if not empyt post do not empty get
  if ( empty( $_POST['newblog'] ) ){ // if form is not send show form

    if(!empty($_GET['action'])&&!empty($_GET['user'])&&!empty($_GET['blog'])){
      $action = $_GET['action'];
      $user = $_GET['user'];
      $blog_id = $_GET['blog'];

      if($action == 'delete'){
        deleteblog($blog_id);
        header('location:manageblogs.php');
      }

      if ($action == 'edit'){
        //get the values
        $sql = "SELECT * FROM blogs WHERE id='$blog_id'";
        foreach($db->query($sql) as $row) {
        ?>

          <form id="newblog" class="newblog" name="newblog" enctype="multipart/form-data" action="./editblog.php" method="post">
          <input type="hidden" name="blog" value="<?php echo $blog_id ?>" />
          <label for"titel">Titel</label><br />
          <input type="text" name="titel" id="titel" required="required" value="<?php echo $row["titel"] ?>" placeholder="<?php echo $row["titel"] ?>" /><br /><br />
          
          <label for"headerimg">Header image</label><br />
          <input name="image" type="file" accept="image/*" value="<?php echo $row["id_hoofdimg"] ?>"><br /><br />
         
          <label for"excerp">Excerp</label><br />
          <textarea id="excerp" class="excerp" name="excerp" required="required" value="<?php echo $row["excerp"] ?>"><?php echo $row["excerp"] ?></textarea><br /><br />
          <label for"tekst">Text</label><br />
          <textarea id="tekst" name="tekst" required="required" value="<?php echo $row["excerp"] ?>"><?php echo $row["excerp"] ?></textarea><br /><br />
          <input type="submit" id="submit" name="newblog" style="width:200px;" value="edit my blog!" />  
        </div>   

  <?php
    require_once ('include/include_htmlfooter.php');
    }
  }

  } else{ // if empty get
    header('location:login.php');
    }
  }else if (!empty( $_POST['newblog'] ) ){// if post is send
    editmyblog($_POST['blog']);
  } 

  }
  else{ // if no session
    header('location:login.php');
    }

}catch(PDOException $e){
  echo "error".$e->getMessage();
} 
    
?>