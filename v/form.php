<div class="container mregister">
	<div class='mess'><?echo $mess?></div>
	<div class="login">
		<h1>Авторизация</h1>
		<form action="index.php?c=User&&act=login" id="registerform" method="post" name="registerform">
			<p><label for="login">Имя пользователя<br>
			<input class="input required" id="login" name="login"size="20" type="text" placeholder="Имя пользователя" value="<?echo $username?>"></label></p>
			<p><label for="password">Пароль<br>
			<input class="input required password" id="password" name="password"size="32"   type="password" placeholder="Пароль" value=""></label></p>
			<label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
			<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Войти"></p>
		</form>
	</div>
	<a href="index.php?c=User&&act=register">Регистрация</a>
</div>