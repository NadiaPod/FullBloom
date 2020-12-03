<?php 
	require 'Connection.php';
	mysqli_select_db($link, 'FlowerShop') or die('Невозможно подключиться к базе данных.'); 
	if(empty($_GET[id]) || $_GET[id] < 1) $_GET[id] = 1; 
	$posts = mysqli_query($link, "SELECT * FROM ProductCategory WHERE ID_Product =".$_GET[id].";");	
	$num_rows = mysqli_num_rows($posts);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
			$productId = $row[ID_Product];
			$name = $row[PrName];
			$desc = $row[ShortDesc];
			$price = $row[PricePerOne];
			$categoryId = $row[ID_Cat];
			$category = $row[CatName];
			$discount = $row[Discount];
			$discountShown = $discount*100;
			if($discount != 0){
				$oldPrice = $price *1/(1 - $discount);
			}
			$image = $row[Img];
		 }  
	};
	mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $name; ?></title>
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
					<a href="#" class="header__nav">Войти</a>
				</nav>
				<div class="header__burger">
					<span></span>
				</div>
			</header>
			<nav class="drawer">
				<div class="drawer__inner">
					<div class="drawer__navs">
						<a href="../index.html" class="drawer__nav">Главная</a>
						<a href="catalog.php" class="drawer__nav">Каталог</a>
						<a href="../index.html#about" class="drawer__nav">О нас</a>
						<a href="../index.html#contacts" class="drawer__nav">Контакты</a>
						<a href="#" class="drawer__nav">Войти</a>
					</div>
				</div>
			</nav>
			<div class="plant">
				<div class="plant__title"><?php echo $name; ?></div>
				<div class="plant__inner">
					<div class="plant__img-wrapper">
						<img src='<?php echo $image; ?>' alt="" class="plant__image">
					</div>
					<div class="plant__items">
						<p class="plant__item plant__item-price">
								<?php echo $price.' руб.'; ?>
						</p>
						<?php
							if(isset($oldPrice)){
								echo "<p class='plant__item plant__discount-info'>";
									echo "<span class='plant__old-price'>  $oldPrice руб.</span>";
									echo "<span class='plant__discount'> - $discountShown%</span></p>";
							}
						?>
						<p class="plant__item">
							<span class="plant__item-title">Описание:</span>
							<?php echo $desc; ?>
						</p>
						<p class="plant__item">
							<span class="plant__item-title">Категория:</span>
							<a class="plant__link" href='catalog.php?view_id=<?php echo $categoryId; ?>'><?php echo $category; ?></a>
						</p>
						<?php if($categoryId != 5 && $categoryId != 6) 
						echo "<p class='plant__item'>
							<span class='plant__item-title'>Комплектация:</span>
							Внимание! Цена товара указана без учета кашпо изображенного на фото. Приобрести кашпо вы можете в нашем магазине в <a href='catalog.php?view_id=6' class='plant__link'>соответствующей категории</a>.
						</p>"; ?>
						<button class="plant__button">В коризну</button>
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="footer__inner">
					<div class="footer__info">
						<a href="index.html" class="footer__logo"><span>Full</span>Bloom</a>
						<p class="footer__rights">ⓒ FullBloom, 2020</p>
						</div>
					<nav class="footer__navs">
						<a href="../index.html" class="footer__nav">Главная</a>
						<a href="catalog.php" class="footer__nav">Каталог</a>
						<a href="../index.html#about" class="footer__nav"> О нас</a>
						<a href="../index.html#contacts" class="footer__nav">Контакты</a>
						<a href="#" class="footer__nav">Войти</a>
					</nav>
					<div class="footer__social">
						<a class="footer__link" href="https://web.facebook.com/nadia.smagin"><img src="../img/footer/001-facebook.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://www.youtube.com/watch?v=aDeNQNtW1f8&ab_channel=BenPlatt"><img src="../img/footer/002-youtube.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://www.instagram.com/nadiasm__/"><img src="../img/footer/005-instagram.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://twitter.com/thegoodfornoth1"><img src="../img/footer/007-twitter.svg" alt="" class="footer__img"></a>
					</div>
				</div>
				<img src="img/footer/leaf.svg" alt="" class="footer__decoration">
			</div>
		</footer>
	</div>
<script src="../js/main.js"></script>
</body>
</html>