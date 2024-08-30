<section class="product container">
    <div class="grid wide">
        <div class="product-section">
            <h3>Sản phẩm được yêu thích</h3>
            <?= $this->gotoShop('Đi đến shop'); ?>
        </div>
        <div class="row">
            <?php

            $products_like = $data['product_like'];

            foreach ($products_like ?? [] as $item):
                extract($item);
                echo $this->htmlProductShow($id, $img, $name, $price);
            endforeach;
            ?>
        </div>
    </div>
</section>