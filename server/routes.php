<?php	
	require "AltoRouter.php";
	require "../server/csrf.php";
	require "controllers/models/dbinit.php";
	require "controllers/UserController.php";
	require "controllers/PostController.php";

	$server = new AltoRouter();

	$server->setBasePath('/aucaweb/server');

	$server->map('POST','/login', array('c' => 'UserController', 'a' => 'login'));
	$server->map('POST','/register', array('c' => 'UserController', 'a' => 'register'));
	$server->map('POST', '/logout', array('c' => 'UserController', 'a' => 'logout'));
	$server->map('POST', '/post', array('c' => 'PostController', 'a' => 'addPost'));
	$match = $server->match();

	if($match){
		if(CSRFcheck()){
			$match['target']['c']::$match['target']['a']();
		}
	} else {
	  header("HTTP/1.0 404 Not Found");
	}
?>