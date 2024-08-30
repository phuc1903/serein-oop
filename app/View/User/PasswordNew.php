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
        <input type="password" placeholder="Nhập mật khẩu" id="password" class="password" name="password" autocomplete="current-password">
        <div class="error" id="password_err"></div>
    </div>
    <div class="input-form-item">
        <input type="password" placeholder="Nhập lại mật khẩu" id="cpassword" class="cpassword" name="cpassword" autocomplete="current-password">
        <div class="error" id="password_err"></div>
    </div>
    <div class="input-form-item">
        <input type="text" placeholder="Nhap mã OTP" id="OTP" class="OTP" name="OTP" autocomplete="current-email">
        <div class="error" id="otp_err"></div>
    </div>
    <div id="message" class="error"></div>
    <div class="input-form-item">
        <button type="button" id="password-new">Cập nhật mật khẩu</button>
    </div>
</form>

<?php include_once __DIR__ . "/../Layout/Footer.php"; ?>
