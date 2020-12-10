<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";}?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=7">
	<link rel="stylesheet" href="../css/adaptive.css?v=7">
</head>
<body>
<div class="layout">
		<div class="container">
			<div class="addition">
				<div class="addition__title">Добавить нового поставщика</div>
				<form method="POST" class="addition__form">
					<input type="text" placeholder="Название компании" class="addition__input" name="name">
					<input type="text" placeholder="Номер телефона" class="addition__input" name="phone">
					<input type="text" placeholder="Контактное лицо" class="addition__input" name="contact">
					<input type="text" placeholder="Город" class="addition__input" name="city">
					<input type="text" placeholder="Адрес" class="addition__input" name="address">
					<input type="submit" name='submit' value="Добавить" class="addition__button">
				</form>
				<a href="showsuppliers.php" class="addition__button addition__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php require 'Connection.php';
		mysqli_select_db($link, 'u25984nb_flower');
if(isset($_POST['submit'])){
		$errors = array();
		if($_POST['name']==''){
			$errors[] = 'Пожалуйста, введите название.';
		}
		if($_POST['phone']==''){
			$errors[] = 'Пожалуйста, введите номер телефона.';
		}
		if($_POST['city']==''){
			$errors[] = 'Пожалуйста, введите город.';
		}
		if($_POST['address']==''){
			$errors[] = 'Пожалуйста, введите адрес.';
		}
		if(empty($errors)){
		if(mysqli_query($link, "CALL AddSupplier('".$_POST[name]."', '".$_POST[phone]."', '".$_POST[contact]."',  '".$_POST[city]."', '".$_POST[address]."');")){
				echo '<p class="addition__message">Запись успешно добавлена.</p>'; }} else {
			echo '<p class="addition__message">'.array_shift($errors).'</p>';} } mysqli_close($link); ?>