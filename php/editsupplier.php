<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";}
 ?>
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
<?php 
	require 'Connection.php';
	mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.');
	if(empty($_GET[id]) || $_GET[id] < 1) $_GET[id] = 1; 
	$posts = mysqli_query($link, "SELECT * FROM `suppliers` WHERE ID_Supplier =".$_GET[id].";");	
	$num_rows = mysqli_num_rows($posts);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
			$SupId = $row[ID_Supplier];
			$name = $row[CompanyName];
			$phone = $row[SupplierPhone];
			$contact = $row[ContactName];
			$City = $row[City];
			$address = $row[SupplierAddress]; }}; ?>
	<div class="layout">
		<div class="container">
			<div class="edit">
				<div class="edit__title">Изменить поставщика</div>
				<form method="POST" class="edit__form">
					<input type="text" name="name" class="edit__input" value="<?php echo $name; ?>">
					<input type="text" placeholder="Номер телефона" class="addition__input" name="phone" value="<?php echo $phone; ?>">
					<input type="text" placeholder="Контактное лицо" class="addition__input" name="contact" value="<?php echo $contact; ?>">
					<input type="text" placeholder="Город" class="addition__input" name="city" value="<?php echo $City; ?>">
					<input type="text" placeholder="Адрес" class="addition__input" name="address" value="<?php echo $address; ?>">
					<input type="submit" name="submit" class="edit__button" value="Изменить">
					<?php 
			if(isset($_POST['submit'])){ $errors = array();
			if($_POST['name']==''){
				$errors[] = 'Пожалуйста, введите название.';}
			if($_POST['phone']==''){
				$errors[] = 'Пожалуйста, введите номер телефона.';}
			if($_POST['city']==''){
				$errors[] = 'Пожалуйста, введите город.';}
			if($_POST['address']==''){
				$errors[] = 'Пожалуйста, введите адрес.';}
			if(empty($errors)){
			if(mysqli_query($link, "CALL UpdateSupplier(".$SupId.",'".$_POST[name]."', '".$_POST[phone]."', '".$_POST[contact]."', '".$_POST[city]."', '".$_POST[address]."');")){
				echo '<p class="edit__message">Запись успешно обновлена.</p>'; }} else {
			echo '<p class="edit__message">'.array_shift($errors).'</p>'; }} ?>
				</form>
				<a href="showsuppliers.php" class="edit__button edit__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>