<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FullBloom — Цветочный магазин</title>
	<link rel="shortcut icon" href="../img/icon.png" type="image/png">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/swiper.min.css">
	<link rel="stylesheet" href="css/style.css?v=2">
	<link rel="stylesheet" href="css/adaptive.css?v=2">
</head>
<body>
	<div class="layout">
		<div class="container">
			<header class="header">
				<a href="index.php" class="header__logo"><span>Full</span>Bloom</a>
				<nav class="header__navs">
					<a href="php/catalog.php" class="header__nav">Каталог</a>
					<a href="#about" class="header__nav">О нас</a>
					<a href="#contacts" class="header__nav">Контакты</a>
					<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="php/signout.php" class="header__nav">Выйти</a>'; else
					echo '<a href="php/signin.php" class="header__nav">Войти</a>'; ?>
				</nav>
				<div class="header__burger">
					<span></span>
				</div>
			</header>
			<nav class="drawer">
				<div class="drawer__inner">
					<div class="drawer__navs">
						<a href="php/catalog.php" class="drawer__nav">Каталог</a>
						<a href="#about" class="drawer__nav">О нас</a>
						<a href="#contacts" class="drawer__nav">Контакты</a>
						<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="php/signout.php" class="drawer__nav">Выйти</a>'; else
					echo '<a href="php/signin.php" class="drawer__nav">Войти</a>'; ?>
					</div>
				</div>
			</nav>
		</div>
		<div class="swiper-container">
	    	<div class="swiper-wrapper">
	      		<div class="swiper-slide">
	      			<div class="slide__inner"> 
						<div class="intro__title">Создаем уют</div>
						<p class="intro__desc">
							Комнатные растения — прекрасный подарок как себе, так и близким людям. Они заметно оживляют интерьер и создают уютную обстановку в любой комнате.<br> Мы всегда готовы подобрать цветок, который подойдет именно вам!
						</p>
						<a href="php/catalog.php" class="intro__btn">Выбрать</a>
	      			</div>
	      		</div>
	      		<div class="swiper-slide">
	      			<div class="slide__inner"> 
						<div class="intro__title">Поможем в уходе</div>
						<p class="intro__desc">
							Вам подарили цветок, но вы не знаете, как за ним ухаживать? Ваше растение приболело, но вы не знаете чем?<br>
							Напишите нам! Наши специалисты всегда готовы рассказать как правильно ухаживать за вашим любимцем.
						</p>
						<a href="#contacts" class="intro__btn">Написать</a>
	      			</div>
	      		</div>
	     	 <div class="swiper-slide">
	     	 	<div class="slide__inner">
	     	 		<div class="intro__title">Лучший выбор</div>
	     	 		<p class="intro__desc">
	     	 			В нашем каталоге представлен самый широкий выбор домашних растений и кашпо для них. <span>Кроме того, вы также можете приобрести флорариумы — мини-сады, объединяющие несколько растений в одном террариуме.</span> <br>Вы сможете найти именно то, что искали, и по самым приятным ценам!
	     	 		</p>
	     	 		<a href="php/catalog.php" class="intro__btn">Выбрать</a>
	     	 	</div>
	     	 </div>
	    	</div>
	   		<div class="swiper-pagination"></div>
	  	</div>
	  	<div class="container">
		  	<div class="about">
		  		<a name="about"></a>
		  		<div class="about__info">
		  			<div class="about__title">Мы заботимся <br>о вашем <span>комфорте</span></div>
		  			<div class="about__desc">
		  				<p class="about__caption">Мы найдем индивидуальный подход к каждому покупателю: </p>
		  				<ul class="about__items">
			  				<li class="about__item">Поможем вам в выборе цветка или кашпо</li>
			  				<li class="about__item">Соберем ваш заказ в кратчайшие сроки</li>
			  				<li class="about__item">Упакуем вашу покупку как подарок</li>
			  				<li class="about__item">Объясним как укаживать за вашим новым членом семьи</li>
		  				</ul>
		  			</div>
		  		</div>
		  		<div class="about__steps">
		  			<div class="about__step">
		  				<div class="about__img-wrapper">
		  					<img class="about__img" src="img/about/stepOne.png" alt="">
		  				</div>
		  				<a href="php/signin.php" class="about__step-name">Включайтесь</a>
		  				<p class="about__step-desc">Становитесь частью семьи FullBloom и получите возможность осуществлять покупки в нашем интернет-магазине, а также персональную карточку гостя, дающую вам кешбек в размере 10% от суммы покупки.</p>
		  			</div>
		  			<div class="about__step">
		  				<div class="about__img-wrapper">
		  					<img src="img/about/stepTwo.png" alt="" class="about__img">
		  				</div>
		  				<a href="php/catalog.php" class="about__step-name">Выбирайте</a>
		  				<p class="about__step-desc">В нашем каталоге представлено большое разнообразие домашних цветов: цветущие, лиственные, суккуленты и даже плодовые. <br> Не можете определиться? Не беда! Мы также предлагаем флорариумы — мини-сады с несколькими растениями.</p>
		  			</div>
		  			<div class="about__step">
		  				<div class="about__img-wrapper">
		  					<img src="img/about/stepThree.png" alt="" class="about__img">
		  				</div>
		  				<a href="#" class="about__step-name">Оформляйте</a>
		  				<p class="about__step-desc">После того как вы выбрали все товары, которые хотите приоберсти, просто нажмите кнопку «Оформить заказ» в вашей персональной корзине и наш сотрудник свяжется с вами в ближайшее время.</p>
		  			</div>
		  			<div class="about__step">
		  				<div class="about__img-wrapper">
		  					<img src="img/about/stepFour.png" alt="" class="about__img">
		  				</div>
		  				<a href="#" class="about__step-name">Забирайте</a>
		  				<p class="about__step-desc">Когда ваш заказ будет собран, вам придет СМС-оповещение на указанный вами телефон. В течение следующих пяти дней вы можете подойти в любое время с 9:00 до 18:00 и забрать вашего нового члена семьи.</p>
		  			</div>
		  		</div>
		  	</div>
	  	</div>
	  	<div class="facts">
	  		<div class="container">
		  		<div class="facts__info">
		  			<div class="facts__title">А вы <span>знали?</span></div>
		  			<div class="facts__statistic">
		  				<div class="facts__fact">
		  					<div class="facts__fact-number">
		  						<span>7</span> из 10
		  					</div>
		  					<p class="facts__fact-desc">опрошенных считают себя «убийцами растений».</p>
		  				</div>
		  				<div class="facts__fact">
		  					<div class="facts__fact-number"><span>6</span> из 10</div>
		  					<p class="facts__fact-desc">опрошенных считают, что ответственность зарастения выше, чем они ожидали.</p>			
		  				</div>
		  				<div class="facts__fact">
		  					<div class="facts__fact-number"><span>6</span> из 10</div>
		  					<p class="facts__fact-desc">растений умирают из-за недостатка света.</p>		 	
		  				</div>
		  				<div class="facts__fact">
		  					<div class="facts__fact-number"><span>8</span> из 10</div>
		  					<p class="facts__fact-desc">опрошенных считают, что забота о растениях оказала положительное влияние на их психическое и физическое здоровье.</p>			
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		</div>
		<div class="contacts">
		 	<a name="contacts"></a>
		 	<div class="container">
		  		<div class="contacts__title">Связаться <span>с нами</span></div>
		  			<div class="contacts__contact">
			  		<p class="contacts__caption">
			  			Как заботиться о вашем растении, какое удобрение выбрать и на какое окно его лучше поставить — очень важные вопросы. Если вы не знаете на них ответа, то наши специалисты всегда готовы вам помочь! Также вы можете задавать любые вопросы, касающиеся нашего магазина. <br> Просто напишите нам интересующие вас вопросы и вскоре вы тоже полюбите уход за растениями.
			  		</p>
			  		<form action="php/mail.php" method="POST" class="contacts__form" >
			  			<div class="contacts__form-group">
				  			<input type="text" class="contacts__input" name="name" placeholder=" ">
				  			<label class="contacts__label" for="name">Имя</label>
			  			</div>
			  			<div class="contacts__form-group">
				  			<input type="email" class="contacts__input" name="email" required placeholder=" ">
				  			<label class="contacts__label" for="email">E-mail</label>
			  			</div>
			  			<div class="contacts__form-group">
				  			<textarea cols="30" rows="5" class="contacts__textarea" name="message" placeholder=" "></textarea>
				  			<label class="contacts__label" for="message">Сообщение</label>
			  			</div>
			  			<input type="submit" class="contacts__button">
			  		</form>
			  	</div>
		  	</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="footer__inner">
					<div class="footer__info">
						<a href="index.php" class="footer__logo"><span>Full</span>Bloom</a>
						<p class="footer__rights">ⓒ FullBloom, 2020</p>
					</div>
					<nav class="footer__navs">
						<a href="php/catalog.php" class="footer__nav">Каталог</a>
						<a href="#about" class="footer__nav"> О нас</a>
						<a href="#contacts" class="footer__nav">Контакты</a>
						<?php if(isset($_SESSION['user']) && $_SESSION['user']==true || isset($_SESSION['admin']) && $_SESSION['admin']==true) echo '<a href="php/signout.php" class="footer__nav">Выйти</a>'; else
					echo '<a href="php/signin.php" class="footer__nav">Войти</a>'; ?>
					</nav>
					<div class="footer__social">
						<a class="footer__link" href="https://web.facebook.com/nadia.smagin"><img src="img/footer/001-facebook.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://www.youtube.com/watch?v=aDeNQNtW1f8&ab_channel=BenPlatt"><img src="img/footer/002-youtube.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://www.instagram.com/nadiasm__/"><img src="img/footer/005-instagram.svg" alt="" class="footer__img"></a>
						<a class="footer__link" href="https://twitter.com/thegoodfornoth1"><img src="img/footer/007-twitter.svg" alt="" class="footer__img"></a>
					</div>
				</div>
			</div>
		</footer>
  	</div>
<script src="js/main.js"></script>
<script src="js/swiper.min.js"></script>
</body>
</html>