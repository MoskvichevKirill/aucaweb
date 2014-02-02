<?php	
	require 'AltoRouter.php';
	require "../server/csrf.php";
	require "controllers/ContentController.php";

	$router = new AltoRouter();
	$router->setBasePath('/aucaweb/app');
	$router->map('GET','/', array('c' => 'ContentController', 'a' => 'home'));
	$router->map('GET','/login', array('c' => 'ContentController', 'a' => 'login'));
	$router->map('GET','/register', array('c' => 'ContentController', 'a' => 'register'));
	$router->map('POST','/search/', array('c' => 'QuestionController', 'a' => 'search'));

	$match = $router->match();
	$current_view = "default";
	if($match) {
		if($match['target']['a'] === "home"){
			$current_view = "home";
		}
		else if($match['target']['a'] === "login"){
			$current_view = "login";
		}
		else if($match['target']['a'] === "register"){
			$current_view = "register";	
		}
	} 
	else {
	  // header("HTTP/1.0 404 Not Found");
	  // require '404.html';
	  // echo "no";
	  $current_view = "e404";	
	}
?>