<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

?>

<div class="col l-9 main__admin">
    <h1>Quản lý banner</h1>
    <a href="<?=BASE_PATH."/admin/banners/add/"?>">
        <button class="addProduct" name="addProduct">Add</button>
    </a>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>Bộ sưu tập</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Đường dẫn</th>
                <th>Hiển thị</th>
                <th>Nút</th>
                <th>background</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body">
                <?php
                if(isset($data['banners'])) :
                    $banners = $data['banners'];
                    foreach($banners as $item):
                        extract($item);
                        // print_r($item);  
                ?>
                <tr class="manager-list">
                    <td class="manager-name">
                        <span><?=$collection?></span>
                    </td>
                    <td class="manager-img">
                        <img src="<?=BASE_PATH.'/'.$img?>">
                    </td>
                    <td class="manager-price">
                        <span><?=$title?></span>
                    </td>
                    <td class="manager-price line-champ-3">
                        <span><?=$des?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$link?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$banner_show?></span>
                    </td>
                    <td class="manager-name">
                        <span><?=$action?></span>
                    </td>
                    <td class="manager-img">
                        <img src="<?=BASE_PATH.'/'.$background?>">
                    </td>
                    <td class="manager-action">
                        <a href="<?=BASE_PATH.'/admin/banners/delete/'.$id?>" class="bill_delete">
                            <div class="manager-action-item">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                        <a href="<?=BASE_PATH.'/admin/banners/update/'.$id?>" class="manager-action-item bill_detail">
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