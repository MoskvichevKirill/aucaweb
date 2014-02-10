<?php
	require ("models/UserModel.php");

	function login(){
		if(isset($_POST['email']) && isset($_POST['password'])){
			$email=$_POST['email'];
			$password=$_POST['password'];

			$clean_email = strip_tags(stripslashes(mysql_real_escape_string($email)));
			// $clean_password = sha1(strip_tags(stripslashes(mysql_real_escape_string($password))));
			$clean_password = strip_tags(stripslashes(mysql_real_escape_string($password)));
			$result = UserLogin($clean_email, $clean_password);

			if($result['type'] !== false){
				$_SESSION['user'] = $result['data'];
				$response = array("success" => true, "message" => "Login successful!" ,"data" => $result['data']);
				echo json_encode($response);
			}
			else{
				$response = array("success" => false, "message" => "Login failed!" ,"data" => NULL);
				echo json_encode($response);
			}
		}
	}

	function logout(){
		unset($_SESSION['user']);
	}

	function getUser(){
		if(isset($_SESSION['user'])){
			return $_SESSION['user'];
		} else {
			return NULL;
		}
	}

	function addUser($email, $username, $password){
		$user = array(
			"email" => strip_tags(stripslashes(mysql_real_escape_string($email))),
			"username" => strip_tags(stripslashes(mysql_real_escape_string($username))),
			"password" => sha1(strip_tags(stripslashes(mysql_real_escape_string($password))))
		);
		$result = AddUser($user);
		if($result['type']){
			return array("success" => true, "message" => "Registration successful!" ,"data" => $result['data']);
		} else {
			return array("success" => failed, "message" => "Registration failed due to server issues!" ,"data" => NULL);
		}
	}

	function checkCredentials($email, $username){
		$credentials = array(
			"email" => strip_tags(stripslashes(mysql_real_escape_string($email))),
			"username" => strip_tags(stripslashes(mysql_real_escape_string($username))),
		);
		$result = CheckCredentials($credentials);
		if($result['type']) {
			return array("success" => true, "message" => "Credentials are valid!" ,"data" => NULL);
		} else {
			$message = "This ".$result['data']." is already in use";
			return return array("success" => true, "message" => $message ,"data" => NULL);
		}
	}
?>