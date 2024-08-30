<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

// print_r($data['categories']);

?>
                <form action="<?=BASE_PATH.'/admin/products/add'?>" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
                    <h1>Thêm sản phẩm</h1>
                    <div class="main_admin-item">
                        <div class="main__admin-avatar">
                            <img id="avatar" src="" alt="">
                        </div>
                        <div class="main__admin-right">
                            <!-- <div class="main__admin-name">Đinh Trọng Phúc</div> -->
                            <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thêm ảnh</div>
                            <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="img" id="typeFile" hidden onchange="previewImage(this);">
                        </div>  
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm"  value="">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="email">Giá sản phẩm</label>
                            <input type="text" name="price" id="email" placeholder="Giá sản phẩm">
                        </div>
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="phone">Mô tả</label>
                            <input type="text" id="phone" name="description" placeholder="Nhập mô tả sản phẩm">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="address">Số lượng</label>
                            <input type="number" id="address" name="quantity" placeholder="Số lượng sản phẩm">
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
                        <!-- <a href="<?=BASE_PATH.'/user/save/'.$_SESSION['user']['id']?>" class="main__admin-btn-item"><button class="btn-admin">Thêm sản phẩm</button></a> -->
                        <button type="submit" name="AddProduct" class="btn-admin">Thêm sản phảm</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php

include_once __DIR__."/../../Layout/Footer.php";