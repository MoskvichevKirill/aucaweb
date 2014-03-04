<?php
	require "view.php";
	class ContentController{
		function layout($action){
			$layout_view = new View();
			echo $layout_view->render("views/layout.php", array("action" => $action));
		}
		function loginView(){
			$view = new View();
			echo $view->render("views/login.php");
		}

		function homeView(){
			$view = new View();
			$posts = PostController::getPosts();
			echo $view->render("views/home.php", array('posts'=>$posts));
		}

		function registerView(){
			$view = new View();
			echo $view->render("views/register.php");
		}

		function createPostView(){
			$view = new View();
			echo $view->render("views/create_post.php");
		}

		function e404(){
			$view = new View();
			echo $view->render("views/e404.php");	
		}

		function profileOptions(){
			$view = new View();
			echo $view->render("views/options.php");
		}

	}
?>