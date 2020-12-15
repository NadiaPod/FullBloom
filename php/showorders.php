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
	mysqli_select_db($link, 'flowershop');
	echo "<div class='admin__table'>
			<div class='admin__names-col'>
				<p class='admin__name-col'>№</p>
				<p class='admin__name-col'>ID клиента</p>
				<p class='admin__name-col'>Имя</p>
				<p class='admin__name-col'>Телефон</p>
				<p class='admin__name-col'>Дата</p>
				<p class='admin__name-col'>Сумма</p>
				<p class='admin__name-col'>Товар</p>
				<p class='admin__name-col'>Кол-во</p>
			</div> ";
	if($sql = mysqli_query($link, "SELECT * FROM orderShow;")){
		$num_rows = mysqli_num_rows($sql);
		for ($i=0; $i < $num_rows; $i++) { 
			while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
				echo "<div class='admin__row' id='".$row[ID_O]."'><div class='admin__cell'>".$row[ID_O]."</div>";
				echo "<div class='admin__cell'>".$row[ID_Client]."</div>";
				echo "<div class='admin__cell'>".$row[FirstName]."</div>";
				echo "<div class='admin__cell'>".$row[ClientPhone]."</div>";
				echo "<div class='admin__cell admin__desc'>".$row[OrderDate]."</div>";
				echo "<div class='admin__cell'>".$row[Summ]."</div>";
				echo "<div class='admin__cell'>".$row[Name]."</div>";
				echo "<div class='admin__cell'>".$row[Quantity]."</div>";
				echo "<div class='admin__do'>
							<a href='editorder.php?id=".$row[ID_O]."' class='admin__link'>Изменить</a>
							<a href='deleteorder.php?delete=".$row[ID_O]."' class='admin__link'>Удалить</a>
						</div></div>";}}
				echo "</div>";
	}
?>	
</body>
</html>