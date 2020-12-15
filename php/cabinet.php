<?php session_start();
require 'Connection.php';
mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.'); 
	$id = $_SESSION['id_client']; 
	$client =  mysqli_query($link, "SELECT * FROM `clients` WHERE `ID_Client`=".$id.";");
	$num_rows = mysqli_num_rows($client);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($client, MYSQLI_ASSOC)) {
			$email = $row[Email];
			$pass = $row[Password];
			$LN = $row[LastName];
			$FN = $row[FirstName];
			$SN = $row[SecondName];
			$address = $row[ClientAddress];
			$phone = $row[ClientPhone];	}}	?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Личный кабинет</title>
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
						<a href="../index.php" class="drawer__nav">Главная</a>
						<a href="../index.php#about" class="drawer__nav">О нас</a>
						<a href="../index.php#contacts" class="drawer__nav">Контакты</a>
						<a href="cart.php" class="drawer__nav">Корзина</a>
						<a href="signout.php" class="drawer__nav">Выйти</a>
					</div>
				</div> 
			</nav>
			<div class="cabinet">
			<div class="cabinet__title">Здравствуйте, <?php echo $FN; ?></div>
			<div class="cabinet__inner">
				<form method="POST" class="cabinet__form">
					<p class="cabinet__subtitle">Изменение личных данных</p>
					<input type="email" value="<?php echo $email; ?>" class="cabinet__input" placeholder="E-mail" required name="email" >
					<input type="pass" placeholder="Смена пароля" title="Заполните это поле, если хотите сменить пароль, иначе — оставьте пустым." class="cabinet__input" name="pass">
					<input type="text" value="<?php echo $LN; ?>" class="cabinet__input" placeholder="Фамилия" required name="lName">
					<input type="text" class="cabinet__input" name="fName" placeholder="Имя" value="<?php echo $FN; ?>" required>
					<input type="text" class="cabinet__input" name="sName" placeholder="Отчество" value="<?php echo $SN; ?>">
					<input type="text" class="cabinet__input" name="address" value="<?php echo $address; ?>" placeholder="Адрес" required>
					<input type="tel" value="<?php echo $phone; ?>" class="cabinet__input" name="phone" placeholder="Номер телефона" required pattern="[\+][0-9]{12}">
					<input type="submit" value="Изменить" class="cabinet__button" name="submit">
					<?php
						if(isset($_POST['submit'])){ 
							$email = $_POST[email];
							if($_POST[pass] != "") 
								$pass=$_POST[pass];
							$LN = $_POST[lName];
							$FN = $_POST[fName];
							$SN = $_POST[sName];
							$address = $_POST[address];
							$phone = $_POST[phone];
							if(mysqli_query($link, "CALL UpdateClient(".$id.", '".$email."', '".$pass."', 0, '".$LN."', '".$FN."', '".$SN."', '".$address."', '".$phone."');")){
								echo '<p class="cabinet__message">Ваши данные успешно обновлены!</p>';} else {
								echo '<p class="cabinet__message">Возникла ошибка: '.mysqli_error($link).'.</p>'; }
						}
					?>
				</form>
				<div class="cabinet__orders">
					<p class="cabinet__subtitle">Ваши заказы</p>
					<?php 
						echo "<div class='cabinet__table'>
								<div class='cabinet__names-col'>
									<p class='cabinet__name-col'>№ заказа</p>
									<p class='cabinet__name-col'>Дата</p><p class='cabinet__name-col'>Товар</p>
									<p class='cabinet__name-col'>Количество</p>
									<p class='cabinet__name-col'>Сумма</p></div>";
						$sql =  mysqli_query($link, "SELECT * FROM `orderShow` WHERE `ID_Client`=".$id.";");
						$num_rows = mysqli_num_rows($sql);
						for ($i=0; $i < $num_rows; $i++) { 
							while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
								echo "<div class='cabinet__row'><div class='admin__cell'>".$row[ID_O]."</div><div class='cabinet__cell'>".$row[OrderDate]."</div><div class='cabinet__cell'>".$row[Name]."</div><div class='cabinet__cell'>".$row[Quantity]."</div><div class='cabinet__cell'>".$row[Summ]."</div></div>";
							}}	?>
				</div>
				<form method="POST" action="excel.php">
					<input type="submit" name="ex" value="В Excel" class="cabinet__button">
				</form>
	</div>
	</div>
	</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>