<?php
	require ("models/UserModel.php");
	class UserController {

		function login(){
			if(isset($_POST['email']) && isset($_POST['password'])){
				$email=$_POST['email'];
				$password=$_POST['password'];

				$clean_email = strip_tags(stripslashes(mysql_real_escape_string($email)));
				$clean_password = sha1(strip_tags(stripslashes(mysql_real_escape_string($password))));
				$result = UserLogin($clean_email, $clean_password);

				if($result['type'] !== false){
					$_SESSION['user'] = $result['data'];
					$response = array("success" => true, "message" => "Всё ок!" ,"data" => $result['data']);
					echo json_encode($response);
				}
				else{
					$response = array("success" => false, "message" => "Не удалось войти!" ,"data" => NULL);
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

		function register(){
			if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
				$email = $_POST['email'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$user = array(
					"email" => strip_tags(stripslashes(mysql_real_escape_string($email))),
					"username" => strip_tags(stripslashes(mysql_real_escape_string($username))),
					"password" => sha1(strip_tags(stripslashes(mysql_real_escape_string($password))))
				);
				// if(checkCredentials($email, $username)){
					$result = AddUser($user);
					if($result['type']){
						$response = array("success" => true, "message" => "Регистрация успешна!" ,"data" => $result['data']);
					} else {
						$response = array("success" => false, "message" => "Не удалось зарегистрироваться!" ,"data" => NULL);
					}
				// } else {
				// 	$response = array("success" => false, "message" => "Пользователь с таким именем или почтой существует." ,"data" => NULL);
				// }
				echo json_encode($response);
			}
		}

		function checkCredentials($email, $username){
			$email = strip_tags(stripslashes(mysql_real_escape_string($email)));
			$username = strip_tags(stripslashes(mysql_real_escape_string($username)));
			$result = CheckCredentials($email, $username);
			if($result['type']) {
				return false;
			} else {
				return true;
			}
		}

		function updateUserInfo($new_credentials){

		}
	}
?>