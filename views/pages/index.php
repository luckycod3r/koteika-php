<?php
/** @var mixed $data */
// Принимает массив $data
//  $data["news"] => массив новостей
//    => $data["news"]["title"] = заголовок новости
?>

<?php
    // Блок новостей

foreach ($data["news"] as $new)
{
    ?>

    <div class="products-wrapper-element">
        <div class="products-wrapper-element-information">
            <span class="products-wrapper-element-name"><?=$new["title"]?></span>
            <span class="products-wrapper-element-name"><?=$new["description"]?></span>
        </div>
    </div>


<?php
}
?>
