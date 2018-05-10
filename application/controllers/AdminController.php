<?php
namespace application\controllers;
use application\core\Controller;
use application\lib\Pagination;
use DateTime;


class AdminController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

    //validation event
	public function before() {
		$path = $this->route['controller'].'/'.$this->route['action'];
		if ((!isset($_SESSION['admin'])) and ($path != 'admin/login')) {
			$this->view->redirect('admin/login');
		}
	}

	//authorization 
	public function loginAction() {
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/index');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$vars = [
					'error' => $this->model->error
				];
				$this->view->render('Вход', $vars);
			} else {
				$_SESSION['admin'] = true;
				$this->view->redirect('admin/index');
			}
		} else
		$this->view->render('Вход');
	}

	//exit authorization
	public function logoutAction() {
		unset($_SESSION['admin']);
		$this->view->redirect('admin/login');
	}

	//main page 
	public function indexAction() {
		$pagination = new Pagination($this->route, $this->model->usersCount(), $this->model->countOnPage, $this->route['get']);
		$vars = [
			'pagination' => $pagination->get(),
			'users' => $this->model->usersList($this->route, $_GET),
			'get' => $_GET,
		];
		$this->view->render('Все пользователи', $vars);
	}

	//add user
	public function addAction() {
		if (!empty($_POST)) {
			if (!$this->model->userValidate($_POST, 'add')) {
				$vars = [
					'error' => $this->model->error,
					'post'=>$_POST
				];
				$this->view->render('Добавление пользователя', $vars);
			} elseif (!$this->model->userAdd($_POST, 'add')) {
				$vars = [
					'error' => array('Невозвожно записать в базу данных'),
					'post'=>$_POST
				];
				$this->view->render('Добавление пользователя', $vars);
			} else
			$this->view->redirect('admin/index');
		} else
		$this->view->render('Добавление пользователя');
	}

	//edit user
	public function editAction() {
		if (!$this->model->isUserExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->userValidate($_POST, 'edit', $this->route['id'])) {
				$post = array();
				$post['id'] = $this->route['id'];
				foreach ($_POST as $key => $postElement) {
					$post[str_replace('-', '_', $key)] = $postElement;
				}
				$vars = [
					'user' => $post,
					'error' => $this->model->error
				];
				$this->view->render('Редактировать пользователя '.htmlspecialchars($vars['user']['login'], ENT_QUOTES), $vars);
			} else {
				$this->model->userEdit($_POST, $this->route['id']);
				$this->view->redirect('admin/index');
			}
		} else {
			$vars = [
				'user' => $this->model->userData($this->route['id'])[0],
			];
			$this->view->render('Редактировать пользователя '.htmlspecialchars($vars['user']['login'], ENT_QUOTES), $vars);
		}
	}

	//delete user
	public function deleteAction() {
		if (!$this->model->isUserExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->userDelete($this->route['id']);
		$page = explode('/',$_SERVER['HTTP_REFERER'])[5] ?? 1;
		$usersCount = $this->model->usersCount();
		if(ceil($usersCount/$this->model->countOnPage) < $page)
			$page = ceil($usersCount/$this->model->countOnPage);
		$this->view->redirect('admin/index/'.$page);
	}

	//view user
	public function viewAction() {
		if (!$this->model->isUserExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$user = $this->model->userData($this->route['id'])[0];
		$date = DateTime::createFromFormat("Y-m-d", $user['date']);
		$user['date'] = $date -> format("d.m.Y");
		$vars = [
			'user' => $user
		];
		$this->view->render('Данные о пользователе '.htmlspecialchars($user['login'], ENT_QUOTES), $vars);
	}

	//action for ajax request to verify the existence of the login
	public function userAction() {
		$login = $_POST['login'] ?? null;
		$id = $_POST['id'] ?? null;
		exit(json_encode(['message' => $this->model->userLoginValidate($login, $id)]));
	}
}