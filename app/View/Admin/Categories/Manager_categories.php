<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

?>

<div class="col l-9 main__admin">
    <h1>Quản lý danh mục</h1>
    <a href="<?=BASE_PATH."/admin/categories/add/"?>">
        <button class="addProduct" name="addProduct">Add</button>
    </a>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>Tên danh mục</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>status</th>
                <th>Ngày tao</th>
                <th>Update</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body">
                <?php
                if(isset($data['categories'])) :
                    $categories = $data['categories'];
                    foreach($categories as $item):
                        extract($item);
                        // print_r($item);  
                ?>
                <tr class="manager-list">
                    <td class="manager-name">
                        <span><?=$name?></span>
                    </td>
                    <td class="manager-img">
                        <img src="<?=BASE_PATH.'/'.$img?>">
                    </td>
                    <td class="manager-price">
                        <span><?=$description?></span>
                    </td>
                    <td class="manager-price">
                        <span><?=$status?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$created_at?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$updated_at?></span>
                    </td>
                    <td class="manager-action">
                        <a href="<?=BASE_PATH.'/admin/categories/delete/'.$id?>" class="bill_delete">
                            <div class="manager-action-item">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                        <a href="<?=BASE_PATH.'/admin/categories/update/'.$id?>" class="manager-action-item bill_detail">
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