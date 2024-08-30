<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

?>

<div class="col l-9 main__admin">
    <h1>Quản lý sản phẩm</h1>
    <a href="<?=BASE_PATH."/admin/products/add/"?>">
        <button class="addProduct" name="addProduct">Add</button>
    </a>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ngày tao</th>
                <th>Update</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body">
                <?php
                if(isset($data['products'])) :
                    $products = $data['products'];
                    foreach($products as $item):
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
                        <span><?=number_format($price)?> VNĐ</span>
                    </td>
                    <td class="manager-status">
                        <span><?=$default_quantity?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$created_at?></span>
                    </td>
                    <td class="manager-updateDay">
                        <span><?=$updated_at?></span>
                    </td>
                    <td class="manager-option">
                        <?php
                        $arrayCate = explode(',', $all_categories);

                        // print_r($arrayCate);
                        ?>
                        <select name="category">
                            <?php foreach ($arrayCate as $category): ?>
                                <option value="<?=$category?>"><?=$category?></option>
                            <?php endforeach; ?>
                        </select>
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
        <div class="pagination" style="margin-top: 20px;">
            <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                <a class="<?= $data['currentPage'] == $i ? 'active' : '' ?>" href="<?= BASE_PATH ?>/admin/products/pagi/<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</div>

<?php

include_once __DIR__."/../../Layout/Footer.php";