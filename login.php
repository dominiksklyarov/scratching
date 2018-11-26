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
	  $notice = "Go Back!";
  }
  
  }

?>


<html>
    <head>
        <title>
            <p>Testing website</p>
        </title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
    </head>

<body>

    <div class="cont1">
            <div class="cont2">
                <h1>LOGIN</h1>
            </div> <!-- end of second container -->

        <div class="wrapper">
            <div class="forms">

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <!-- Username field -->
                <div class="cont3">
                <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">&nbsp;<span><br><?php echo $usernameError; ?></span>

            
                <!-- Password field -->
                <input name="password" type="password" placeholder="Password">&nbsp;<span><br><?php echo $passwordError; ?></span>

                
                <!-- Log in button--->

                <input name="login" type="submit" value="Lets go" id="login-btn">&nbsp;<span><br><?php echo $notice; ?>
                </form> <!-- END OF FORM -->

            </div> <!-- end of forms div -->
        </div>

    </div> <!-- END OF CONTAINER 1 -->

</body>

</html>