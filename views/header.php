<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Question & Answer</title>
	<link rel="icon" href="assets/favicon.ico">
	<link rel="stylesheet" href="style/style.css">
	<script src="lib/jquery-1.11.0.min.js"></script>
	<script src="lib/tinymce.min.js"></script>
	<script src="scripts/app.js"></script>
</head>
<body>
	<header>
		<div class="logo"><span class="site_title"><?=$site_title?></span><a href="/qna"><img src="assets/logo.png" alt="logo"></a></div>
		<div class="srbar"><form action="/qna/search" method="POST"><input class="search" type="text" name="terms" id="search"><input class="srcbutton" type="submit" value="Поиск"></form></div>
		<div class="cpanel"><ul>
			<?php if(UserController::getUser() === NULL){?>
			<li><span class="signup"><a href="/qna/register">Регистрация</a></span></li>
			<li><span class="login">Войти</span></li>
			<?php } else { $name = UserController::getUser()['username']; ?>
			<li><button class="postbtn"><a href="/qna/create"><span><span class="plus"><img src="assets/plus.png" alt="plus"></span>Задать вопрос</span></a></button></li>
			<li><?php echo $name; ?></li>
			<li>
				<div class="optbtn" title="Меню">
					<div class="line"></div>
					<div class="line"></div>
					<div class="line"></div>
				</div>
				<div class="usermenu">
					<div class="triangle-pointer"></div>
					<ul>
						<li class="options">Настройки профиля</li>
						<li class="logout">Выйти</li>
					</ul>
				</div>
			</li>
			<?php } ?>
		</ul></div>
	</header>