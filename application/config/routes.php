<?php

return [
	'' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	'admin/index' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	'admin/index/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	'admin/add' => [
		'controller' => 'admin',
		'action' => 'add',
	],
	'admin/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'edit',
	],
	'admin/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'delete',
	],
	'admin/view/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'view',
	],
	'admin/user' => [
		'controller' => 'admin',
		'action' => 'user',
	],
];