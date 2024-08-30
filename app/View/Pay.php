<?php

include_once "Layout/Header.php";

?>

<div class="summary container cart methodpay">
    <div class="grid wide">
        <div class="row">
            <?php 
            if(isset($data['product'])):
                $product = $data['product'];
                // print_r($product);
                extract($product);
                $quantity = 1;
            ?>
            <div class="col l-8">
                <div class="col l-12 cart__list__product">
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
                                    <div class="product__size row">
                                        <div class="size">Size: </div>
                                        <div class="product__size__item">XL</div>
                                    </div>
                                </div>
    
                                <div class="information__choice">
                                    <a href="<?=BASE_PATH?>/cart/delete/<?=$id?>" class="information__choice-btn choice__remove">Xóa</a>
                                </div>
                            </div>
                            <!-- price and quantity -->
                            <div class="information__quantity">
                                <div class="choice__price">
                                    <div class="price__value"><?= number_format($price)?></div>
                                    <div class="price__usa">VNĐ </div>
                                </div>
                                <!-- quantity -->
                                <div class="choice__quantity">
                                    <a class="<?=$bill_quantity <= 1 ? 'disableds' : ''?>" tabindex="-1" href="<?=BASE_PATH?>/cart/<?=$bill_id?>/<?=$product_id?>/subtract"><div class="quantity__minus">-</div></a>
                                    <div class="quantity__value"><?=$quantity?></div>
                                    <a class="<?=$bill_quantity == $product_quantity ? 'disableds' : ''?>" tabindex="-1" href="<?=BASE_PATH?>/cart/<?=$bill_id?>/<?=$product_id?>/add"><div class="quantity__add">+</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l-12 ">
                    <label class="label--big">Phương thức giao hàng</label>
                    <div class="input__pay pay__sizem">
                        <input type="text" name="name" placeholder="Họ và tên">
                    </div>
                    <div class="input__pay input__pay--mod pay__sizem">
                        <input type="text" name="phone" class="phone__pay " placeholder="Nhập số điện thoại">
                        <input type="email" name="email" class="email__pay " placeholder="Nhập email">
                    </div>
                    <div class="input__pay pay__sizem">
                        <input type="text" name="address" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="input__pay pay__sizem">
                        <input type="text" name="note" placeholder="Ghi chú">
                    </div>
                    <!-- <lable class="label--big">Phương thức thanh toán</lable>
                    <div class="input__pay pay__sizem">
                        <input type="text" placeholder="Thanh toán bằng tiền mặt">
                    </div>
                    <div class="input__pay pay__sizem">
                        <input type="text" placeholder="Thanh toán bằng ZaloPay">
                    </div>
                    <div class="input__pay pay__sizem">
                        <input type="text" placeholder="Thanh toán momo">
                    </div>
                    <div class="input__pay pay__sizem">
                        <input type="text" placeholder="Thanh toán bằng ATM">
                    </div> -->
                </div>
            </div>
            <div class="col l-4 cart__pay">
            <?php

                $total = $price - SHIPPING_FEE;
                $totalFormat = number_format($total, 3, '.', '.');
                $priceFormat = number_format($price, 3, '.', '.');
                $shippingFeeFormat = number_format(SHIPPING_FEE, 3, '.', '.');
                ?>
                <div class="cart__pay__box">
                    <div class="pay__voucher">
                        <label for="" class="text__voucher ">Nhập mã giảm giá</label>
                        <div class="value__voucher">
                            <input type="text" placeholder="Add coupon">
                            <button type="button">Apply</button>
                        </div>
                    </div>
                    <div class="totalprice">
                        <div class="cart__pay__price">
                            <div class="product__price">
                                <label for="" class="text">Giá sản phẩm</label>
                                <div class="box__price">
                                    <div class="price"><?=$priceFormat?></div>
                                    <div class="usas">VND</div>
                                </div>
                            </div>
                            <!-- ship -->
                            <div class="product__price">
                                <label for="" class="text">Phí giao hàng</label>
                                <div class="box__price">
                                    <div class="price"><?=$shippingFeeFormat?></div>
                                    <div class="usas">VNĐ</div>
                                </div>
                            </div>
                            <!-- voucher -->
                            <div class="product__price">
                                <label for="" class="text">Giảm giá</label>
                                <div class="box__price">
                                    <div class="price">0</div>
                                    <div class="usas">VND</div>
                                </div>
                            </div>
                            <hr class="hr__pay">
                            <div class="product__price">
                                <label for="" class="text text--bold">Tổng tiền</label>
                                <div class="box__price">
                                    <div class="price text--bold"><?=$totalFormat?></div>
                                    <div class="usas usas--m">VND</div>
                                </div>
                            </div>

                            <!-- button thanh toan -->
                            <button type="button" class="btn__pay"><a href="method_pay.html">Thanh
                                    toán</a></button>

                            <div class="link">
                                <img src="asset/img/post1.png" alt="">
                                <img src="asset/img/post1.png" alt="">
                                <img src="asset/img/post1.png" alt="">
                                <img src="asset/img/post1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>
        </div>

    </div>
</div>

<?php

include_once "Aveluate.php";
include_once "Layout/Footer.php";
