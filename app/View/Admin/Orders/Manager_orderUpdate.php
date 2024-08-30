<?php

include_once __DIR__.'/../../Layout/Header.php';
include_once __DIR__.'/../Layouts/header_admin.php';

// print_r($data['categories']);
    if(isset($data['order'])):
    $order = $data['order'];
    // extract($order);
// print_r($product);
?>
                <form method="post" class="col l-9 main__admin" enctype="multipart/form-data">
                    <h1>Update đơn hàng</h1>
                    <!-- <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="email">Giá đơn hàng</label>
                            <input type="text" name="price" id="email" placeholder="Giá đơn hàng" value="<?=number_format($price_product)?> VNĐ">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="address">Số lượng</label>
                            <input type="number" id="address" name="quantity" placeholder="Số lượng đơn hàng" value="<?=$quantity?>">
                        </div>
                    </div> -->
                    <select id="status" data-id-order="<?=$order["id"]?>" name="status" id=""  style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                        <option value="<?=$data['status_now']['status_id']?>"><?=$data['status_now']['name']?></option>
                        <?php
                            if(isset($data['status'])):
                                foreach($data['status'] as $item):
                                    extract($item);
                        ?>
                        <option class="status_order" value="<?=$id?>"><?=$name?></option>
                        <?php
                                endforeach;
                            endif; 
                        ?>
                    </select>
                    <div class="main__admin-btn-action">
                        <button id="btn-save-status" type="button" name="UpdateOrder" class="btn-admin">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php
endif;
include_once __DIR__."/../../Layout/Footer.php";