<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";}
 ?>
<!DOCTYPE html>
<html lang="en">
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
				<div class="addition__title">Добавить новую категорию</div>
				<form method="POST" class="addition__form">
					<input type="text" placeholder="Название категории" class="addition__input" name="name">
					<input type="submit" name='submit' value="Добавить" class="addition__button">
				</form>
				<a href="showcategories.php" class="addition__button addition__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php
require 'Connection.php';
		mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); 
	if(isset($_POST['submit'])){
		$errors = array();
		if($_POST['name']==''){
			$errors[] = 'Пожалуйста, введите название.';
		}
		if(empty($errors)){
			if(mysqli_query($link, "CALL AddCategory('".$_POST[name]."');")){
				echo '<p class="addition__message">Запись успешно добавлена.</p>';
			}
		} else {
			echo '<p class="addition__message">'.array_shift($errors).'</p>';
		}
	}
?>