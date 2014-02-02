<?php
	function login(){
		// if(isset($_POST['email']) && isset($_POST['password'])){
			// $email=$_POST['email'];
			// $password=$_POST['password'];

			// $clean_email = strip_tags(stripslashes(mysql_real_escape_string($email)));
			// $clean_password = sha1(strip_tags(stripslashes(mysql_real_escape_string($password))));

			//here goes some code with UserModel and DB connection
			//Then if true here comes the response of access else denied and
			//Redirect to login view

			if(true){
				$user = array("username" => "rem4ik4ever","email" => "rem4ik4ever@gmail.com");
				$_SESSION['user'] = $user;
				$response = array("success" => true, "message" => "Login successful!" ,"data" => $user);
				echo json_encode($response);
			}
			else{
				$response = array("success" => false, "message" => "Login failed!" ,"data" => NULL);
				echo json_encode($response);
			}
		// }
	}
	function getUser(){
		if(!isset($_SESSION['user'])){
			return $_SESSION['user'];
		} else {
			return NULL;
		}
	}
?>