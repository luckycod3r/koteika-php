<?php
    require '../application/classes/application.class.php';

	if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["action"] == "state"){
            $roomID = $_POST["rid"];
            $view = $_POST["view"];
            
            $application->set_view_for_room($roomID,($view == 1) ? 0 : 1);
            header("location: index.php");
        }
        else{
	        $errors = [];

	        if($_POST["login"] == ""){
		        $errors[] = "Заполните поле логин";
	        }
	        if($_POST["password"] == ""){
		        $errors[] = "Заполните поле пароль";
	        }
	        if(count($errors) == 0){

		        $authRes = $application->auth($_POST["login"],$_POST["password"]);

		        if($authRes){
			        echo 'Вы вошли в аккаунт';
		        }
		        else{
			        echo 'Неправильный логин или пароль';
		        }

	        }
        }


	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <?php
        foreach ($errors as $error):
            echo $error;
        endforeach;
        if(isset($_SESSION["user"]["login"])):
    ?>
	<input type="text" name="login" placeholder="логин">
	<input type="password" name="password" placeholder="пароль">
	<button type="submit">Войти</button>
    <?php
        else:
            $rooms = $application->get_rooms(0);
            foreach ($rooms as $room):
            ?>
                <img src="../<?=$room["image"]?>" height="256" alt="картинка"><br>
                <span><?=$room["name"]?></span><br>
            <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
                <input type="checkbox" id="room_<?=$room["id"]?>" <?=($room["view"] == 1) ? 'checked' : ''?>>
                <label for="room_<?=$room["id"]?>">Отображать на главной</label><br>
                <input type="hidden" name="action" value="state">
                <input type="hidden" name="rid" value="<?=$room["id"]?>">
                <input type="hidden" name="view" value="<?=$room["view"]?>">
                <button type="submit">Обновить</button>
            </form>

        <?php
        endforeach;
        endif;
    ?>
</form>
</body>
</html>