<?php
	require("../vpconfigure.php");
	$GLOBALS["serverHost"];
	$GLOBALS["serverUsername"];
	$GLOBALS["serverPassword"];
    $database = "if18_dominik_sk_2";

    session_start();
    
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    @mysql_select_db($database);

  function signin($username, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	// loginform: id, username, password
	$stmt = $mysqli->prepare("SELECT id, username, password FROM loginform WHERE username=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $username);
	$stmt->bind_result($idFromDb, $usernameFromDb, $passwordFromDb);
	if($stmt->execute()){
		//kui päring õnnestus - TEEB ÄRA
	  if($stmt->fetch()){
		//kasutaja on olemas
		if($password == $passwordFromDb){
		  //kui salasõna klapib - TEEB ÄRA
		  $notice = "You have successfully logged in!";
		  //määran sessioonimuutujad - TEEB ÄRA
			$_SESSION["userId"] = $idFromDb;
			$_SESSION["userUsername"] = $usernameFromDb;
            //liigume edasi uuele lehele
          $stmt->close();
          $mysqli->close();
          header("Location:welcome.php");
		exit();
			// kui parool ei klappinud
		} else {
		  $notice = "Invalid password!";
		}
			// kui kasutajat ei ole olemas
	  } else {
		$notice = "There is no user like (" .$username .")!";  
		}
			//kui sisselogimisel tekkis tehniline viga
	} else {
	  $notice = "Error code: 1." .$stmt->error;
    } 
        $stmt->close();
	    $mysqli->close();
	    return $notice;
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; }
          


?>