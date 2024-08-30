<section class="product container">
    <div class="grid wide">
        <div class="product-section">
            <h3>Sản phẩm mới</h3>
            <?= $this->gotoShop();?>
        </div>
        <div class="row">
            <?php

            $products_new = $data['product_new'];

            foreach ($products_new ?? [] as $item):
                extract($item);
                echo $this->htmlProductShow($id, $img, $name, $price);
            endforeach; ?>
        </div>
    </div>
</section>