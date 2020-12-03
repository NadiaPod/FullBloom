<?php 

$to = "nadiapodkovyrova@gmail.com"; 
$from = $_POST['email']; 
$first_name = $_POST['name']; 
$subject = "Сообщение пользователя FullBloom"; 
$message = $first_name . " прислал(а) письмо:" . "\n\n" . $_POST['message'] . "\n\n" . " Обратная связь: " . "\n" . $from; 
mail($to, $subject, $message, $from); 
echo "Ваше сообщение отправлено.";
echo "<script>location.replace('../index.html#contacts');</script>";
?>