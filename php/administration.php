<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";}
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Администрирование</title>
	<link rel="shortcut icon" href="../img/icon.png" type="image/png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=7">
	<link rel="stylesheet" href="../css/adaptive.css?v=7">
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
			<div class="admin">
				<div class="admin__title">Администрирование</div>
				<div class="admin__inner">
					<ul class="admin__options">
						<li class="admin__option"><a href="showproducts.php" class="admin__link" target="admin__iframe">Товары</a></li>
						<li class="admin__option"><a href="showcategories.php" class="admin__link" target="admin__iframe">Категории</a></li>
						<li class="admin__option"><a href="showsuppliers.php" class="admin__link" target="admin__iframe">Поставщики</a></li>
						<li class="admin__option"><a href="showdeliveries.php" class="admin__link" target="admin__iframe">Поставки</a></li>
						<li class="admin__option"><a href="showstock.php" class="admin__link" target="admin__iframe">Склад</a></li>
						<li class="admin__option"><a href="" class="admin__link" target="admin__iframe">Клиенты</a></li>
					</ul>
					<div class="admin__page">
						<iframe src="showtable.php" frameborder="0" class="admin__iframe" name="admin__iframe">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>