<?php
session_start();
$id = $_POST['id_product'];
$temp = $_SESSION['cart']; 
   if ($temp){
       unset ($temp[$id]); }
$_SESSION['cart'] = $temp; 
?>