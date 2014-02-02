<?php
	include "controllers/UserController.php";
	
	if(isset($_POST['method'])){
		if($_POST['method'] === "login"){
			login();
		}
	}
?>