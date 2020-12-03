<?php 

	$adresserver='localhost';
	$nameuser='root';
	$password='root';
	$link=mysqli_connect($adresserver, $nameuser, $password) or die('Ошибка'.mysql_error($link));
 ?>