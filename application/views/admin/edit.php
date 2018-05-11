<div class="wrap-data">
	<h1><?= $title ?></h1>
	<?php if(!empty($error)) :?>
		<ul class="error-block">
			<?php foreach ($error as $oneError) :?>
				<li><?= $oneError?></li>
			<?php endforeach?>
		</ul>
	<?php endif?>
	<form action="/admin/edit/<?= $user['id'] ?>" method="post" class="registration edit">
		<label for="first-name">Имя</label>
		<input type="text" id="first-name" name="first-name" class="required" value="<?php if (isset($user) and $user['first_name']) echo htmlspecialchars($user['first_name'], ENT_QUOTES)?>" >
		<label for="second-name">Фамилия</label>
		<input type="text" id="second-name" name="second-name" class="required" value="<?php if (isset($user) and $user['second_name']) echo htmlspecialchars($user['second_name'], ENT_QUOTES)?>">
		<label for="middle-name">Отчество</label>
		<input type="text" id="middle-name" name="middle-name" class="required" value="<?php if (isset($user) and $user['middle_name']) echo htmlspecialchars($user['middle_name'], ENT_QUOTES)?>">
		<div class="radio-group">
			<label for="gender-men">Муж.</label>
			<input type="radio" id="gender-men" name="gender" class="required" value="men" <?php if (isset($user) and $user['gender'] == 'men') echo 'checked'?>>
			<label for="gender-women">Жен.</label>
			<input type="radio" id="gender-women" name="gender" class="required" value="women" <?php if (isset($user) and $user['gender'] == 'women') echo 'checked'?>>
		</div>
		<label for="date">День рождения</label>
		<input id="age" type="date" min="1930-01-01" name="date" class="required" value="<?php if (isset($user) and $user['date']) echo $user['date']?>">
		<label for="login">Логин</label>
		<input type="text" id="login" name="login" class="required" data-id = "<?= $user['id'] ?>" value="<?php if (isset($user) and $user['login']) echo htmlspecialchars($user['login'], ENT_QUOTES)?>">
		<label for="password">Пароль</label>
		<input type="password" id="password" name="password">
		<label for="password-repeat">Повторите пароль</label>
		<input type="password" id="password-repeat" name="password-repeat">
		<input type="submit" value="Отправить данные">
	</form>
	<a class="back" href="/admin/index">&larr;Вернуться на главную страницу</a>
</div>
