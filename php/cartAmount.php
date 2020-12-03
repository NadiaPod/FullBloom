<?php
$id = $_POST['id_product'];
$col = $_POST['quan_product'];
session_start(); 
$temp = $_SESSION['cart']; 
$temp[$id]=$col; 
$_SESSION['cart'] = $temp; 
echo $col;
?>