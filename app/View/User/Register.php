<?php

include_once __DIR__."/../Layout/Header.php";

?>

<form id="register-form" method="post" class="form-main">
    <div class="input-form-with">
        <i class="fa-brands fa-square-facebook"></i>
        <span>Đăng nhập với google</span>
    </div>
    <div class="input-form-with">
        <i class="fa-brands fa-square-facebook"></i>
        <span>Đăng nhập với facebook</span>
    </div>
    <div class="input-form-item">
        <input type="text" placeholder="Tên tài khoản" class="name" id="name" name="name">
        <div class="error" id="name_err"></div>
    </div>
    <div class="input-form-item">
        <input type="text" placeholder="Nhập email" class="email" id="email" name="email" autocomplete="email">
        <div class="error" id="email_err"></div>
    </div>
    <div class="input-form-item">
        <input type="password" placeholder="Nhập mật khẩu" class="password" id="password" name="password" autocomplete="new-password">
        <div class="error" id="password_err"></div>
    </div>
    <div class="input-form-item">
        <input type="password" placeholder="Nhập lại mật khẩu" class="cpassword" id="cpassword" name="confirm_password" autocomplete="new-password">
        <div class="error" id="cpassword_err"></div>
    </div>
    <div id="message" class="error"></div>
    <div class="input-form-item">
        <button type="button" class="register" id="register-btn" name="submit">Đăng ký</button>
    </div>
</form>

<?php

include_once __DIR__."/../Layout/Footer.php";

?>