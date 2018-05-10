<?php
namespace application\models;
use application\core\Model;
use DateTime;

class Admin extends Model {

	public $error; //error list
	public $countOnPage = 10; //number of items per page

	//validate login and password admin
	public function loginValidate($post) {
		$config = require 'application/config/admin.php';
		if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
			$this->error = 'Логин или пароль указан неверно';
			return false;
		}
		return true;
	}

	//validate user data
	public function userValidate($post, $type, $id = null) {
		$firstNameLen = iconv_strlen($post['first-name']);
		$seconNameLen = iconv_strlen($post['second-name']);
		$middleNameLen = iconv_strlen($post['middle-name']);
		$loginLen = iconv_strlen($post['login']);
		$passwordLen = iconv_strlen($post['password']);
		$date = DateTime::createFromFormat("Y-m-d", $post['date']);
		$currentDate = new DateTime();

		if ($firstNameLen < 2 or $firstNameLen > 30) {
			$this->error[] = 'Имя должно содержать от 2 до 20 символов';
		} elseif (!preg_match('/^[a-zа-я]+$/iu', $post['first-name'], $match)) {
        	$this->error[] = 'Имя должно содержать символы а-я и a-z';
    	} 

    	if ($seconNameLen < 2 or $seconNameLen > 30) {
			$this->error[] = 'Фамилия должна содержать от 2 до 20 символов';
		} elseif (!preg_match('/^[a-zа-я]+$/iu', $post['second-name'], $match)) {
        	$this->error[] = 'Фамилия должна содержать символы а-я и a-z';
    	}

    	if ($middleNameLen < 2 or $middleNameLen > 30) {
			$this->error[] = 'Отчество должно содержать от 2 до 20 символов';
		} elseif (!preg_match('/^[a-zа-я]+$/iu', $post['middle-name'], $match)) {
        	$this->error[] = 'Отчество должно содержать символы а-я и a-z';
    	}

    	if (!isset($post['gender']) or ($post['gender'] != 'men' and $post['gender'] != 'women')) {
        	$this->error[] = 'Пол не выбран';
    	}

    	if (!$post['date']) {
        	$this->error[] = 'Дата отсутсвует';
    	} elseif (!$date) {
        	$this->error[] = 'Формат даты не верный';
    	} elseif ($currentDate <= $date) {
        	$this->error[] = 'Не существует такой даты';
        }

    	if ($loginLen < 5 or $loginLen > 100) {
			$this->error[] = 'Логин должен содержать от 5 до 100 символов';
		} elseif (!$this->userLoginValidate($post['login'], $id)) {
        	$this->error[] = 'Такой логин уже занят другим пользователем';
        }

		if (($type == "edit" and ($post['password'] !="" or $post['password-repeat']) !="") or $type == "add") {
			if ($passwordLen < 8 or $passwordLen > 200) {
				$this->error[] = 'Пароль должнен содержать от 8 до 200 символов';
			} elseif ($post['password'] != $post['password-repeat']) {
				$this->error[] = 'Пароли не совпадают';
			} 
		}

		if (count($this->error)) {
			return false;
		}

		return true;
	}

	//check the existence of the login
	public function userLoginValidate($login, $id) {
		if (!empty($userDb = $this->isLoginExists($login)))
			$userDb = $userDb[0];
		if (empty($id)) {
			if (!empty($userDb)) 
	        	return false;
    	} else {
    		if (!empty($userDb['id']) && intval($userDb['id']) != $id ) 
        		return false;
    	} 
    	return true;
	}

	//add user
	public function userAdd($post) {
		$params = [
			'id' => NULL,
			'login' => trim($post['login']),
			'password' => password_hash(trim($post['password']), PASSWORD_BCRYPT),
			'first_name' => trim($post['first-name']),
			'second_name' => trim($post['second-name']),
			'middle_name' => trim($post['middle-name']),
			'gender' => $post['gender'],
			'date' => $post['date'],
		];
		$this->db->query('INSERT INTO users (id, login, password, first_name, second_name, middle_name, gender, date) 
			VALUES (:id, :login, :password, :first_name, :second_name, :middle_name, :gender, :date)', $params);
		return $this->db->lastInsertId();
	}

	//edit user
	public function userEdit($post, $id) {
		$params = [
			'id' => $id,
			'login' => trim($post['login']),
			'password' => !empty($post['password']) ? password_hash(trim($post['password']), PASSWORD_BCRYPT) : $post['hash-password'],
			'first_name' => trim($post['first-name']),
			'second_name' => trim($post['second-name']),
			'middle_name' => trim($post['middle-name']),
			'gender' => $post['gender'],
			'date' => $post['date'],
		];
		$this->db->query('UPDATE users SET login = :login , password = :password , first_name = :first_name, second_name = :second_name , middle_name =       :middle_name, gender = :gender, date = :date WHERE id = :id', $params);
		return $this->db->lastInsertId();
	}

	//get a user by id
	public function isUserExists($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
	}

	//delete user
	public function userDelete($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM users WHERE id = :id', $params);
	}

	//get the number of users
	public function usersCount() {
		return $this->db->column('SELECT COUNT(id) FROM users');
	}

	//get a list of users
	public function usersList($route, $get) {
		$allColumns = array('id', 'login', 'first_name', 'second_name', 'middle_name', 'gender', 'date');
		$selectColumns = array();
		$search  = array('sort-', '-');
		$replace = array('', '_');
		foreach ($get as $nameColumn => $value) {
			$nameColumn = str_replace($search, $replace, $nameColumn);
			if (in_array($nameColumn, $allColumns))
				$selectColumns[] = $nameColumn; 
		}
		if (empty($selectColumns)) {
			$selectColumns[] = 'id'; 
		}    
		return $this->db->row('SELECT * FROM users ORDER BY '. implode(', ', $selectColumns).' LIMIT '.((($route['page'] ?? 1) - 1) * $this->countOnPage).','. $this->countOnPage);
	}

	//get information about the user
	public function userData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
	}

	//get a user by login
	public function isLoginExists($login) {
		$params = [
			'login' => $login,
		];
		return $this->db->row('SELECT id, login FROM users WHERE login = :login', $params);
	}
}