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
		mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); 
		if($sql = mysqli_query($link, "SELECT * FROM productcategory;")){?>
			<a href="addproduct.php" target="admin__iframe" class="admin__link admin__add">Добавить товар</a>
			<?php
			echo "<div class='admin__table'>
					<div class='admin__names-col'>
						<p class='admin__name-col'>ID</p>
						<p class='admin__name-col'>Название</p>
						<p class='admin__name-col'>Описание</p>
						<p class='admin__name-col'>Цена</p>
						<p class='admin__name-col'>Категория</p>
						<p class='admin__name-col'>Скидка</p>
						<p class='admin__name-col'>Действия</p>
					</div> ";
					$num_rows = mysqli_num_rows($sql);
					for ($i=0; $i < $num_rows; $i++) { 
						while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
							echo "<div class='admin__row' id='".$row[ID_Product]."'><div class='admin__cell'>".$row[ID_Product]."</div>";
							echo "<div class='admin__cell'>".$row[PrName]."</div>";
							echo "<div class='admin__cell admin__desc'>".$row[ShortDesc]."</div>";
							echo "<div class='admin__cell'>".$row[PricePerOne]."</div>";
							echo "<div class='admin__cell'>".$row[CatName]."</div>";
							echo "<div class='admin__cell'>".$row[Discount]."</div>";
							echo "<div class='admin__do'>
							<a href='editproduct.php?id=".$row[ID_Product]."' class='admin__link'>Изменить</a>
							<a href='deleteproduct.php?delete=".$row[ID_Product]."' class='admin__link'>Удалить</a>
						</div></div>"; }}
				echo "</div>"; } else{
			echo '<p class="admin__message">В данной таблице нет записей либо таблица не найдена.</p>'; } ?>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php mysqli_close($link); ?>
</body>
</html>

