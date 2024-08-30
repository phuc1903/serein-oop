<?php

include_once __DIR__."/../Layout/Header.php";
include_once __DIR__."/../Admin/Layouts/header_admin.php";

// print_r($data['bill']);

if(isset($data['orders'])) {
    $orders = $data['orders'];
}

?>

<div class="col l-9 main__admin">
    <h1>Đơn hàng của bạn</h1>
    <form action="<?=BASE_PATH."/shop"?>" method="post">
        <button class="addProduct" name="addProduct">Add</button>
    </form>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>STT</th>
                <th>Hình khách hàng</th>
                <th>email</th>
                <th>Tổng giá</th>
                <th>Trạng thái</th>
                <th>Ngày thanh toán</th>
                <th>Voucher</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body">
                <?php

                foreach($orders as $index => $item):
                    extract($item);

                ?>
                <tr class="manager-list">
                    <td class="manager-name"><span><?=$index?></span></td>
                    <td class="manager-img">
                    <img src="<?=BASE_PATH?>/<?=$avatar?>">
                </td>
                    <td class="manager-price"><span><?=$email?></span></td>
                    <td class="manager-name"><span><?=number_format($total_price)?> VNĐ</span></td>
                    <td class="manager-name"><span><?=$status_now?></span></td>
                    <td class="manager-createDay"><span><?=$day_create?></span></td>
                    <td class="manager-name"><span><?=$voucher != "" ? $voucher : "Không có"?></span></td>
                    <td class="manager-action">
                        <a href="<?=BASE_PATH?>/user/order/detail/<?=$order_id?>" class="manager-action-item bill_detail">
                            <button name="bill_detail" class="bill_detail-item">Detail</button>
                        </a>
                    </td>
                </tr>
                <?php

                endforeach;

                ?>
            </tbody>
        </table>
        <hr>
    </div>
</div>