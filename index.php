<?php
  require("functions.php");
  $notice = "";
  $username = "";
  $usernameError = "";
  $passwordError = "";

  if(isset($_POST["login"])){
	if (isset($_POST["username"]) and !empty($_POST["username"])){
	  $username = test_input($_POST["username"]);
    } else {
	  $usernameError = "Please insert your username!";
    }
  
    if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
	  $passwordError = "Please insert your password!";
    }
  
  if(empty($usernameError) and empty($passwordError)){
	 $notice = signin($username, $_POST["password"]);
	 } else {
	  $notice = "Ei saa sisse logida!";
  }
  
  }

?>


<html>
    <head>
        <title>
            <p>Testing website</p>
        </title>
    </head>

    <body>
        <h1>Welcome to the testing website.</h1>
        <p>I built this website entirely using html, css and php.</p>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">&nbsp;<span><?php echo $usernameError; ?></span><br>
	  
        <input name="password" type="password" placeholder="Password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>


    </body>
</html>