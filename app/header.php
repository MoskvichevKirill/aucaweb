<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Question & Answer</title>
	<link rel="icon" href="assets/favicon.ico">
	<link rel="stylesheet" href="style/style.css">
	<script src="lib/jquery-1.11.0.min.js"></script>
	<script src="scripts/login.js"></script>
</head>
<body>
	<header>
		<div class="logo"><a href="/aucaweb/app"><img src="assets/logo.png" alt="logo"></a></div>
		<div class="srbar"><form action="" method="POST"><input class="search" type="text" name="searchbar" id="search"><input class="srcbutton" type="submit" value="Search"></form></div>
		<div class="cpanel"><ul>
			<?php if(UserController::getUser() === NULL){?>
			<li><span class="signup"><a href="http://localhost/aucaweb/app/register">Регистрация</a></span></li>
			<li><span class="login">Войти</span></li>
			<?php } else { $name = UserController::getUser()['username']; ?>
			<li><button class="postbtn"><a href="http://localhost/aucaweb/app/create"><span><span class="plus"><img src="assets/plus.png" alt="plus"></span>Задать вопрос</span></a></button></li>
			<li><?php echo $name; ?></li>
			<li><button><span class="logout">Выйти</span></button></li>
			<?php } ?>
		</ul></div>
	</header>