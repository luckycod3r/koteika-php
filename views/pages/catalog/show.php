<?php

use Models\Cart;

?>
<div class="catalog-product-window">

        <div class="catalog-product-image">
            <div class="main-image">
                <img src="<?=asset("images/uploads/".$data["images"])?>" alt="image">
            </div>
            <div class="gallery-image">

            </div>
        </div>
        <div class="catalog-product-information">
            <h1><?=$data["name"]?></h1>
            <p><?=$data["description"]?></p>
            <span class="product-sub-cat">Размерный ряд</span>
            <div class="size-table">
                <?php

                    foreach ($sizes as $s):
                        $not = "";
                        if($s["amount"] < 1) $not = "not";
                        echo("<div class='size $not'>".$s["name"]."</div>");
                    endforeach;
                ?>
            </div>
            <span class="product-price"><?=$data["price"]?></span>
            <div class="product-actions">
                <a>Купить</a>
                <a>В корзину</a>
            </div>
        </div>

</div>

<!--

<div class="products-wrapper-element">
    <?php
    /** @var mixed $data */
    if(file_exists("images/uploads/".$data["images"])):
        ?>
        <div class="products-wrapper-element-image" style="background-image: url('<?=asset("images/uploads/".$data["images"])?>')"></div>
    <?php
    else:
        ?>
        <div class="products-wrapper-element-image" style="background-image: url('<?=asset("images/no_photo.jpg")?>')"></div>
    <?php
    endif;
    ?>
    <div class="products-wrapper-element-information">
        <span class="products-wrapper-element-name"><?=$data["name"]?></span>
        <span class="products-wrapper-element-name"><?=$data["price"]?> ₽</span>
    </div>
</div>

-->