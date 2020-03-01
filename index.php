<?php
require "db.php";
?>

<?php if( isset($_SESSION['logged_user']) ) : ?>
<h1>Добро пожаловать, <?php echo  $_SESSION['logged_user']->login; 
echo '<div style="color: white;">Вы авторизованы!<br/>Можете перейти на <a href="index.html" >главную </a> страницу!</h1></div><hr>';?>
<hr>
<?php else : ?>
	<a href="/login.php"><center><h2>Авторизация</h2></center></a><br>
	<br><a href="/signup.php"><center><h2>Регистрация</h2></center></a>
<?php endif; ?>
<style>

html {
  background-image: url(img/77.jpg);
  background-repeat: no-repeat;
  background-position: top center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

a {
  color: white;
  border: none;
  width: 45%;
  opacity: 0.7;
}
</style>