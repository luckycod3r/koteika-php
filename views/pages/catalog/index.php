<div class="products-wrapper">
    <?php
    /** @var mixed $data */
    /** @var array $images */
    foreach ($data as $product):
    ?>
    <a href="<?= url("catalog/".$product["id"]) ?>">
        <div class="products-wrapper-element">
                <?php
                    if(file_exists("images/uploads/".$product["images"])):
                ?>
                    <div class="products-wrapper-element-image" style="background-image: url('<?=asset("images/uploads/".$product["images"])?>')"></div>
                <?php
                    else:
                ?>
                    <div class="products-wrapper-element-image" style="background-image: url('<?=asset("images/no_photo.jpg")?>')"></div>
                <?php
                    endif;
                ?>
            <div class="products-wrapper-element-information">
                <span class="products-wrapper-element-name"><?=$product["name"]?></span>
                <span class="products-wrapper-element-name"><?=$product["price"]?> ₽</span>
            </div>
        </div>
    </a>
    <?php
        endforeach;
    ?>
</div>