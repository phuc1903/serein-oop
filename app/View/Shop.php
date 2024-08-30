<?php
// print_r($_SESSION);

include_once "Layout/Header.php";
?>
<section class="products-sidebar container">
    <div class="grid wide">
        <div class="row">
            <div class="col l-3 sidebar">
                <div class="sidebar-main">
                    <form action="<?=BASE_PATH.'/shop/search'?>" method="post" class="form-search-sidebar">
                        <input type="text" placeholder="Tìm kiếm" name="search">
                        <button type="submit" name="productSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <h1>Danh mục</h1>
                    <div class="list-category">
                        <?php
                        $categories = $data['categories'];

                        foreach($categories as $item):
                            extract($item);
                            ?>
                        <p><a href="<?=BASE_PATH?>/shop/category/<?=$id?>"><?=$name?></a></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col l-9">
                <!-- <div class="product-section">
                    <h3>Show product 1 - 9 of 55 results</h3>
                    <span><a href="index.php?page=shop">Đi đến shop</a></span>
                </div> -->
                <div class="row">
                    <?php
                    $products = $data['products'];

                    foreach($products ?? [] as $product){
                        extract($product); 
                        echo $this->htmlProductShop($id, $img, $name, $price);
                    }
                    ?>
                </div>
                <div class="pagination">
                    <?php
                    $idCategory = $data['idCategory'];
                    if($idCategory > 0) {
                        for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                            <a class=" <?=$_SERVER['REQUEST_URI'] == BASE_PATH .'/shop/category/'.$idCategory.'/pagi/'.$i ? 'active' : ' '?>" href="<?= BASE_PATH ?>/shop/category/<?= $idCategory ?>/pagi/<?= $i ?>"><?= $i ?></a>
                        <?php endfor ?>
                    <?php
                    }
                    else {
                        for ($i = 1; $i <= $data['countProduct']; $i++) : ?>
                            <a class=" <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/shop/pagi/'.$i  ? 'active': ' '?>" href="<?= BASE_PATH ?>/shop/pagi/<?= $i ?>"><?= $i ?></a>
                        <?php endfor ?>
                    <?php }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once "Layout/Footer.php";
?>