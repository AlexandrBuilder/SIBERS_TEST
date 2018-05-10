<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route; //information about url
	public $view; 
	public $acl; //Access Control List

	public function __construct($route) {
		$this->route = $route;
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
		$path = 'application\controllers\\'.ucfirst($this->route['controller']).'Controller';
		if (method_exists($path, 'before')) {
            $this->before();
		}
		if (!$this->checkAcl()) {
			View::errorCode(403);
		}
	}

	//load model
	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	//check Access Control List
	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
			return true;
		}
		elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
			return true;
		}
		elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	//check for existence in the Access Control List
	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}

}