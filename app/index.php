<?php	
	require 'lib/AltoRouter.php';
	require "lib/csrf.php";
	require "models/dbinit.php";
	require "controllers/ContentController.php";
	require "controllers/UserController.php";
	require "controllers/PostController.php";
	require "controllers/SearchController.php";

	$router = new AltoRouter();
	$router->setBasePath('/aucaweb/app');
	$router->map('GET','/', array('c' => 'ContentController', 'a' => 'homeView'));
	$router->map('GET','/login', array('c' => 'ContentController', 'a' => 'loginView'));
	$router->map('GET','/register', array('c' => 'ContentController', 'a' => 'registerView'));
	$router->map('GET','/search/', array('c' => 'ContentController', 'a' => 'searchView'));
	$router->map('GET','/create', array('c' => 'ContentController', 'a' => 'createPostView'));
	$router->map('GET','/options', array('c'=>'ContentController', 'a'=>'profileOptions'));
	$router->map('GET','/password', array('c'=>'ContentController', 'a'=>'changePassword'));
	$router->map('GET','/email', array('c'=>'ContentController', 'a'=>'changeEmail'));
	$router->map('GET', '/[i:id]', array('c' => 'ContentController', 'a' => 'postView'));
	$router->map('GET', '/e404', array('c' => 'ContentController', 'a' => 'e404'));
	// $router->map('GET', '/test', array('c' => 'PostController', 'a' => 'getPosts'));
	$router->map('GET', '/test', array('c' => 'SearchController', 'a' => 'search_perform'));
	$router->map('POST','/login', array('c' => 'UserController', 'a' => 'login'));
	$router->map('POST','/register', array('c' => 'UserController', 'a' => 'register'));
	$router->map('POST', '/logout', array('c' => 'UserController', 'a' => 'logout'));
	$router->map('POST', '/post', array('c' => 'PostController', 'a' => 'addPost'));
	$router->map('POST', '/rate', array('c' => 'PostController', 'a' => 'ratePost'));

	$router->map('GET|POST', '/search', array('c' => 'ContentController', 'a' => 'searchView'));

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
			if(CSRFcheck()){
				$controller::$action();
			}
		} else if($controller === "SearchController"){
			$controller::$action();
		}
	} else {
		ContentController::layout('e404', $match['params']);
	}
?>