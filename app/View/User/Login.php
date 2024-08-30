<?php include_once __DIR__ . "/../Layout/Header.php"; ?>

<form method="POST" id="login-form" class="form-main">
    <div class="input-form-with">
        <i class="fa-brands fa-square-facebook"></i>
        <span>Đăng nhập với google</span>
    </div>
    <div class="input-form-with">
        <i class="fa-brands fa-square-facebook"></i>
        <span>Đăng nhập với facebook</span>
    </div>
    <div class="input-form-item">
        <input type="text" placeholder="Nhap email" id="email" class="email" name="email" autocomplete="current-email">
        <div class="error" id="email_err"></div>
    </div>
    <div class="input-form-item">
        <input type="password" placeholder="Nhập mật khẩu" id="password" class="password" name="password" autocomplete="current-password">
        <div class="error" id="password_err"></div>
    </div>
    <div id="message" class="error"></div>
    <div class="input-form-item">
        <button type="button" id="login-btn">Đăng nhập</button>
    </div>
    <a href="<?=BASE_PATH?>/ressetPassword">Resset Password</a>
</form>

<?php include_once __DIR__ . "/../Layout/Footer.php"; ?>
