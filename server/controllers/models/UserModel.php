<?php
	include "DB/config.php";
	require "DB/DBdriver.php";

	$db = new DB($host, $username, $password, $dbname);


	/*
	 * Standart template for response array(type => value, data => value )
	 */

	function UserLogin($email, $password){
		global $db;
		$query = "SELECT username, email FROM user WHERE email='$email' and password='$password'";
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
?>