<a href="/admin/add" class="add"><em>+</em> Добавить пользователя</a>
<form action="/admin/index" class="sort">
	<div>
	<lable for="sort-id">id</lable>
	<input type="checkbox" name="sort-id" id="sort-id" <?if (isset($get['sort-id'])) :?> checked <?endif?>>
	<lable for="sort-id">Логин</lable>
	<input type="checkbox" name="sort-login" <?if (isset($get['sort-login'])) :?> checked <?endif?>>
	<lable for="sort-id">Имя</lable>
	<input type="checkbox" name="sort-first-name" <?if (isset($get['sort-first-name'])) :?> checked <?endif?>>
	<lable for="sort-id">Фамилия</lable>
	<input type="checkbox" name="sort-second-name" <?if (isset($get['sort-second-name'])) :?> checked <?endif?>>
	<lable for="sort-id">Отчество</lable>
	<input type="checkbox" name="sort-middle-name" <?if (isset($get['sort-middle-name'])) :?> checked <?endif?>>
	<lable for="sort-id">Пол</lable>
	<input type="checkbox" name="sort-gender" <?if (isset($get['sort-gender'])) :?> checked <?endif?>>
	<lable for="sort-id">Дата Рождения</lable>
	<input type="checkbox" name="sort-date" <?if (isset($get['sort-date'])) :?> checked <?endif?>>
	</div>
	<input type="submit" class="add" value="Сортировать">
</form>
<div class="wrap-table">
	<table class="table">
		<thead>
			<tr>
			    <th>id</th>
			    <th>Логин</th>
			    <th>Фамилия</th>
			    <th>Имя</th>
			    <th>Отчество</th>
			    <th>Пол</th>
			    <th>Дата рождения</th>
			    <th class="helpers">Просмотреть</th>
			    <th class="helpers">Изменить</th>
			    <th class="helpers">Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user) : ?>
				<tr>
				    <td><?= $user['id'] ?></td>
				    <td><?= htmlspecialchars($user['login'], ENT_QUOTES) ?></td>
				    <td><?= htmlspecialchars($user['first_name'], ENT_QUOTES) ?></td>
				    <td><?= htmlspecialchars($user['second_name'], ENT_QUOTES) ?></td>
				    <td><?= htmlspecialchars($user['middle_name'], ENT_QUOTES) ?></td>
				    <td><?= $user['gender'] == 'men' ? 'Муж.' :  'Жен.'?></td>
				    <td><?= $user['date'] ?></td>
				    <td class="img-fon"><a href="/admin/view/<?= $user['id'] ?>"><img src="/public/img/icons8-find-user-male-30.png" alt=""></a></td>
				    <td class="img-fon"><a href="/admin/edit/<?= $user['id'] ?>"><img src="/public/img/icons8-registration-30.png" alt=""></a></td>
				    <td class="img-fon"><a class="delete-user" data-id="<?= $user['id'] ?>" href="/admin/delete/<?= $user['id'] ?>"><img src="/public/img/icons8-denied-30.png" alt=""></a></td>
				</tr>
			<?php endforeach?>
		</tbody>
	</table>
</div>
<div class="wrap-pagination">
	<?= $pagination ?>
</div>