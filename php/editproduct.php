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
	mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.');
	if(empty($_GET[id]) || $_GET[id] < 1) $_GET[id] = 1; 
	$posts = mysqli_query($link, "SELECT * FROM productcategory WHERE ID_Product =".$_GET[id].";");	
	$num_rows = mysqli_num_rows($posts);
	for ($i=0; $i < $num_rows; $i++) { 
		while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
			$productId = $row[ID_Product];
			$name = $row[PrName];
			$desc = $row[ShortDesc];
			$price = $row[PricePerOne];
			$categoryId = $row[ID_Cat];
			$category = $row[CatName];
			$discount = $row[Discount];
			$image = $row[Img];
		 }  }; ?>
	<div class="layout">
		<div class="container">
			<div class="edit">
				<div class="edit__title">Изменить товар</div>
				<form method="POST" class="edit__form" enctype="multipart/form-data">
					<input type="text" name="name" class="edit__input" value="<?php echo $name; ?>">
					<textarea name="desc" class="edit__area"><?php
					echo $desc; ?></textarea>
					<input type="number" class="edit__input" value="<?php echo $price; ?>" name="price" min="1" step="0.01">
					<input type="number" value="<?php echo $discount; ?>" class="edit__input" name="discount" min="0" max="1" step="0.1">
					<p class="addition__label">Выберете категорию:
					<?php echo "<select class='edit__select' name='category'>";
						$p = mysqli_query($link, "SELECT * FROM category;");
						$num_rows = mysqli_num_rows($p);
						for ($i=0;$i<$num_rows;$i++){
						while ($row=mysqli_fetch_array($p, MYSQLI_ASSOC)){
							if($categoryId == $row[ID_Category]){
							echo "<option class='edit__option' selected value=".$row[ID_Category].">".$row[Name]."</option>"; } else{
							echo "<option class='edit__option' value=".$row[ID_Category].">".$row[Name]."</option>";}}}
							echo "</select>"; ?> </p>
					<label class="edit__label"> Выбрать фото...
						<input type="file" name="photo" class="edit__input edit__input--file" accept=" .jpg, .jpeg, .png">
					</label>
					<input type="submit" name="submit" class="edit__button" value="Изменить">
					<?php 
			if(isset($_POST['submit'])){ $errors = array();
			if($_POST['name']==''){
					$errors[] = 'Пожалуйста, введите название.';
							}
			if($_POST['desc']==''){
					$errors[] = 'Пожалуйста, введите описание.';
							}
			if((float)$_POST['discount']< 0 || (float)$_POST['discount'] > 1){
			$errors[] = 'Пожалуйста, введите корректную скидку.';
			}
			if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
			$fileTmpPath = $_FILES['photo']['tmp_name'];
			$fileName = $_FILES['photo']['name'];
			$fileSize = $_FILES['photo']['size'];
			$fileType = $_FILES['photo']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$uploadFileDir = '../img/catalog/';
			$dest_path = $uploadFileDir . $fileName;
			if(!move_uploaded_file($fileTmpPath, $dest_path)){
			  $errors[] = 'Ошибка при загрузке фото.';
			} } else { $dest_path = $image; }
			if(empty($errors)){
			if(mysqli_query($link, "CALL UpdateProduct(".$productId.",'".$_POST[name]."', '".$_POST[desc]."', ".$_POST[price].", ".$_POST[category].", ".$_POST[discount].",
			 '".$dest_path."');")){
				echo '<p class="edit__message">Запись успешно обновлена.</p>'; }} else {
			echo '<p class="edit__message">'.array_shift($errors).'</p>';	}}	?>
				</form>
				<a href="showproducts.php" class="edit__button edit__button--back">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>