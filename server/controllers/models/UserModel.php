<?php
	include "DB/config.php";
	require "DB/DBdriver.php";
	
	$db = new DB($host, $username, $password, $dbname);
	// $db::getInstance();

	function UserLogin($email, $password){
		global $db;
		$query = "SELECT username, email FROM user_table WHERE email='$email' and password='$password'";
		$result = $db->queryDB($query);
		if($result){
			return $result[0];
		} else {
			return false;
		}
	}
?>