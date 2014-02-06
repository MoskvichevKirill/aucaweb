<?php	
	require 'AltoRouter.php';
	require "../server/csrf.php";
	require "controllers/ContentController.php";
	require "../server/controllers/UserController.php";

	$router = new AltoRouter();
	$router->setBasePath('/aucaweb/app');
	$router->map('GET','/', array('c' => 'ContentController', 'a' => 'home'));
	$router->map('GET','/login', array('c' => 'ContentController', 'a' => 'login'));
	$router->map('GET','/register', array('c' => 'ContentController', 'a' => 'register'));
	$router->map('GET','/search/', array('c' => 'QuestionController', 'a' => 'search'));
	$router->map('GET', '/logout', array('a' => 'logout'));
	$match = $router->match();
	$current_view = "default";
	if($match) {
		if($match['target']['a'] === "home"){
			$current_view = "homeView";
		}
		else if($match['target']['a'] === "login"){
			$current_view = "loginView";
		}
		else if($match['target']['a'] === "register"){
			$current_view = "registerView";	
		}
		else if($match['target']['a'] === "logout"){
			$current_view = "homeView";		
		}
	} 
	else {
	  header("HTTP/1.0 404 Not Found");
	  $current_view = "e404";	
	}
?>