<?php
  require("functions.php");
  $notice = "";
  $username = "";
  $usernameError = "";
  $passwordError = "";

//if the person is not validated
  if(!isset($_SESSION["userId"])){
	  header("Location: index.php");
	  exit();
  }
  
//logout
     if(isset($_GET["logout"])){
	     session_destroy();
	     header("Location: login.php");
	exit();
  }

?>


<html>
    <head>
        <title>
            <p>Testing website</p>
        </title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>

    <body>
        <h1>Welcome to the testing website.</h1>
        <p>I built this website entirely using html, css and php.</p>
        <a href="?logout=1">Log out!</a>
        <a herf="addusers">Add another user</a>
    </body>
</html>