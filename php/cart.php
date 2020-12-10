<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Корзина</title>
	<link rel="shortcut icon" href="../img/icon.png" type="image/png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=6">
	<link rel="stylesheet" href="../css/adaptive.css?v=6">
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
			<div class="cart">
				<div class="cart__items">
					<?php 
							$total = 0;
							$countProducts = 0;
						if (!isset($_SESSION['cart'])){
							echo "<p class='cart__message'>Ваша корзина пуста. <a class='cart__link' href='catalog.php'>Отправиться за покупками</a></p>";
						} else {
							require 'Connection.php';
							mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); 
							$temp=$_SESSION['cart'];
							foreach($temp as $id=>$kol){
								$posts = mysqli_query($link, "SELECT * FROM products WHERE ID_Product=".$id);
								$num_rows = mysqli_num_rows($posts);
								for ($i=0; $i < $num_rows; $i++) { 
									while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
										$name = $row[Name];
										$img = $row[Img];
										$PricePerOne = $row[PricePerOne];
										$PriceForAll = $PricePerOne * $kol;
										$total = $total + $PriceForAll;
								}}
							echo "<div class='cart__item' id='".$id."'>
									<img src='".$img."'  class='cart__item-image'>
									<a href='viewProduct.php?id=".$id."' class='cart__item-name'>".$name."</a>
									<label class='cart__label'>Количество:</label>
									<input type='number' class='cart__item-quantity' value='".$kol."'>
									<p class='cart__item-price'> Цена:<span>".$PricePerOne."</span></p>
									
									<p class='cart__item-price cart__item-price--all'> Сумма:<span>".$PriceForAll."</span></p>			
									<img src='../img/cart/x-button.svg' class='cart__item-button' title='Удалить товар из корзины'>
							</div>"; 
							$countProducts = $countProducts + $kol;}
							echo "</div><div class='cart__header'><div class='cart__total'><p class='cart__total-quantity'>Товаров в корзине: ".$countProducts."</p> ";
							echo "<p class='cart__total-price'>Общая стоимость: <span>".$total."</span></p></div>
						<a href='order.php' class='cart__button'>Оформить заказ</button></a>";
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