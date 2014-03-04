<?php
	/*
	 * Standart template for response array(type => value, data => value )
	 */
	function UserLogin($email, $password){
		global $db;
		$query = "SELECT id, username, email FROM user WHERE email='$email' and password='$password'";
		$result = $db->queryDB($query, "select");
		if($result) {
			return array('type' => true, 'data' => $result[0]);
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}

	function AddUser($user){ // Need to add check for equal emails and usernames
		global $db;
		$email = $user['email'];
		$username = $user['username'];
		$password = $user['password'];
		$validate = 0;
		$auth_key = sha1(strip_tags(stripslashes($password.$username)));
		$query = "INSERT INTO user(email, username, password, validate, auth_key) VALUES ('$email', '$username', '$password', '$validate', '$auth_key')";
		$result = $db->queryDB($query, "insert");
		if($result) {
			return array('type' => true, 'data' => $auth_key);
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}
	function CheckCredentials($email, $username){
		global $db;
		$query = "SELECT * FROM user WHERE email='$email' OR username='$username'";
		$result = $db->queryDB($query, "select");
		if(count($result) == 0) {
			return array('type' => false, 'data' => null);
		} else {
			return array('type' => true, 'data' => null);
		}
	}
?>