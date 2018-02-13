<?php
 try{
  require_once ('./include/connection.php');
  require_once ('./include/include_admin.php');
  require_once ('./include/include_blogs.php');
  require_once ('./include/include_htmlheader_admin.php');
  
  if(isset($_SESSION["email"]))  
    {  
      if ( empty( $_POST['newblog'] ) ){ 
        // get user_id
        $user_id=getuserid();
        $blogger=getBlogger($user_id);
        echo "<h2>Upload as " .$blogger. " </h2>";  
?>
        <form id="newblog" class="newblog" name="newblog" enctype="multipart/form-data" action="./newblog.php" method="post">
          <label for="titel">Titel</label><br />
          <input type="text" name="titel" id="titel" required="required" placeholder="Please Enter your titel" /><br /><br />
          
          <label for="headerimg">Header image</label><br />
          <input name="image" type="file" accept="image/*" /><br /><br />
         
          <label for="excerp">Excerp</label><br />
          <textarea id="excerp" class="excerp" name="excerp" required="required"></textarea><br /><br />
          <label for="tekst">Text</label><br />
          <textarea id="tekst" name="tekst" required="required"></textarea><br /><br />
         
         <div style="margin-left: 100px;">
            <label for="category">Choose your categories</label>
            <p style="font-size: 0.7em"><em>Keep CTRL pressed to select multiple categories</em></p> 

            <!-- Get the categories out of the database to display in a multiple choice.-->
            <select style="width: 200px" id="category" name="category[]" multiple="multiple"> 
              <?php
                  global $dbServername, $dbUsername, $dbPassword, $dbname, $db;
                  $sql = "SELECT * FROM categorie";
                  foreach($db->query($sql) as $row)
                  {  
                    $id= $row['id'];
                    $naam = $row['naam'];
                    echo "<option name='category' style='text-align: center;' value='".$id."'>" . $naam . "</option>";
                  } 
              ?>
            </select><br /><br />
          <input type="submit" id="submitnewblog" name="newblog" style="width:200px;" value="upload my blog!" />  
          <br /><br />
      </div>   
    </form>

    <?php

    require_once ('./include/include_htmlfooter.php');

    } 
    else if ( !empty( $_POST['newblog'] ) ){ // if form is submitted, upload input to db
          upload();
    }

  } // end session
  else{
    header("location:index.php");
  }

}catch(PDOException $e){
  echo "error".$e->getMessage();
} 
    
?>