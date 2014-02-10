<?php	
	require "AltoRouter.php";
	require "../server/csrf.php";
	require "controllers/UserController.php";
	
	$server = new AltoRouter();

	$server->setBasePath('/aucaweb/server');
	
	$server->map('POST','/login', array('c' => 'UserController', 'a' => 'login'));
	$server->map('POST','/register', array('c' => 'UserController', 'a' => 'register'));
	$server->map('POST', '/logout', array('c' => 'UserController', 'a' => 'logout'));
	$match = $server->match();
	
	if($match) {
		if($match['target']['a'] === "login"){
			if(CSRFcheck()){
				UserController::login();
			}
		} elseif($match['target']['a'] === "register"){
			if(CSRFcheck()){
				// Need to add data varification for anc check for similarities
				UserController::register();
			}
		} elseif ($match['target']['a'] === "logout") {
			if(CSRFcheck()){
				UserController::logout();
			}
		}
	}
	else {
	  header("HTTP/1.0 404 Not Found");
	}
?>