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
	<?php require 'Connection.php';
	mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.');
	if(empty($_GET[id]) || $_GET[id] < 1) $_GET[id] = 1; 
	$posts = mysqli_query($link, "SELECT * FROM orders WHERE ID_Order =".$_GET[id].";");	
	$num_rows = mysqli_num_rows($posts);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
			$ID = $row[ID_Order];
			$clientId = $row[ID_Client];
			$date = $row[OrderDate];
			$summ = $row[Summ];}}; ?>
	<div class="layout">
		<div class="container">
			<div class="edit">
				<div class="edit__title">Изменить заказ</div>
				<form method="POST" class="edit__form">
					<p class="edit__label">Выберете клиента:
					<?php echo "<select class='edit__select' name='ID_Client'>";
						$p = mysqli_query($link, "SELECT * FROM clients;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
							while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
								if($row[ID_Client] == $clientId) echo "<option selected class='edit__option' value=".$row[ID_Client].">".$row[LastName]." ".$row[FirstName]."</option>"; else
							echo "<option class='edit__option' value=".$row[ID_Client].">".$row[LastName]." ".$row[FirstName]."</option>";}}
							echo "</select>"; ?>
					</p>
					<input type="date" class="edit__input" name="date" placeholder="Дата" value="<?php echo $date; ?>">
					<input type="number" class="edit__input" name="Price" min="1" step="0.01" placeholder="Сумма" value="<?php echo $summ; ?>">
					<input type="submit" name="submit" class="edit__button" value="Изменить">
					<?php 
			if(isset($_POST['submit'])){ $errors = array();
			if(empty($errors)){
			if(mysqli_query($link, "UPDATE orders SET ID_Client=".$_POST[ID_Client].", OrderDate='".$_POST[date]."', Summ=".$_POST[Price]." WHERE ID_Order=".$_GET[id].";")){
				echo '<p class="edit__message">Запись успешно обновлена.</p>'; }} else {
			echo '<p class="edit__message">'.array_shift($errors).'</p>';	}}	?>
				</form>
				<a href="showdeliveries.php" class="edit__button edit__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>