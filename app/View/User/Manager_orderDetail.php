<?php

include_once __DIR__."/../Layout/Header.php";
include_once __DIR__."/../Admin/Layouts/header_admin.php";

// print_r($data['bill']);

?>

<div class="col l-9 main__admin">
    <h1>Danh sách sản phẩm trong đơn hàng</h1>
    <a href="<?=BASE_PATH.'/user/order/'.$_SESSION['user']['id']?>">
        <button class="addProduct" name="addProduct">Trở về đơn hàng</button>
    </a>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng giá</th>
                <!-- <th>Hành động</th> -->
            </tr>
            <tbody class="manager-body">
                <?php
                if(isset($data['orderDetail'])) :
                    // print_r($data['orderDetail']);
                    $orderDetail = $data['orderDetail'];
                    foreach($orderDetail as $item):
                        extract($item);
                ?>
                <tr class="manager-list">
                    <td class="manager-name">
                        <span><?=$product_name?></span>
                    </td>
                    <td class="manager-img">
                        <img src="<?=BASE_PATH.'/'.$product_img?>">
                    </td>
                    <td class="manager-createDay">
                        <span><?=$product_description?></span>
                    </td>
                    <td class="manager-price">
                        <span><?= number_format($product_price)?> VNĐ</span>
                    </td>
                    <td class="manager-price">
                        <span><?=$quantity?></span>
                    </td>
                    <td class="manager-status">
                        <span><?=number_format($price_product)?></span>
                    </td>
                    <!-- <td class="manager-action">
                        <a href="<?=BASE_PATH.'/admin/orders/detail/delete/'.$id?>" class="bill_delete">
                            <div class="manager-action-item">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                        <a style="margin: 0 12px;" href="<?=BASE_PATH.'/admin/orders/detail/update/'.$id?>" class="manager-action-item bill_detail">
                            <div class="manager-action-item">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </div>
                        </a>
                    </td> -->
                </tr>
                <?php 
                endforeach;
                endif;
                ?>
            </tbody>
        </table>
        <hr>
    </div>
</div>