<?php
	require 'Connection.php';
	mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.'); 
	$errors = array();
	if(isset($_POST['submit'])){
		if(trim($_POST['email']) == ''){
			$errors[] = 'Пожалуйста, введите email.';
		}
		if(trim($_POST['pass']) == ''){
			$errors[] = 'Пожалуйста, введите пароль.';
		}
		if($sql = mysqli_query($link, "SELECT * FROM clients WHERE email='".$_POST['email']."';")){
			$num_rows = mysqli_num_rows($sql);
			if($num_rows <= 0){
				$errors[] = 'Пользователя с таким email не существует.';
			}
			else{
				session_start(); 
				$user = mysqli_fetch_array($sql, MYSQLI_ASSOC);
				$passhash = $user['Password'];
				$isAdm = (boolean)$user['IsAdmin'];
				$_SESSION['id_client'] = $user['ID_Client']; 
				if(password_verify($_POST[pass], $passhash)){
					if($isAdm == true){
						$_SESSION['admin'] = true;
						echo "<script>location.replace('administration.php');</script>";
					} else{
						$_SESSION['user'] = true;
						echo "<script>location.replace('cabinet.php');</script>";
					}
				} else{
					$errors[] = 'Неверный пароль.';
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Авторизация</title>
	<link rel="shortcut icon" href="../img/icon.png" type="image/png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=5">
	<link rel="stylesheet" href="../css/adaptive.css?v=5">
</head>
<body>
	<div class="layout">
		<div class="container">
			<header class="header">
				<a href="../index.html" class="header__logo"><span>Full</span>Bloom</a>
				<nav class="header__navs">
					<a href="../index.html" class="header__nav">Главная</a>
					<a href="catalog.php" class="header__nav">Каталог</a>
					<a href="../index.html#about" class="header__nav">О нас</a>
					<a href="../index.html#contacts" class="header__nav">Контакты</a>
					<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="signout.php" class="header__nav">Выйти</a>'; else
					echo '<a href="signin.php" class="header__nav">Войти</a>'; ?>
				</nav>
				<div class="header__burger">
					<span></span>
				</div>
			</header>
			<nav class="drawer">
				<div class="drawer__inner">
					<div class="drawer__navs">
						<a href="../index.html" class="drawer__nav">Главная</a>
						<a href="../index.html#about" class="drawer__nav">О нас</a>
						<a href="../index.html#contacts" class="drawer__nav">Контакты</a>
						<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="signout.php" class="drawer__nav">Выйти</a>'; else
					echo '<a href="signin.php" class="drawer__nav">Войти</a>'; ?>
					</div>
				</div> 
			</nav>
		</div>
		<div class="sign-in">
			<div class="container">
				<div class="sign-in__title">Авторизация</div>
				<div class="sign-in__inner">
					<form action="" method="POST" class="sign-in__form">
						<input type="email" class="sign-in__input" required name="email" placeholder="E-mail">
						<input type="password" class="sign-in__input" required name="pass" placeholder="Пароль">
						<input type="submit" class="sign-in__button" name="submit" value="Авторизироваться">
					</form>
					<p class="sign-in__message">У вас еще нет аккаунта? <a href="signup.php" class="sign-in__link">Зарегистрируйтесь</a></p>
					<?php
					if(!empty($errors)){ echo '<div class="sign-in__message">' .array_shift($errors). '</div></hr>';} ?>
				</div>
			</div>
		</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
</body>
</html>
