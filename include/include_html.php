<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'>

    <html xmlns='http://www.w3.org/1999/xhtml' xml:lang='nl' lang='nl'>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <meta name="description" content="Blog application by Esmeralda Tijhoff" />  
        <meta name="keywords" content="" />
        <meta name="author" content="A.E.Tijhoff" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        <link rel="shortcut icon" type="image/x-icon" href="./style/favicon.ico" />
        <link href="./style/style.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="./style/normalize.css" />
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Pontano+Sans|Roboto+Mono" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script src='./scripts/scriptscat.js' type="text/javascript"></script>


       <title>BLOG App</title>

    </head>
    <body>


       <div id="container" class="container">
          <div class="titel" id="top-header">        

        <!-- Main Menu -->
        <div class="mainmenu">
          <ul class="mainmenu">
            <li><a href="index.php">home</a></li>
            <li><a href="./admin/index.php">Admin</a></li>
            <?php 
             if (!empty($_SESSION['reader_name'])){
              echo "<li><a href='./include/logout.php'>logout reader</a></li>";
             }
             else{
              echo "<li><a href='./loginreader.php'>login as reader</a></li>";
             }
             ?>
          </ul>
          <h1>BLOG App</h1>
        </div>  
      </div>
        <br />
        <br />

        <div class="Allcontent">
            <!-- Left side menu div -->
            
          