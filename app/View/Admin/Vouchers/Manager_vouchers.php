<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

?>

<div class="col l-9 main__admin">
    <h1>Quản lý Voucher</h1>
    <a href="<?=BASE_PATH."/admin/vouchers/add/"?>">
        <button class="addProduct" name="addProduct">Add</button>
    </a>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>code</th>
                <th>Hình ảnh</th>
                <th>discount_type</th>
                <th>discount_value</th>
                <th>discount_max</th>
                <th>quantity</th>
                <th>user_count</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body">
                <?php
                if(isset($data['vouchers'])) :
                    $vouchers = $data['vouchers'];
                    foreach($vouchers as $item):
                        extract($item);
                        // print_r($item);  
                ?>
                <tr class="manager-list">
                    <td class="manager-name">
                        <span><?=$code?></span>
                    </td>
                    <td class="manager-img">
                        <img src="#">
                    </td>
                    <td class="manager-price">
                        <span><?=$discount_type?></span>
                    </td>
                    <td class="manager-price">
                        <span><?=$discount_value?></span>
                    </td>
                    <td class="manager-price">
                        <span><?=$discount_max?></span>
                    </td><td class="manager-price">
                        <span><?=$quantity?></span>
                    </td><td class="manager-price">
                        <span><?=$user_count?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$day_start?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$day_end?></span>
                    </td>
                    
                    <td class="manager-action">
                        <a href="<?=BASE_PATH.'/admin/vouchers/delete/'.$id?>" class="bill_delete">
                            <div class="manager-action-item">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                        <a href="<?=BASE_PATH.'/admin/vouchers/update/'.$id?>" class="manager-action-item bill_detail">
                            <div class="manager-action-item">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </div>
                        </a>
                    </td>
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

<?php

include_once __DIR__."/../../Layout/Footer.php";