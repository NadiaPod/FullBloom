<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";} 
	require 'Connection.php';
	mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); ?>
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
				<div class="addition__title">Добавить новую поставку</div>
				<form method="POST" class="addition__form">
					<p class="addition__label">Выберете товар:
					<?php echo "<select class='addition__select' name='ID_Product'>";
						$p = mysqli_query($link, "SELECT * FROM products;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
							while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
							echo "<option class='adiition__option' value=".$row[ID_Product].">".$row[Name]."</option>";}}
							echo "</select>"; ?>
					</p>
					<p class="addition__label">Выберете поставщика:
					<?php echo "<select class='addition__select' name='ID_Supplier'>";
						$p = mysqli_query($link, "SELECT * FROM suppliers;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
							while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
							echo "<option class='adiition__option' value=".$row[ID_Supplier].">".$row[CompanyName]."</option>";}}
							echo "</select>"; ?>
					</p>
					<input type="number" class="addition__input" name="Price" min="1" step="0.01" placeholder="Цена поставщика">
					<input type="number" class="addition__input"  name="Amount" min="1" placeholder="Количество">
					<input type="submit" name='submit' value="Добавить" class="addition__button">
				</form>
				<a href="showdeliveries.php" class="addition__button addition__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php if(isset($_POST['submit'])){
		$errors = array();
		if(empty($errors)){
			if(mysqli_query($link, "CALL AddDelivery(".$_POST[ID_Product].", ".$_POST[ID_Supplier].", ".$_POST[Price].", ".$_POST[Amount].");")){
				echo '<p class="addition__message">Запись успешно добавлена.</p>';}} else {
			echo '<p class="addition__message">'.array_shift($errors).'</p>';}} ?>