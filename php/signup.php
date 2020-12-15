<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация нового пользователя</title>
	<link rel="shortcut icon" href="../img/icon.png" type="image/png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=5">
	<link rel="stylesheet" href="../css/adaptive.css?v=5">
</head>
<body>
	<div class="layout">
		<div class="container">
			<header class="header">
				<a href="../index.php" class="header__logo"><span>Full</span>Bloom</a>
				<nav class="header__navs">
					<a href="../index.php" class="header__nav">Главная</a>
					<a href="catalog.php" class="header__nav">Каталог</a>
					<a href="../index.php#about" class="header__nav">О нас</a>
					<a href="../index.php#contacts" class="header__nav">Контакты</a>
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
						<a href="../index.php" class="drawer__nav">Главная</a>
						<a href="../index.php#about" class="drawer__nav">О нас</a>
						<a href="../index.php#contacts" class="drawer__nav">Контакты</a>
						<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="signout.php" class="drawer__nav">Выйти</a>'; else
					echo '<a href="signin.php" class="drawer__nav">Войти</a>'; ?>
					</div>
				</div> 
			</nav>
		</div>
			<div class="sign-up">
				<div class="container">
					<div class="sign-up__title">Регистрация</div>
					<div class="sign-up__inner">
						<!-- <div class="sign-up__advantages">
							<ul class="sign-up__items">
								<li class="sign-up__item">Становитесь частью семьи FullBloom</li>
								<li class="sign-up__item">Больше не нужно вводить данные при оформлении заказа</li>
								<li class="sign-up__item">Получайте информацию о наших акциях на электронную почту</li>
								<li class="sign-up__item">Возможность получить персонализированную карту гостя с кэшбеком до 10% от суммы заказа</li>
							</ul>
						</div> -->
						<form action="" method="POST" class="sign-up__form">
							<input type="email" class="sign-up__input" placeholder="E-mail" required name="email">
							<input type="password" class="sign-up__input" placeholder="Пароль" required name="pass" >
							<input type="text" class="sign-up__input" placeholder="Фамилия" required name="lName">
							<input type="text" class="sign-up__input" name="fName" 
							placeholder="Имя" required>
							<input type="text" class="sign-up__input" name="sName"
							placeholder="Отчество">
							<input type="text" class="sign-up__input" name="address"
							placeholder="Адрес" required>
							<input type="tel" class="sign-up__input" name="phone" pattern="[\+][0-9]{12}" 
							placeholder="Номер телефона" required>
							<input type="submit" value="Зарегистрироваться" class="sign-up__button" name="submit">
						</form>
						<p class="sign-up__message">У вас уже есть аккаунт? <a href="signin.php" class="sign-up__link">Войти</a></p>
						<?php 
	require 'Connection.php';
	mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); 
	$errors = array();
	if(isset($_POST['submit'])){
		if(trim($_POST['email']) == ''){
			$errors[] = 'Пожалуйста, введите email.';
		}
		if(trim($_POST['pass']) == ''){
			$errors[] = 'Пожалуйста, введите пароль.';
		}
		if(trim($_POST['lName']) == ''){
			$errors[] = 'Пожалуйста, введите фамилию.';
		}
		if(trim($_POST['fName']) == ''){
			$errors[] = 'Пожалуйста, введите имя.';
		}
		if(trim($_POST['address']) == ''){
			$errors[] = 'Пожалуйста, введите адрес.';
		}
		if(trim($_POST['phone']) == ''){
			$errors[] = 'Пожалуйста, введите номер телефона.';
		}
		if($sql = mysqli_query($link, "SELECT * FROM clients WHERE email='".$_POST['email']."';")){		
			$num_rows = mysqli_num_rows($sql);}
		if($num_rows > 0){
			$errors[] = 'Пользователь с таким e-mail уже существует.';
		} 
		if(empty($errors)){
			if(mysqli_query($link, "CALL AddClient('".$_POST['email']."', '".password_hash($_POST['pass'], PASSWORD_DEFAULT)."', 0, '".$_POST['lName']."', '".$_POST['fName']."', '".$_POST['sName']."', '".$_POST['address']."', '".$_POST['phone']."');")){
				echo '<p class="sign-up__message">Вы успешно зарегистрированы!</p>';
			}
			else{
				echo '<p class="sign-up__message">Ошибка при регистрации: '.mysqli_error($link).'</p>';
			}
		}
		else{
			echo '<p class="sign-up__message">'.array_shift($errors).'</p>';
		}
	}
?>
					</div>
				</div>
			</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
</body>
</html>