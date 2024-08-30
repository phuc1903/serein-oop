<?php

include_once "Layout/Header.php";

?>

                
<div class="summary container cart">
    <div class="grid wide">
        <div id="cart">
            <?php
            // print_r($_SESSION['carts']);
                
            ?>
            <div id="carts" class="row">
                <div class="col l-8 cart__list__product">
                    
                    <?php
                    $totalPrices = 0;
                    $total = 0;
                    if(!isset($_SESSION['carts']) || $_SESSION['carts'] == []) {
                        echo "<h1>Giỏ hàng rỗng</h1>";
                    }
                        if(isset($_SESSION['carts'])):
                            $carts = $_SESSION['carts'];
                            
                            // print_r($_SESSION);
                            // unset($_SESSION['carts']);
                            foreach($carts as $item => $cart):
                                extract($cart);
                                $totalPrice = $cart_quantity * $price;
                    ?>

                    <div class="product__item">
                        <!-- img -->
                        <div class="product__item__img">
                            <img src="<?=BASE_PATH?>/<?=$img?>" alt="">
                        </div>
                        <div class="product__item-right">
                            <div class="product__item__infomation">
                                <!-- information  -->
                                <div class="information__name">
                                    <div class="name line-champ-1"><?=$name?></div>
                                </div>

                                <div class="information__choice">
                                    <a data-cart-id="<?=$id?>" class="information__choice-btn choice__remove cart-delete">Xóa</a>
                                    <!-- <a href="<?=BASE_PATH?>/cart/<?=$bill_id?>/<?=$product_id?>/like" class="information__choice-btn choice__like">Yêu thích</a> -->
                                </div>
                            </div>
                            <!-- price and quantity -->
                            <div class="information__quantity">
                                <div class="choice__price">
                                    <div class="price__value" data-price="<?=$price?>"><?=number_format($totalPrice, 0, '.', '.')?></div>
                                    <div class="price__usa">VNĐ </div>
                                </div>
                                <!-- quantity -->
                                <div class="choice__quantity">
                                    <a class="pre-quantity-cart" onclick="PreQuantity(this)"><div class="quantity__minus">-</div></a>
                                    <input class="quantity__value input-quantity-cart" onkeyup="CheckQuantity(this)" data-default-quantity="<?=$default_quantity?>" data-id="<?= $id ?>" value="<?= $cart_quantity ?>"></input>
                                    <a class="add-quantity-cart" onclick="AddQuantity(this)" class=""><div class="quantity__add">+</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $totalPrices += $totalPrice;
                    endforeach;

                    
                    if (isset($_SESSION['voucher'])) {
                        if($_SESSION['voucher']['discount_type'] === "amount") {
                            $discount = $_SESSION['voucher']['discount_value'];
                        }else {
                            if($_SESSION['voucher']['discount_max'] <= 0 ) {
                                $discount = ($totalPrices + SHIPPING_FEE) * $discount / 100;
                            }
                            else {
                                $discount = min(($totalPrices + SHIPPING_FEE) * $discount / 100, $_SESSION['voucher']['discount_max']);
                            }
                        }
                        $total = $totalPrices + SHIPPING_FEE - $discount;
                    }else {
                        $total = $totalPrices + SHIPPING_FEE;
                    }
                    endif;
                    ?>
                </div>
                <div class="col l-4 cart__pay">
                        <div class="cart__pay__box">
                            <form method="post" class="pay__voucher">
                                <label for="" class="text__voucher ">Nhập mã giảm giá</label>
                                <div class="value__voucher">
                                    <input type="text" placeholder="<?=isset($_SESSION['voucher']) ? $_SESSION['voucher']['code'] : 'Nhập voucher' ?> " id="code-voucher" name="voucher">
                                    <button type="button" id="add-voucher" name="addVoucher">Áp dụng</button>
                                </div>
                                <div class="voucher-err error"></div>
                            </form>
                            <form method="post" class="totalprice">
                                <div class="cart__pay__price">
                                    <div class="product__price">
                                        <label for="" class="text">Giá sản phẩm</label>
                                        <div class="box__price">
                                            <div class="price price-total"><?=number_format($totalPrices)?></div>
                                            <div class="usas">VNĐ</div>
                                        </div>
                                    </div>
                                    <!-- ship -->                            
                                    <div class="product__price">
                                        <label for="" class="text">Phí giao hàng</label>
                                        <div class="box__price">
                                            <div class="price"><?=number_format(SHIPPING_FEE)?></div>
                                            <div class="usas">VNĐ</div>
                                        </div>
                                    </div>
                                    <!-- voucher -->
                                    
                                    <div class="product__price">
                                        <label for="" class="text">Giảm giá</label>
                                        <div class="box__price">
                                            <div class="price price-voucher" data-discount="<?=isset($discount) ? $discount : 0?>">- <?=isset($discount) ? $discount : 0?></div>
                                            <div class="usas">VNĐ</div>
                                        </div>
                                    </div>
                                    <hr class="hr__pay">
                                    <div class="product__price">
                                        <label for="" class="text text--bold">Tổng tiền</label>
                                        <div class="box__price">
                                            <div class="price text--bold"><?=number_format($total)?></div>
                                            <div class="usas usas--m">VNĐ</div>
                                        </div>
                                    </div>
                                    <!-- button thanh toan -->
                                    <button type="button" name="pay" id="btn-pay" class="btn__pay"><a>Thanh toán</a></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


<?php

include_once "Form_home.php";
include_once "Aveluate.php";
include_once "Layout/Footer.php";
?>