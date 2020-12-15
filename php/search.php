<?php
 	require 'Connection.php';
 	mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.'); 
if (isset($_GET['search'])) {
    $Name = $_GET['search'];
    $Query = "CALL FindProductByName('".$Name."');";
    $ExecQuery = mysqli_query($link, $Query);
    while ($Result = mysqli_fetch_array($ExecQuery)) {
      echo "<a href='viewProduct.php?id=".$Result[ID_Product]."' class='filtration__link'>".$Result[Name]."</a>";}
}
?>