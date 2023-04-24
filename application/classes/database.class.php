<?php

class Database {

	public $db = null;

		/*
		 * Подключение к бд
		 * через PDO
		 *
		 * */
	public function __construct() {
		$this->db = new PDO("mysql:host=localhost;dbname=koteyka","root","root",[
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
	}
	public function __destruct() {
		$this->db = null;
	}
}

$database = new Database();