<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

// print_r($data['categories']);
if(isset($data['category'])):
$category = $data['category'];
extract($category);
// print_r($category);
?>
                <form action="<?=BASE_PATH.'/admin/categories/update/'.$id?>" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
                    <h1>Sửa danh mục</h1>
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
                            <label for="name">Tên danh mục</label>
                            <input type="text" id="name" name="name" placeholder="Nhập tên danh mục"  value="<?=$name?>">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="phone">Mô tả</label>
                            <input type="text" id="phone" name="description" placeholder="Nhập mô tả danh mục" value="<?=$description?>">
                        </div>
                    </div>
                    <select name="status" id=""  style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                        <option value="Đang hoạt động">Đang hoạt động</option>
                        <option value="Ngưng hoạt động">Ngưng hoạt động</option>
                    </select>
                    <div class="main__admin-btn-action">
                        <button type="submit" name="UpdateCategory" class="btn-admin">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php
endif;
include_once __DIR__."/../../Layout/Footer.php";