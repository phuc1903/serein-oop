<?php

include_once __DIR__.'/../Layout/Header.php';
include_once __DIR__.'/../Admin/Layouts/header_admin.php';
// print_r($_SERVER);
?>
                <div class="col l-9 main__admin">
                    <h1>Hồ sơ chi tiết</h1>
                    <h1 id="message_err" style="color: red; font-size: 16px;"></h1>
                    <div class="main_admin-item">
                        <div class="main__admin-avatar">
                            <img id="avatar" src="<?=BASE_PATH?>/<?= isset($_SESSION['user']) ? $_SESSION['user']['avatar'] : 'Public/img/default.jpg'; ?>" alt="">
                        </div>
                        <div class="main__admin-right">
                            <div class="main__admin-name">Đinh Trọng Phúc</div>
                            <button class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thay đổi ảnh</button>
                            <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="avatar" id="typeFile" hidden onchange="previewImage(this);">
                        </div>  
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="name">Họ và tên</label>
                            <input type="text" id="name" name="name" placeholder="<?= isset($_SESSION['user']['user_name']) ? $_SESSION['user']['user_name'] : "" ?>"  value="<?=$_SESSION['user']['user_name']?>">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" placeholder="<?=$_SESSION['user']['email']?>" value="<?=$_SESSION['user']['email']?>">
                        </div>
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" placeholder="<?=$_SESSION['user']['phone']?>" value="<?=$_SESSION['user']['phone']?>">
                        </div>
                        <div class="col l-6 main__admin-input-item">
                            <label for="address">Địa chỉ</label>
                            <input type="text" id="address" name="address" placeholder="<?=$_SESSION['user']['address']?>" value="<?=$_SESSION['user']['address']?>">
                        </div>
                    </div>
                    <div class="main__admin-inputs">
                        <div class="col l-6 main__admin-input-item">
                            <label for="sex">Giới tính</label>
                            <input type="text" id="sex" name="sex" placeholder="<?=$_SESSION['user']['sex']?>" value="<?=$_SESSION['user']['sex']?>">
                        </div>
                    </div>
                    <div class="main__admin-btn-action">
                        <a  class="main__admin-btn-item saveInfo"><button class="btn-admin">Lưu thay đổi</button></a>
                        <a href="<?=BASE_PATH."/ressetPassword"?>" class="main__admin-btn-item resset_pass"><button class="btn-admin">Quên mật khẩu</button></a>
                        <!-- <a class="main__admin-btn-item"><button class="btn-admin">Hủy</button></a> -->
                        <?php if(isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1): ?>
                        <a class="main__admin-btn-item"><button type="submit" name="UserSave" class="btn-admin">Admin</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php

include_once __DIR__."/../Layout/Footer.php";