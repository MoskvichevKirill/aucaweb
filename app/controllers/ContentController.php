<?php
	require "view.php";
	class ContentController{
		function layout($action, $params = array(), $site_title=""){
			$layout_view = new View();
			echo $layout_view->render("views/layout.php", array("action" => $action, 'params' => $params, 'site_title' => $site_title));
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

		function postView($id){
			$view = new View();
			$post = PostController::getPost($id);
			echo $view->render("views/post.php", array('post'=>$post));
		}

		function changePassword(){
			$view = new View();
			echo $view->render("views/change_password.php");
		}
		function changeEmail(){
			$view = new View();
			echo $view->render("views/change_email.php");
		}
		function searchView(){
			$view = new View();
			$terms = $_POST['terms'];
			$posts = SearchController::search($terms);
			echo $view->render("views/search.php", array('posts'=>$posts));
		}
	}
?>