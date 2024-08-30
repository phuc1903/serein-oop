<?php include_once __DIR__ . "/../Layout/Header.php"; ?>

<form method="POST" id="login-form" class="form-main">
    <div class="input-form-item">
        <input type="text" placeholder="Nhap email" id="email" class="email" name="email" autocomplete="current-email">
        <div class="error" id="email_err"></div>
    </div>
    <div id="message" class="error"></div>
    <div class="input-form-item">
        <button type="button" id="ressetPass-btn">Lấy lại mật khẩu</button>
    </div>
</form>

<?php include_once __DIR__ . "/../Layout/Footer.php"; ?>
