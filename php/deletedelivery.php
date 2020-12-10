<?php session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
	echo "<script>alert('У вас нет прав доступа на эту страницу!'); location.replace('../index.php');</script>";}
	if($_GET[id]=='ok'){
		require 'Connection.php';
		mysqli_select_db($link, 'u25984nb_flower') or die('Невозможно подключиться к базе данных.'); 
	if(mysqli_query($link, "CALL DeleteDelivery(".$_GET[delete].");")){
		echo 'Запись удалена.';
		echo "<script>location.replace('showdeliveries.php');</script>";
	} else {
		echo "Ошибка при удалении: ".mysqli_error($link);}
	mysqli_close($link);}
	else {
		echo "<script>
			var a=confirm('Записи из связанных таблиц также будут удалены. Продолжить?');
			if(a==true){
				location.replace('deletedelivery.php?id=ok&delete=".$_GET[delete]."');
			}
			else location.replace('showdeliveries.php');
		</script>";} ?>