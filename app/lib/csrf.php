<?php
	session_start();

	function CSRFgen(){
		if(!isset($_SESSION['CSRF']) || $_SESSION['CSRF'] === null){
			$csrf_key = md5(mt_rand());
			$_SESSION['CSRF'] = $csrf_key;
			$csrf_key = null;
		}
		return $_SESSION['CSRF'];
	}
	function CSRFcheck(){
		if(isset($_POST['CSRF'])){
			if($_SESSION['CSRF'] == $_POST['CSRF']){
				return true;
			}
		}
		return false;
	}
?>