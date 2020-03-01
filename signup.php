<?php
require "db.php";

$data = $_POST;
if( isset($data['do_signup']) )
{
	//здесь регистрируем
	
	
	$errors = array();
	if( trim($data['login']) == '' ) 
	{
		$errors[] = 'Введите логин!';
	}
	
	if( trim($data['email']) == '' ) 
	{
		$errors[] = 'Введите Email!';
	}
	
	if($data['password'] == '' ) 
	{
		$errors[] = 'Введите пароль!';
	}
	
	if($data['password_2'] != $data['password']) 
	{
		$errors[] = 'Повторный пароль введен не верно!';
	}
	
	if( R::count('user', "login = ?", array($data['login'])) > 0 )
		
	{
		$errors[] = 'Пользователь с таким логином уже существует!';
	}
	
	if( R::count('user', "email = ?", array($data['email'])) > 0 )
		
	{
		$errors[] = 'Пользователь с таким Email  уже существует!';
	}
	
	if( empty($errors) )
	{
		//все хорошо, регистрируем
		
		$user = R::dispense('user');
		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->password =  password_hash($data['password'], PASSWORD_DEFAULT);
		R::store($user);
		
		echo '<div style="color: white;"><h1>Вы успешно зарегистрированы!<br/>Можете перейти на <a href="login.php" >страницу </a> входа!</h1></div><hr>';

		
	} else
	{
		echo '<div style="color: black;"><h1>'.array_shift($errors).'</h1></div><hr>';
	}
		
}

?>


<html>
<form action="/signup.php" method="POST">
<div class="container">
<p>
<p><strong>Ваш логин</strong>:</p>
<input type="text" name="login" value="<?php echo @$data['login']; ?>">
</p>
<p>
<p><strong>Ваш Email</strong>:</p>
<input type="email" name="email" value="<?php echo @$data['email']; ?>">
</p>
<p>
<p><strong>Ваш пароль</strong>:</p>
<input type="password" name="password" value="<?php echo @$data['password']; ?>">
</p>
<p>
<p><strong>Введите ваш пароль еще раз</strong>:</p>
<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
</p>
<div class="clearfix">
<p>
<button type="submit" name="do_signup">Зарегистрироваться</button>
</p>
</div>
 </div>
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
</html>