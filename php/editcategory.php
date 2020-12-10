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
	if(empty($_GET[id]) || $_GET[id] < 1) $_GET[id] = 1; 
	$posts = mysqli_query($link, "SELECT * FROM category WHERE ID_Category =".$_GET[id].";");	
	$num_rows = mysqli_num_rows($posts);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
			$categoryId = $row[ID_Category];
			$category = $row[Name];
		 }  }; ?>
	<div class="layout">
		<div class="container">
			<div class="edit">
				<div class="edit__title">Изменить категорию</div>
				<form method="POST" class="edit__form">
					<input type="text" name="name" class="edit__input" value="<?php echo $category; ?>">
					<input type="submit" name="submit" class="edit__button" value="Изменить">
					<?php 
			if(isset($_POST['submit'])){ $errors = array();
			if($_POST['name']==''){
					$errors[] = 'Пожалуйста, введите название.';
							}
			if(empty($errors)){
			if(mysqli_query($link, "CALL UpdateCategory(".$categoryId.",'".$_POST[name]."');")){
				echo '<p class="edit__message">Запись успешно обновлена.</p>'; }} else {
			echo '<p class="edit__message">'.array_shift($errors).'</p>';	}}	?>
				</form>
				<a href="showcategories.php" class="edit__button edit__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>