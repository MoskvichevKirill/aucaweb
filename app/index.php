<?php	
	require 'lib/AltoRouter.php';
	require "lib/csrf.php";
	require "models/dbinit.php";
	require "controllers/ContentController.php";
	require "controllers/UserController.php";
	require "controllers/PostController.php";

	$router = new AltoRouter();
	$router->setBasePath('/aucaweb/app');
	$router->map('GET','/', array('c' => 'ContentController', 'a' => 'homeView'));
	$router->map('GET','/login', array('c' => 'ContentController', 'a' => 'loginView'));
	$router->map('GET','/register', array('c' => 'ContentController', 'a' => 'registerView'));
	$router->map('GET','/search/', array('c' => 'ContentController', 'a' => 'searchView'));
	$router->map('GET','/create', array('c' => 'ContentController', 'a' => 'createPostView'));
	$router->map('GET','/options', array('c'=>'ContentController', 'a'=>'profileOptions'));
	$router->map('GET', '/[i:id]', array('c' => 'ContentController', 'a' => 'postView'));
	$router->map('GET', '/e404', array('c' => 'ContentController', 'a' => 'e404'));
	// $router->map('GET','/logout', array('c'=>'UserController', 'a' => 'logout')); //need to fix
	$router->map('POST','/login', array('c' => 'UserController', 'a' => 'login'));
	$router->map('POST','/register', array('c' => 'UserController', 'a' => 'register'));
	$router->map('POST', '/logout', array('c' => 'UserController', 'a' => 'logout'));
	$router->map('POST', '/post', array('c' => 'PostController', 'a' => 'addPost'));
	$match = $router->match();
	if($match){
		$controller = $match['target']['c'];
		$action = $match['target']['a'];
		if($controller === "ContentController"){
			if($match['params']){
				$controller::layout($action, $match['params']);
			} else {
				$controller::layout($action);
			}
		} else if($controller === "UserController"){
			if(CSRFcheck()){
				$controller::$action();
			} else {
				return header("HTTP/1.0 404 Not Found");
			}
		} else if($controller === "PostController"){
			if($action === "addPost"){
				if(CSRFcheck()){
					$controller::$action();
				}
			}
		}
	} else {
		ContentController::layout('e404', $match['params']);
	}
?>