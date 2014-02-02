<?php
	require "view.php";

	function login(){
		$view = new View();
		echo $view->render("views/login.php");
	}
	function home(){
		$view = new View();
		echo $view->render("views/home.php");
	}
	function register(){
		$view = new View();
		echo $view->render("views/register.php");
	}
	function e404(){
		$view = new View();
		echo $view->render("views/e404.php");	
	}
	function set_view($fn){
		$fn();
	}

	function renderView(){
		if($current_view !== NULL){
			// return $current_view;
		}
	}
?>