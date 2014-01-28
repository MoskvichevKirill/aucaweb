<?php	
	require 'AltoRouter.php';
	require 'controllers/UserController.php';
	require 'controllers/ContentController.php';

	$router = new AltoRouter();
	$router->setBasePath('/aucaweb/app');
	$router->map('GET|POST','/', 'home#index', 'home');
	$router->map('GET','/login', array('c' => 'ContentController', 'a' => 'show_login'));
	$router->map('POST','/login', array('c' => 'UserController', 'a' => 'login'));
	$router->map('POST', '/search', array('c' => 'QuestionController', 'a' => 'search'));

	$match = $router->match();
	// echo $match['target']['c'];
	if($match) {
	  // echo $match['target']['c'];
	} else {
	  // header("HTTP/1.0 404 Not Found");
	  // require '404.html';
	  // echo "no";
	}
?>