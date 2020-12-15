<?php session_start(); 
if(!isset($_SESSION['user']) || $_SESSION['user'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('cart.php');</script>";}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Оформление заказа</title>
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
					<a href="cart.php" class="header__nav">Корзина</a>
					<a href="signout.php" class="header__nav">Выйти</a>
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
						<a href="cart.php" class="drawer__nav">Корзина</a>
						<a href="signout.php" class="drawer__nav">Выйти</a>
					</div>
				</div> 
			</nav>
			<div class="order">
				<?php
					require 'Connection.php';
					mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.');
					$id = $_SESSION['id_client'];
				 ?>
				<div class="order__inner">
				<div class="order__title">Оформление заказа</div>
				<p class="order__message">В настоящий момент возможен только самовывоз из нашего магзина. Служба доставки временно не работает. Приносим извинения за причененные неудобства.</p>

				</div>
			</div>
		</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>