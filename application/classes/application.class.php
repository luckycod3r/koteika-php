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
	public function get_catalog($filter){
		$filter_query = "";
		if(count($filter) > 0){
			$order = "DESC";
			if($filter["order"] == "up") $order = "ASC";
			$filter_query = "WHERE price BETWEEN ".$filter["price"]["price_from"]." AND ".$filter["price"]["price_to"];

			if($filter["squares"] != null) $filter_query .= " AND `square` in (".implode(",",$filter["squares"]).")";
			if($filter["icons"] != null){
				$icons_string = "";
				foreach ($filter["icons"] as $k => $icon){
					$icons_string .= "'".$icon."'";
					if($k != (count($filter["icons"]) - 1)){
						$icons_string .= ",";
					}

				}
				$filter_query .= " AND `id` IN (SELECT `roomID` FROM `rooms-icons` WHERE `class` IN (".$icons_string.")) ";
			}
			$filter_query .= " ORDER BY `".$filter['sort']."` $order";
		}


		$sql_query = "select * from `rooms` $filter_query";
		$sql = $this->db->query($sql_query)->fetchAll();
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
	public function get_catalog_filter_squares(){
		return $this->db->query("SELECT DISTINCT square FROM rooms")->fetchAll();
	}
	public function get_catalog_filter_icons(){
		return $this->db->query("SELECT DISTINCT `class` FROM `rooms-icons`")->fetchAll();
	}
	public function set_view_for_room($roomID,$view){
		$this->db->query("UPDATE `rooms` SET view = $view where id = $roomID");
	}
}
$application = new Application();