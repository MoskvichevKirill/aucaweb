<?php	
	require 'AltoRouter.php';
	require "../server/csrf.php";
	require "controllers/ContentController.php";
	require "../server/controllers/UserController.php";

	$router = new AltoRouter();
	$router->setBasePath('/aucaweb/app');
	$router->map('GET','/', array('c' => 'ContentController', 'a' => 'homeView'));
	$router->map('GET','/login', array('c' => 'ContentController', 'a' => 'loginView'));
	$router->map('GET','/register', array('c' => 'ContentController', 'a' => 'registerView'));
	$router->map('GET','/search/', array('c' => 'ContentController', 'a' => 'searchView'));
	$router->map('GET','/create', array('c' => 'ContentController', 'a' => 'createPostView'));
	$router->map('GET','/options', array('c'=>'ContentController', 'a'=>'profileOptions'));
	// $router->map('GET','/logout', array('c'=>'UserController', 'a' => 'logout')); //need to fix
	$match = $router->match();
	if($match){
		$controller = $match['target']['c'];
		$action = $match['target']['a'];
	} else {
		$controller = "ContentController";
		$action = "e404";
	}
?>