<div class="wrap-data">
	<h1><?= $title ?></h1>
	<?php if(!empty($error)) :?>
		<ul class="error-block">
			<?php foreach ($error as $oneError) :?>
				<li><?= $oneError?></li>
			<?php endforeach?>
		</ul>
	<?php endif?>
	<form action="/admin/add" method="post" class="registration add-form">
		<label for="first-name">Имя</label>
		<input type="text" id="first-name" name="first-name"  class="required" value="<?php if (isset($post) and $post['first-name']) echo htmlspecialchars($post['first-name'], ENT_QUOTES)?>" >
		<label for="second-name">Фамилия</label>
		<input type="text" id="second-name" name="second-name" class="required" value="<?php if (isset($post) and $post['second-name']) echo htmlspecialchars($post['second-name'], ENT_QUOTES)?>">
		<label for="middle-name">Отчество</label>
		<input type="text" id="middle-name" name="middle-name" class="required" value="<?php if (isset($post) and $post['middle-name']) echo htmlspecialchars($post['middle-name'], ENT_QUOTES)?>">
		<div class="radio-group">
			<label for="gender-men">Муж.</label>
			<input type="radio" id="gender-men" name="gender" value="men" <?php if (isset($post) and isset($post['gender']) and $post['gender'] == 'men') echo 'checked'?>>
			<label for="gender-women">Жен.</label>
			<input type="radio" id="gender-women" name="gender" value="women" <?php if (isset($post) and isset($post['gender']) and $post['gender'] == 'women') echo 'checked'?>>
		</div>
		<label for="date">День рождения</label>
		<input id="age" type="date" min="1930-01-01" name="date" class="required" value="<?php if (isset($post) and $post['date']) echo $post['date']?>">
		<label for="login">Логин</label>
		<input type="text" id="login" name="login" class="required" value="<?php if (isset($post) and $post['login']) echo htmlspecialchars($post['login'], ENT_QUOTES)?>">
		<label for="password">Пароль</label>
		<input type="password" id="password" name="password" class="required">
		<label for="password-repeat">Повторите пароль</label>
		<input type="password" id="password-repeat" name="password-repeat"  class="required">
		<input type="submit" value="Отправить данные">
	</form>
	<a class="back" href="/admin/index">&larr;Вернуться на главную страницу</a>
</div>