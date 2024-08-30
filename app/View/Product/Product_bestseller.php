<section class="product container">
    <div class="grid wide">
        <div class="product-section">
            <h3>Sản phẩm bán chạy</h3>
            <?= $this->gotoShop()?>
        </div>
        <div class="row">
            <?php

            $products_bestseller = $data['product_bestseller'];

            foreach ($products_bestseller ?? [] as $item):
                extract($item);
                echo $this->htmlProductShow($id, $img, $name, $price);
            endforeach;
            ?>
        </div>
    </div>
</section>