<main class="main-admin container">
    <div class="grid wide">
        <div class="row">
            <div class="col l-3">
                <div class="header__admin">
                    <?php if( isset($_SESSION['user'])): ?>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/user/info/'.$_SESSION['user']['id'] ? 'active': " "?>" href="<?=BASE_PATH.'/user/info/'.$_SESSION['user']['id']?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Hồ sơ</span></a>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/user/order/'.$_SESSION['user']['id'] ? 'active': " "?>" href="<?=BASE_PATH.'/user/order/'.$_SESSION['user']['id']?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Đơn hàng của bạn</span></a>
                    <?php if($_SESSION['user']['is_admin'] == 1):?>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/categories' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/categories'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý danh muc</span></a>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/products' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/products'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý sản phẩm</span></a>
                    <!-- <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/comments' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/comments'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý bình luận</span></a> -->
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/users' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/users'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý tài khoản khách hàng</span></a>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/orders' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/orders'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content" id="managerOrder">Quản lý đơn hàng</span></a>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/banners' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/banners'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý banners</span></a>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin/vouchers' ? 'active': " "?>" href="<?=BASE_PATH.'/admin/vouchers'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý vouchers</span></a>
                    <a class="header__admin-item <?=$_SERVER['REQUEST_URI'] == BASE_PATH.'/admin' ? 'active': " "?>" href="<?=BASE_PATH.'/admin'?>"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Dashboard</span></a>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>