<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Oasis</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>

<!-- mob menu -->
<header class='mobile-menu'>
	<div class="menu-btn">
		<span class="bar"></span>
		<span class="bar"></span>
		<span class="bar"></span>
	</div>
</header>

<div class="header__nav">
	<nav class="nav">
    <ul class="nav__list">
    <li class="nav__list_item"><a class="nav__link" href="index.php">Главная</a></li>
      <li class="nav__list_item"><a class="nav__link" href="about.php">О нас</a></li>
      <li class="nav__list_item"><a class="nav__link" href="carera.php">Карьера</a></li>
      <li class="nav__list_item"><a class="nav__link" href="club.php">Клубы</a></li>
      <li class="nav__list_item"><a class="nav__link" href="otziv.php">Отзывы</a></li>
      <?php 
        session_start();
        require_once('php/bd.php');
                   if (isset($_SESSION['login_user'] )) {
                    $user_check = $_SESSION['login_user'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
                    $rows = mysqli_fetch_array($query);
                    $status = $rows['admin'];
                    $id_user = $rows['id_user'];
                    if($status ==1){
                        // header("Location: ../account/admin.php");
                        $admin = '<li class="nav__list_item"><a href="account/admin.php" class="nav__link " href="#">Личный кабинет</a></li>';
                    }else{
                        $admin = '<li class="nav__list_item"><a href="account.php" class="nav__link" href="#">Личный кабинет</a></li>';
                    }
                    
                    echo  $admin;
                   

                }  else{
                    echo '<li class="nav__list_item"><a class="nav__link button" href="#">Личный кабинет</a></li>';
                }
                   ?>
      <!-- <li class="nav__list_item"><a class="nav__link button" href="#">Личный кабинет</a></li> -->
      <li class="nav__list_item"><a class="nav__link" href="contact.php">Контакты</a></li>
      <li class="nav__list_item"><a class="nav__link" href="social.php">Социальные сети</a></li>
    </ul>
	</nav>
</div>
<!--  -->


    <!-- auth -->
    <div class="overlay">
		<div class="popup">
            <div class="bg">
			<h2 class="popup__h2">Авторизация</h2>
            <div class="hr"></div>
                <div class="inp flex">
                    <form action="php/login.php" method="POST">
                        <input type="email" id="Email" required name="email" class="input" placeholder="Телефон или эл. почта"><br>
                        <input type="password" id="pass" required name="password" class="input" placeholder="Пароль"><br>
                        <button name="login" class="btn ml">Войти</button>
                        <a href="#" class='button2'>Зарегистрироваться</a>
                    </form>
                </div>
            </div>
			<div class="close-popup"></div>
		</div>
	</div>
    <!--  -->

    <!-- register -->
    <div class="overlay2">
		<div class="popup">
            <div class="bg">
			<h2 class="popup__h2">Регистрация</h2>
            <div class="hr"></div>
                <div class="inp flex">
                    <form action="php/register.php" method="POST">
                        <input type="text" class="input" placeholder="ФИО" required id="name" name="name"><br>
                        <input type="text" class="input" placeholder="Номер телефона" required id="tel" name="number"><br>
                        <input type="text" class="input" placeholder="Email" required id="email" name="email"><br>
                        <input type="password" class="input" placeholder="Пароль" required id="password" name="password"><br><br>
                        <button name="registration">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
			<div class="close-popup"></div>
		</div>
	</div>
    <!--  -->


    <!-- pc menu -->
    <header class="menu-pc">
        <a href="index.php">
            <div class="logo">
                <img src="img/logo.svg" alt="logo" width="70%">
            </div>
        </a>
        <nav>
            <ul>
                <li><a href="about.php">О нас</a></li>
                <li><a href="carera.php">Карьера</a></li>
                <li><a href="club.php">Клубы</a></li>
                <li><a href="otziv.php">Отзывы</a></li>
                <?php 
                error_reporting(0);
        session_start();
        require_once('php/bd.php');
                   if (isset($_SESSION['login_user'] )) {
                    $user_check = $_SESSION['login_user'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
                    $rows = mysqli_fetch_array($query);
                    $status = $rows['admin'];
                    $id_user = $rows['id_user'];
                    if($status ==1){
                        $admin = '<li><a href="account/admin.php"">Личный кабинет</a></li>';
                    }else{
                        $admin = '<li><a href="account.php">Личный кабинет</a></li>';
                    }
                    
                    echo  $admin;

                }  else{
                    echo '<li><a class="button">Личный кабинет</a></li>';
                }
                   ?>
                <li><a href="contact.php">Контакты</a></li>
                <li><a href="social.php">Социальные сети</a></li>
            </ul>
        </nav>
    </header>
    <!--  -->
    
<script src="js/auth.js"></script>
<script src="js/register.js"></script>
<script src="js/menu.js"></script>