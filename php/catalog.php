<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Каталог</title>
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
				<a href="../index.php#about" class="header__nav">О нас</a>
				<a href="../index.php#contacts" class="header__nav">Контакты</a>
				<a href="cart.php" class="header__nav">Корзина</a>
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
		</nav> <!-- u25984nb_flower -->
		<?php require 'Connection.php';
			  mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.'); 
			  if(empty($_GET[view_id]) || $_GET[view_id] < 1) $_GET[view_id] = 0; 
				if($_GET[view_id] != 0){
					$posts = mysqli_query($link, "SELECT * FROM `productcategory` WHERE ID_Cat =".$_GET[view_id].";");
				} 
				else {  $posts = mysqli_query($link, "SELECT * FROM `productcategory`"); } 
				 ?>
		<div class="filtration">
			<div class="filtration__categories">
				<a href="catalog.php" class="filtration__category">Все</a>
                <?php 
                	$selectCategory = mysqli_query($link, "SELECT * FROM `category`");
                	while($row = mysqli_fetch_array($selectCategory)){
                		echo "<a href='catalog.php?view_id=".$row[ID_Category]."' class='filtration__category'>".$row[Name]."</a>";
                	}
                ?>
			</div>
			<div class="filtration__filters">
				<form class="filtration__price" method="POST">
					<div class="filtration__title">Фильтр по цене:</div>
					<input class="filtration__input" type="text" placeholder="От" pattern="\d{1,5}+(\.\d{2})?" name="lowerPrice">
					<input class="filtration__input" type="text" placeholder="До" pattern="\d{1,5}+(\.\d{2})?" name="higherPrice">
					<input type="submit" class="filtration__button" id="priceFilter" name ="priceFilter" value="Применить">
				</form>
				<form class="filtration__search" method="POST">
					<input type="text" class="filtration__input filtration__input--big" placeholder="Поиск" id="searchInput" name="searchInput" autocomplete="off">
					<div class="filtration__search-result" id="searchResult"></div>
				</form>
			</div>
		</div>			
		<div class="products">		
<?php  
	if(!empty($_POST['lowerPrice']) && !empty($_POST['higherPrice']) && isset($_POST['priceFilter'])){
			$lowerPrice = $_POST['lowerPrice'];
			$higherPrice = $_POST['higherPrice'];
			$posts = mysqli_query($link, "CALL priceFilter(".$lowerPrice.", ".$higherPrice.", ".$_GET[view_id].");");}
	$num_rows = mysqli_num_rows($posts);
	 for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
		echo "<div class='products__product' id=".$row[ID_Product].">";
			echo "<div class='products__img-wrapper'><img class='products__img' src='$row[Img]'></div>";
			echo "<a href='viewProduct.php?id=".$row[ID_Product]."' class='products__name'>".$row[PrName]."</a>";
			echo "<p class='products__price'>".$row[PricePerOne]." руб.</p>";
			if($row[Discount]>0){
				$discountShown = $row[Discount]*100;
			echo "<p class='products__discount'>Скидка: ".$discountShown."%</p>"; }
			echo "<div class='products__buttons'><button class='products__button products__button--buy' id='".$row[ID_Product]."'>В корзину</button>";
			echo "<a href='viewProduct.php?id=".$row[ID_Product]."' class='products__button'>Подробнее</a></div>";
		echo "</div>"; }}; ?>
		</div>
	</div>
		<footer class="footer">
			<div class="container">
				<div class="footer__inner">
					<div class="footer__info">
						<a href="index.php" class="footer__logo"><span>Full</span>Bloom</a>
						<p class="footer__rights">ⓒ FullBloom, 2020</p>
					</div>
					<nav class="footer__navs">
						<a href="../index.php" class="footer__nav">Главная</a>
						<a href="../index.php#about" class="footer__nav"> О нас</a>
						<a href="../index.php#contacts" class="footer__nav">Контакты</a>
						<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="signout.php" class="footer__nav">Выйти</a>'; else
					echo '<a href="signin.php" class="footer__nav">Войти</a>'; ?>
					</nav>
					<div class="footer__social">
						<a class="footer__link" href="https://web.facebook.com/nadia.smagin"><img src="../img/footer/001-facebook.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://www.youtube.com/watch?v=aDeNQNtW1f8&ab_channel=BenPlatt"><img src="../img/footer/002-youtube.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://www.instagram.com/nadiasm__/"><img src="../img/footer/005-instagram.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://twitter.com/thegoodfornoth1"><img src="../img/footer/007-twitter.svg" alt="" class="footer__img"></a>
					</div>
				</div>
			</div>
		</footer>
</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
</body>
</html>

