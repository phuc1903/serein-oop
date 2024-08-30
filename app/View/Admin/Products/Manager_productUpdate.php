<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

// print_r($data['categories']);
if(isset($data['product'])):
$product = $data['product'];
extract($product);
// print_r($product);
?>
                <form action="<?=BASE_PATH.'/admin/products/update/'.$id?>" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
                    <h1>Sửa sản phẩm</h1>
                    <div class="main_admin-item">
                        <div class="main__admin-avatar">
                            <img id="avatar" src="<?=BASE_PATH.'/'.$img?>" alt="">
                        </div>
                        <div class="main__admin-right">
                            <!-- <div class="main__admin-name">Đinh Trọng Phúc</div> -->
                            <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Sửa ảnh</div>
                            <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="img" id="typeFile" hidden onchange="previewImage(this);">
                        </div>  
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm"  value="<?=$name?>">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="email">Giá sản phẩm</label>
                            <input type="text" name="price" id="email" placeholder="Giá sản phẩm" value="<?=$price?> VNĐ">
                        </div>
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="phone">Mô tả</label>
                            <input type="text" id="phone" name="description" placeholder="Nhập mô tả sản phẩm" value="<?=$description?>">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="address">Số lượng</label>
                            <input type="number" id="address" name="quantity" placeholder="Số lượng sản phẩm" value="<?=$default_quantity?>">
                        </div>
                    </div>
                    <select name="category" id=""  style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                        <?php
                            if(isset($data['categories'])):
                                foreach($data['categories'] as $item):
                                    extract($item);
                        ?>
                        <option value="<?=$id?>"><?=$name?></option>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    </select>
                    <div class="main__admin-btn-action">
                        <button type="submit" name="UpdateProduct" class="btn-admin">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php
endif;
include_once __DIR__."/../../Layout/Footer.php";