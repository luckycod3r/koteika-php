<?php
session_start();
require('database.class.php');


/*
 * Основной класс приложения
 *
 */
class Application extends Database{

	// Получает значение из конфига путем запроса к бд
	public function get_config_param($key){
		return $this->db->query("select * from `settings` where `name` = '$key'")->fetch()["value"];
	}
	// Получает рандомные 5 отзывов
	public function get_reviews(){
		return $this->db->query("select * from `reviews` order by rand() limit 5")->fetchAll();
	}
	// Получает все комнаты
	public function get_rooms($withView = 0){
		$arg = "";
		if($withView) $arg = "WHERE view = 1";
		return $this->db->query("select * from `rooms` $arg")->fetchAll();
	}
	// Авторизация
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
	// Определение названия иконки
	public function get_icon_name($class){

			if($class == "icon-none")  return "Пустой номер";
			if($class == "icon-claw") return "Когтеточка";
			if($class == "icon-bed") return "Кровать";
			if($class == "icon-toy")  return "Игровой комплекс";
			if($class == "icon-house") return "Домик";

	}
	// Получение каталога
	public function get_catalog($filter){
		// подготовка фильтр-запроса
		$filter_query = "";
		if(count($filter) > 0){
			// по умолчанию выводится по убыванию
			$order = "DESC";
			// узнаем очередность номеров в каталоге
			if($filter["order"] == "up") $order = "ASC";
			// основной фильтр-запрос (цена)
			$filter_query = "WHERE price BETWEEN ".$filter["price"]["price_from"]." AND ".$filter["price"]["price_to"];
			// если указана площадь, то получаем массив и подставляем в запрос
			if($filter["squares"] != null) $filter_query .= " AND `square` in (".implode(",",$filter["squares"]).")";
			// если указано оснащение номера
			if($filter["icons"] != null){
				// подготавливаем строку для запроса
				$icons_string = "";
				foreach ($filter["icons"] as $k => $icon){
					$icons_string .= "'".$icon."'";
					if($k != (count($filter["icons"]) - 1)){
						$icons_string .= ",";
					}

				}
				// подставляем к фильтр-запросу, запрос на оснащение
				$filter_query .= " AND `id` IN (SELECT `roomID` FROM `rooms-icons` WHERE `class` IN (".$icons_string.")) ";
			}
			// и в конце указываем очередность
			$filter_query .= " ORDER BY `".$filter['sort']."` $order";
		}


		$sql_query = "select * from `rooms` $filter_query";
		$sql = $this->db->query($sql_query)->fetchAll();
		$result = [];
		// подгатвливаем массив с комнатами
		foreach ($sql as $room){
			$icons = $this->db->query("select * from `rooms-icons` where roomID = '".$room["id"]."'")->fetchAll();
			// получили оснащение и добавляем к массиву комнаты его оснащение
			foreach ($icons as $i){
				$room["icons"][] = ["class" => $i["class"], "name" => $this->get_icon_name($i["class"])];
			}
			$result[] = $room;
		}

		return $result;

	}
	// получаем все фильтры по площади
	public function get_catalog_filter_squares(){
		return $this->db->query("SELECT DISTINCT square FROM rooms")->fetchAll();
	}
	// получаем все фильтры по оснащению
	public function get_catalog_filter_icons(){
		return $this->db->query("SELECT DISTINCT `class` FROM `rooms-icons`")->fetchAll();
	}
	// обновлению отображения комнаты на главной
	public function set_view_for_room($roomID,$view){
		$this->db->query("UPDATE `rooms` SET view = $view where id = $roomID");
	}
}
// Инициализируем приложение
$application = new Application();