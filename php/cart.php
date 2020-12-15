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
							$products = array();
							$kolvo = array();
							$howMuch = 0;
							mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.'); 
							$temp=$_SESSION['cart'];
							foreach($temp as $id=>$kol){
								$products[] = $id;
								$howMuch = $howMuch + 1;
								$posts = mysqli_query($link, "SELECT * FROM products WHERE ID_Product=".$id);
								$num_rows = mysqli_num_rows($posts);
								for ($i=0; $i < $num_rows; $i++) { 
									while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
										$name = $row[Name];
										$img = $row[Img];
										$PricePerOne = $row[PricePerOne];
										$PriceForAll = $PricePerOne * $kol;
										$total = $total + $PriceForAll;
										$kolvo[] =  $kol;
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
							echo "<p class='cart__total-price'>Общая стоимость: <span>".$total."</span></p></div>";
						 if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true)
						echo "<button id='order' class='cart__button'>Оформить заказ</button>";
						}
					?> 
				</div> 
			</div>	
			<div class="order">
				<?php $id = $_SESSION['id_client']; 
				$client =  mysqli_query($link, "SELECT * FROM clients WHERE ID_Client=".$id);
					$num_rows = mysqli_num_rows($client);
					for ($i=0; $i < $num_rows; $i++) { 
						while ($row = mysqli_fetch_array($client, MYSQLI_ASSOC)) {
							$email = $row[Email];
							$LN = $row[LastName];
							$FN = $row[FirstName];
							$SN = $row[SecondName];
							$address = $row[ClientAddress];
							$phone = $row[ClientPhone];				
						}}
							?>
				<div class="order__inner">
					<div class="order__title">Оформление заказа</div>
					<p class="order__message">Служба доставки временно не работает. В настоящий момент возможен только самовывоз из нашего магзина. Приносим извинения за причененные неудобства.</p>
					<p class="order__message">Пожалуйста, проверьте правильность данных перед оформлением заказа! <span>Если в данных ошибка, исправить её можно в <a href="" class="order__link">личном кабинете</a>.</span></p>
					<form method="POST" class="order__form">
					<input type="email" value="<?php echo $email; ?>" class="order__input" placeholder="E-mail" required name="email" readonly>
					<input type="text" value="<?php echo $LN; ?>" class="order__input" placeholder="Фамилия" required name="lName" readonly>
					<input type="text" class="order__input" name="fName" placeholder="Имя" value="<?php echo $FN; ?>" required readonly>
					<input type="text" class="order__input" name="sName" placeholder="Отчество" value="<?php echo $SN; ?>" readonly>
					<input type="text" class="order__input" name="address" value="<?php echo $address; ?>" placeholder="Адрес" required readonly>
					<input type="phone" value="<?php echo $phone; ?>" class="order__input" name="phone" placeholder="Номер телефона" required readonly>
					<input type="submit" value="Все верно, оформить заказ!" class="order__button" name="submit">
					<?php
						if(isset($_POST['submit'])){
							$flag = true;
						for ($i=0; $i < $howMuch; $i++) { 
							$z = mysqli_query($link, "SELECT * FROM stock WHERE ID_Product=".$products[$i]);
							$p =  mysqli_query($link, "SELECT Name FROM products WHERE ID_Product=".$products[$i]);
							while ($row = mysqli_fetch_array($p, MYSQLI_ASSOC)) {
								$prName = $row[Name];
							}
							while ($row = mysqli_fetch_array($z, MYSQLI_ASSOC)) {
								if($row[AmountInStock] < $kolvo[$i]){
									$flag = false;
									echo "<script>alert('".$prName." отсутствует в указанном количестве на складе. Пожалуйста, попробуйте выбрать другое количество.');</script>";
									}
								}
						}
						if($flag == true && mysqli_query($link, "INSERT INTO orders(ID_Client, Summ, OrderDate) VALUES (".$_SESSION['id_client'].", ".$total.", CURDATE());")){
							$temp=$_SESSION['cart'];
							$sql = mysqli_query($link, "SELECT ID_Order FROM orders ORDER BY ID_ORDER DESC LIMIT 1;");
						while ($orderN = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
							$NumOrder = $orderN['ID_Order']; }
							foreach($temp as $id=>$kol){
								if(mysqli_query($link, "INSERT INTO `orderDetails`(ID_Order, ID_Product, quantity) VALUES(".$NumOrder.", ".$id.", ".$kol.");")){ $f = true; } else{ $f = false; }
								}
							}
							if($f==true){
								unset($_SESSION['cart']);				
							}
						} 
					?>
					</form>
					<button class="order__button" id="back">Отмена</button>
				</div>
			</div>
		</div>
		</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>