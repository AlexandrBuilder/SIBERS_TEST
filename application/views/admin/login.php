<div class="wrap-data">
	<h1><?= $title ?></h1>
	<?php if (isset($error)) :?>
		<ul class="error-block">
			<li><?= $error ?></li>
		</ul>
	<?php endif?>
	<form action="/admin/login" method="post" class="registration">
		<label for="login">Логин</label>
		<input type="text" id="login" class="required" name="login">
		<label for="password">Пароль</label>
		<input type="password" id="password" class="required" name="password">
		<input type="submit" value="Войти">
	</form>
</div>