<?php
require "db.php"; 

$data = $_POST;

$data = $_POST;
if( isset($data['do_login']) )
{
	$errors = array();
	$user = R::findOne('user', 'login = ?' , array($data['login']));
	
	if( $user )
	{
		//логин существует
		
		if( password_verify($data['password'], $user->password))
		{
			//все хорошо логиним пользователя
			$_SESSION['logged_user'] = $user;
			echo '<div style="color: white;"><h1>Вы авторизованы!<br/>Можете перейти на <a href="index.html" >главную </a> страницу!</h1></div><hr>';

			
		}else
		{
			$errors[] = 'Неверно введен пароль!';
		}
		
	}else
	{
		$errors[] = 'Пользователь с таким логином не найден!';
	}
	
	if( ! empty($errors) )
	{
		echo '<div style="color: black;"><h1>'.array_shift($errors).'</h1></div><hr>';
	}
}

?>

<form action="/login.php" method="POST">

<p>
<p><strong>Логин</strong>:</p>
<input type="text" name="login" value="<?php echo @$data['login']; ?>">
</p>

<p>
<p><strong>Пароль</strong>:</p>
<input type="password" name="password" value="<?php echo @$data['password']; ?>">
</p>

<p>
<button type="submit" name="do_login">Войти</button>
</p>

<style>
* {box-sizing: border-box}

/* Full-width input fields */
  input[type=text],input[type=email], input[type=password] {
  width: 25%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=email]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

html {
  background-image: url(img/77.jpg);
  background-repeat: no-repeat;
  background-position: top center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 15%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
    width: 100%;
  }
}
</style>

</form>