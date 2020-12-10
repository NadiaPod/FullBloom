<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";} ?>
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
<?php require 'Connection.php';
	mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.');
	if(empty($_GET[id]) || $_GET[id] < 1) $_GET[id] = 1; 
	$posts = mysqli_query($link, "SELECT * FROM deliveries WHERE ID_Delivery =".$_GET[id].";");	
	$num_rows = mysqli_num_rows($posts);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
			$ID = $row[ID_Delivery];
			$productId = $row[ID_Product];
			$supID = $row[ID_Supplier];
			$desc = $row[ShortDesc];
			$price = $row[SupplierPricePerOne];
			$amount = $row[AmountDelivered];}}; ?>
	<div class="layout">
		<div class="container">
			<div class="edit">
				<div class="edit__title">Изменить поставку</div>
				<form method="POST" class="edit__form">
					<p class="edit__label">Выберете товар:
					<?php echo "<select class='edit__select' name='ID_Product'>";
						$p = mysqli_query($link, "SELECT * FROM products;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
							while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
								if($row[ID_Product] == $productId) echo "<option selected class='edit__option' value=".$row[ID_Product].">".$row[Name]."</option>"; else
							echo "<option class='edit__option' value=".$row[ID_Product].">".$row[Name]."</option>";}}
							echo "</select>"; ?>
					</p>
					<p class="edit__label">Выберете поставщика:
					<?php echo "<select class='edit__select' name='ID_Supplier'>";
						$p = mysqli_query($link, "SELECT * FROM suppliers;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
							while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
								if($supID == $row[ID_Supplier])
								echo "<option selected class='edit__option' value=".$row[ID_Supplier].">".$row[CompanyName]."</option>"; else
							echo "<option class='edit__option' value=".$row[ID_Supplier].">".$row[CompanyName]."</option>";}}
							echo "</select>"; ?>
					</p>
					<input type="number" class="edit__input" name="Price" min="1" step="0.01" placeholder="Цена поставщика" value="<?php echo $price; ?>">
					<input type="number" class="edit__input"  name="Amount" min="1" placeholder="Количество" value="<?php echo $amount; ?>">
					<input type="submit" name="submit" class="edit__button" value="Изменить">
					<?php 
			if(isset($_POST['submit'])){ $errors = array();
			if(empty($errors)){
			if(mysqli_query($link, "CALL UpdateDelivery(".$ID.", ".$_POST[ID_Product].",".$_POST[ID_Supplier].", ".$_POST[Price].", ".$_POST[Amount].");")){
				echo '<p class="edit__message">Запись успешно обновлена.</p>'; }} else {
			echo '<p class="edit__message">'.array_shift($errors).'</p>';	}}	?>
				</form>
				<a href="showdeliveries.php" class="edit__button edit__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>