<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";}
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавить товар</title>
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=7">
	<link rel="stylesheet" href="../css/adaptive.css?v=7">
</head>
<body>
	<div class="layout">
		<div class="container">
			<div class="addition">
				<div class="addition__title">Добавить новый товар</div>
				<form method="POST" class="addition__form" enctype='multipart/form-data'>
					<input type="text" placeholder="Название товара" class="addition__input" name="name">
					<textarea placeholder="Описание товара" class="addition__area" name='desc'></textarea>
					<p class="addition__label">Выберете категорию: 
					<?php require 'Connection.php';
						mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); 
						echo "<select class='addition__select' name='category'>";
						$p = mysqli_query($link, "SELECT * FROM category;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
							while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
							echo "<option class='adiition__option' value=".$row[ID_Category].">".$row[Name]."</option>";}}
							echo "</select>"; ?>
					</p>
					<label class="addition__label">Выбрать фото...
					<input name='photo' type="file" class="addition__input input-file" accept=" .jpg, .jpeg, .png"></label>
					<input type="submit" name='submit' value="Добавить" class="addition__button">
				</form>
				<a href="showproducts.php" class="addition__button addition__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['submit'])){
		$errors = array();
		if($_POST['name']==''){
			$errors[] = 'Пожалуйста, введите название.';
		}
		if($_POST['desc']==''){
			$errors[] = 'Пожалуйста, введите описание.';
		}
		if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
			$fileTmpPath = $_FILES['photo']['tmp_name'];
			$fileName = $_FILES['photo']['name'];
			$fileSize = $_FILES['photo']['size'];
			$fileType = $_FILES['photo']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			// $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
			$uploadFileDir = '../img/catalog/';
			$dest_path = $uploadFileDir . $fileName;
			if(!move_uploaded_file($fileTmpPath, $dest_path)){
			  $errors[] = 'Ошибка при загрузке фото.';}}
		if(empty($errors)){
			if(mysqli_query($link, "CALL AddProduct('".$_POST[name]."', '".$_POST[desc]."', 0, ".$_POST[category].", 0, '".$dest_path."');")){
				echo '<p class="addition__message">Запись успешно добавлена.</p>';}} else {
			echo '<p class="addition__message">'.array_shift($errors).'</p>';}}?>