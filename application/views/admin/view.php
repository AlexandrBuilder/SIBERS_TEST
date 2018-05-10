<div class="wrap-data">
	<h1><?= $title ?></h1>
	<ol class="list-data">
		<li>ID:<span><?= htmlspecialchars($user['id'], ENT_QUOTES) ?></span></li>
		<li>Логин:<span><?= htmlspecialchars($user['login'], ENT_QUOTES) ?></span></li>
		<li>Имя:<span><?= htmlspecialchars($user['first_name'], ENT_QUOTES) ?></span></li>
		<li>Фамилия:<span><?= htmlspecialchars($user['second_name'], ENT_QUOTES) ?></span></li>
		<li>Отчество:<span><?= htmlspecialchars($user['middle_name'], ENT_QUOTES) ?></span></li>
		<li>Пол:<span><?= $user['gender'] == 'men' ? 'Мужcкой' :  'Женский'?></span></li>
		<li>День рождения:<span><?= $user['date'] ?></span></li>
		<li>Пароль(захешированный)<span><?= $user['password'] ?></span></li>
	</ol>
	<a class="back" href="/admin/index">&larr;Вернуться на главную страницу</a>
</div>