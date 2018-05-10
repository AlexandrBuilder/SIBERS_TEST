<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="/../public/css/main.css">
</head>
<body>	
	<div class="wrapper">
		<header class="header">
			<span class="title">Admin Panel</span>
			<?php if (isset($_SESSION['admin'])): ?>
				<span class="logout">Админ <a href="/admin/logout">[Выйти]</a></span>
			<?php endif?>
		</header>
		<div class="content">
			<?= $content ?>
		</div>
		<footer class="footer">
			<span>&copy; Kiselev Alexandr <?= date("Y") ?></span>
		</footer>
	</div>
	<script src="/../public/scripts/jquery.js"></script>
	<script src="/../public/scripts/main.js"></script>
</body>
</html>