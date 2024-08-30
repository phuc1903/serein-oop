<?php

include_once __DIR__."/../Layout/Header.php";

?>


<div class="summary container">
    <div class="grid wide summary__box">
        <div class="row">
            
        <?php

        $product = $data['product'];
        extract($product);
        $price_new = number_format($price, 3, '.', '.' );
        ?>
            <div class="col l-6 summary-images">
                <img src="<?=BASE_PATH?>/<?=$img?>" alt="" class="img-main" onclick="handleThumbnailClick(event)">
                <div class="listimg listimg-sizes">
                    <?php
                    $thumbnails = $data['product_thumbnails'];

                    // print_r($thumbnails);

                    for ($i = 0; $i < 4; $i++) {
                        if (isset($thumbnails[$i])) {
                            $thumbnail = $thumbnails[$i];
                            extract($thumbnail);
                            ?>
                            <img src="<?=BASE_PATH?>/<?=$img?>" alt="" class="thumbnails-item" onclick="changeImage(this)">
                            <?php
                        } else {
                            ?>
                            <img src="<?=BASE_PATH?>/<?=IMG_DEFAULT?>" alt="" class="thumbnails-item" onclick="changeImage(this)">
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

        <div class="col l-6 summary-content">
            <div class="summary-content-name "><?=$name?>
                <!-- <div class="summary-content-vote">
                    5.0
                </div> -->
            </div>

            <div class="summary-content-price"><?=$price_new?> VNĐ</div>
            <div class="summary-content-desciption">
                <?=$description?>
            </div>
            <div class="summary-content-sizes">
                <span class="summary-content-size">
                    <span>size</span>
                    <div>
                        <?php
                        $sizes = $data['product_sizes'];
                        // print_R($sizes);
                        foreach($sizes as $item):
                            extract($item);
                        ?>

                        <p><?=$size_name?></p>

                        <?php endforeach; ?>
                    </div>

                </span>
            </div>
            <div class="detailquantity">
                <div class="detailquantity__quantity">
                    <!-- <p class="detailquantity__quantity-text">2 in stock</p> -->
                    <div class="detailquantity__quantity__updown">
                        <div id="pre-quantity" class="quantity__minus detail-pre">-</div>
                        <input type="text" value="1" id="quantity-input" data-default-quantity="<?=$default_quantity?>" class="quantity__value product_quantity" style="text-align: center;">
                        </input>
                        <div id="add-quantity" class="quantity__add detail-add">+</div>
                    </div>

                </div>
                <div class="detailquantity__cart">
                    <?php
                    $product = $data['product'];
                    extract($product);
                    ?>
                    <a href="<?=BASE_PATH?>/order/<?=$id?>">
                        <button type="button" class="detailquantity__buy">Mua ngay</button>
                    </a>
                    <a id="add-cart">
                        <button class="detailquantity__addtocart add-cart" data-productid="<?=$product_id?>">Thêm giỏ hàng</button>
                    </a>
                </div>
                <div class="Category">
                    Category:
                    <div class="detail__Category">
                    <?php
                        $product_category = $data['product_category'];
                        $totalCategories = count($product_category);
                        
                        foreach ($product_category as $key => $item):
                            extract($item);
                    ?>
                        <div class="detail__Category__type"><?= htmlentities($cate_name, ENT_QUOTES, 'UTF-8') ?><?php echo ($key < $totalCategories - 1) ? ' ,' : ''; ?> </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="product container">
    <div class="grid wide">
        <div class="product-section">
            <h3>Sản phẩm liên quan</h3>
            <?= $this->gotoShop()?>
        </div>
        <div class="row">
            <?php
            $products_new = $data['product_view'];
            foreach ($products_new as $item):
                extract($item);
                echo $this->htmlProductShow($id,$img,$name,$price);
            endforeach; ?>
        </div>
    </div>
</section>

<?php

include_once __DIR__ . "/../Aveluate.php";
include_once __DIR__."/../Layout/Footer.php";

?>