<?php
	require("../vpconfigure.php");
	$GLOBALS["serverHost"];
	$GLOBALS["serverUsername"];
	$GLOBALS["serverPassword"];
    $database = "if18_dominik_sk_2";
    
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
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib - TEEB ÄRA
		  $notice = "You have successfully logged in!";
		  //määran sessioonimuutujad - TEEB ÄRA
			$_SESSION["userId"] = $idFromDb;
			$_SESSION["userUsername"] = $usernameFromDb;
		  //liigume kohe vaid sisselogitutele mõeldud pealehele - SIIN CRASHIB
          $stmt->close();
          $mysqli->close();
          $notice = "Logisite sisse!";
					exit();
			// kui parool ei klappinud
		} else {
		  $notice = "Invalid password!";
		}
			// kui kasutajat ei ole olemas
	  } else {
		$notice = "Sellist kasutajat (" .$username .") ei leitud!";  
		}
			//kui sisselogimisel tekkis tehniline viga
	} else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
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