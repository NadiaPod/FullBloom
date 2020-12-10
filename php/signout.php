<?php
  session_start();
if(isset($_SESSION['user'])){
		unset($_SESSION['user']);
}	else {
	if(isset($_SESSION['admin'])){
		unset($_SESSION['admin']);
	}
}
	echo "<script>location.replace('../index.php');</script>";
?>