<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация нового пользователя</title>
	<link rel="shortcut icon" href="../img/icon.png" type="image/png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css?v=5">
	<link rel="stylesheet" href="../css/adaptive.css?v=5">
</head>
<body>
	<div class="layout">
		<div class="container">
			<header class="header">
				<a href="../index.html" class="header__logo"><span>Full</span>Bloom</a>
				<nav class="header__navs">
					<a href="../index.html" class="header__nav">Главная</a>
					<a href="catalog.php" class="header__nav">Каталог</a>
					<a href="../index.html#about" class="header__nav">О нас</a>
					<a href="../index.html#contacts" class="header__nav">Контакты</a>
					<a href="#" class="header__nav">Войти</a>
				</nav>
				<div class="header__burger">
					<span></span>
				</div>
			</header>
			<nav class="drawer">
				<div class="drawer__inner">
					<div class="drawer__navs">
						<a href="../index.html" class="drawer__nav">Главная</a>
						<a href="../index.html#about" class="drawer__nav">О нас</a>
						<a href="../index.html#contacts" class="drawer__nav">Контакты</a>
						<a href="#" class="drawer__nav">Войти</a>
					</div>
				</div> 
			</nav>
		</div>
			<div class="sign-up">
				<div class="container">
					<div class="sign-up__title">Регистрация</div>
					<div class="sign-up__inner">
						<div class="sign-up__advantages"></div>
						<form action="" method="POST" class="sign-up__form">
							<input type="email" class="sign-up__input" placeholder="E-mail" required>
							<input type="password" class="sign-up__input" placeholder="Пароль" required>
							<input type="text" class="sign-up__input" placeholder="Фамилия" required>
							<input type="text" class="sign-up__input"
							placeholder="Имя" required>
							<input type="text" class="sign-up__input"
							placeholder="Отчество">
							<input type="text" class="sign-up__input"
							placeholder="Адрес" required>
							<input type="phone" class="sign-up__input"
							placeholder="Номер телефона" required>
							<input type="submit" value="Зарегистрироваться" class="sign-up__button">
						</form>
					</div>
				</div>
			</div>
	</div>
<script src="../js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
</body>
</html>