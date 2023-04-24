<?php
session_start();
require('database.class.php');

class Application extends Database{

	public function get_config_param($key){
		return $this->db->query("select * from `settings` where `name` = '$key'")->fetch()["value"];
	}

	public function get_reviews(){
		return $this->db->query("select * from `reviews` order by rand() limit 5")->fetchAll();
	}

	public function get_rooms($withView = 0){
		$arg = "";
		if($withView) $arg = "WHERE view = 1";
		return $this->db->query("select * from `rooms` $arg")->fetchAll();
	}

	public function auth($login, $password){
		$sql = $this->db->query("select * from `users` where `login`='$login' and `password`='".md5($password)."'")->fetchAll();
		if(count($sql) > 0){
			$_SESSION["user"] = $sql;
			return true;
		}
		else{
			return false;
		}
	}
	public function get_icon_name($class){

			if($class == "icon-none")  return "Пустой номер";
			if($class == "icon-claw") return "Когтеточка";
			if($class == "icon-bed") return "Кровать";
			if($class == "icon-toy")  return "Игровой комплекс";
			if($class == "icon-house") return "Домик";

	}
	public function get_catalog(){
		$sql = $this->db->query("select * from `rooms`")->fetchAll();
		$result = [];
		foreach ($sql as $room){
			$icons = $this->db->query("select * from `rooms-icons` where roomID = '".$room["id"]."'")->fetchAll();
			foreach ($icons as $i){
				$room["icons"][] = ["class" => $i["class"], "name" => $this->get_icon_name($i["class"])];
			}
			$result[] = $room;
		}
		return $result;

	}
}
$application = new Application();