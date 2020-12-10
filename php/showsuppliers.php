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
		mysqli_select_db($link, 'u25984nb_flower'); 
		if($sql = mysqli_query($link, "SELECT * FROM suppliers;")){?>
			<a href="addsupplier.php" target="admin__iframe" class="admin__link admin__add">Добавить поставщика</a>
			<?php
			echo "<div class='admin__table'>
					<div class='admin__names-col'>
						<p class='admin__name-col'>ID</p>
						<p class='admin__name-col'>Компания</p>
						<p class='admin__name-col'>Телефон</p>
						<p class='admin__name-col'>Контактное лицо</p>
						<p class='admin__name-col'>Город</p>
						<p class='admin__name-col'>Адрес</p>
						<p class='admin__name-col'>Действия</p>
					</div> ";
					$num_rows = mysqli_num_rows($sql);
					for ($i=0; $i < $num_rows; $i++) { 
						while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
							echo "<div class='admin__row' id='".$row[ID_Supplier]."'><div class='admin__cell'>".$row[ID_Supplier]."</div>";
							echo "<div class='admin__cell'>".$row[CompanyName]."</div>";
							echo "<div class='admin__cell admin__desc'>".$row[SupplierPhone]."</div>";
							echo "<div class='admin__cell'>".$row[ContactName]."</div>";
							echo "<div class='admin__cell'>".$row[City]."</div>";
							echo "<div class='admin__cell'>".$row[SupplierAddress]."</div>";
							echo "<div class='admin__do'>
							<a href='editsupplier.php?id=".$row[ID_Supplier]."' class='admin__link'>Изменить</a>
							<a href='deletesupplier.php?delete=".$row[ID_Supplier]."' class='admin__link'>Удалить</a>
						</div></div>";}}
				echo "</div>";} else{
			echo '<p class="admin__message">В данной таблице нет записей либо таблица не найдена.</p>'; } ?>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php mysqli_close($link); ?>
</body>
</html>