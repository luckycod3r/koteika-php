<?php
/** @var mixed $content */

use Models\Javascript;
use Models\User;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Титл | Магазин одежды</title>
    <link rel="stylesheet" href="<?= asset('styles/main.css') ?>">
</head>
<body>
    <header>
        <nav>
            <ul>

                <li><a href="<?= url("")?>"><img src="<?= asset("images/logo.svg")?>" alt=""></a></li>
                <li><a href="/catalog">Каталог</a></li>
                <li><a href="/sales">Акции</a></li>
                <li><a href="/reviews">Отзывы</a></li>
                <li><a href="/about">О нас</a></li>
                <li><a jsl>Корзина</a></li>

                <li><a href="#"></a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <?=$content?>
    </main>
    <footer>
        footer
    </footer>
    <?php


        Javascript::public("system.js");
        Javascript::public("AquaJS.min.js");
        Javascript::private("main.js");
    ?>
</body>
</html>