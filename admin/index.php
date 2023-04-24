<?php
    require '../application/classes/application.class.php';

	if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        endif;
    ?>
</form>
</body>
</html>