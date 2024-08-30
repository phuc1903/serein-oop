<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

?>

<div class="col l-9 main__admin">
    <h1>Quản lý tài khoản khách hàng</h1>
    <a href="<?=BASE_PATH."/admin/users/add/"?>">
        <button class="addProduct" name="addProduct">Add</button>
    </a>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>Tên sản khách hàng</th>
                <th>Hình ảnh</th>
                <th>email</th>
                <th>Admin</th>
                <th>Phone</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body">
                <?php
                if(isset($data['users'])) :
                    $users = $data['users'];
                    foreach($users as $item):
                        extract($item);
                        // print_r($item);  
                ?>
                <tr class="manager-list">
                    <td class="manager-name">
                        <span><?=$user_name?></span>
                    </td>
                    <td class="manager-img">
                        <img src="<?=BASE_PATH.'/'.$avatar?>">
                    </td>
                    <td class="manager-price">
                        <span><?=$email?></span>
                    </td>
                    <td class="manager-price">
                        <span><?=$is_admin?></span>
                    </td>
                    <td class="manager-status">
                        <span><?=$phone?></span>
                    </td>
                    <td class="manager-status">
                        <span><?=$address?></span>
                    </td>
                    <td class="manager-status">
                        <span><?=$sex?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$created_at?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$updated_at?></span>
                    </td>
                    <td class="manager-action">
                        <a href="<?=BASE_PATH.'/admin/products/delete/'.$id?>" class="bill_delete">
                            <div class="manager-action-item">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                        <a href="<?=BASE_PATH.'/admin/products/update/'.$id?>" class="manager-action-item bill_detail">
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