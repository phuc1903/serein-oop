<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_PATH?>/Public/css/style.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>/Public/css/layout.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>/Public/css/detail.css">
    <link rel="shortcut icon" href="<?=BASE_PATH?>/Public/img/logo.png">
    <link rel="stylesheet" href="<?=BASE_PATH?>/Public/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.min.css">
    
    <title>
        <?php
            if($this->titlePage!="") echo $this->titlePage;
        ?>
    </title>
</head>

<body>
    <main>
        <header>
            <div class="grid wide">
                <div class="header__main">
                    <div class="logo">
                        <img src="<?=BASE_PATH?>/Public/img/logo3.png" alt="">
                    </div>
                    <div class="nav">
                        <div class="navbar">
                            <ul>
                                <li><a href="<?=BASE_PATH?>/">Home</a></li>
                                <li><a href="<?=BASE_PATH?>/shop">Shop</a></li>
                                <li><a href="<?=BASE_PATH?>/about">About</a></li>
                                <!-- <li><a href="<?=BASE_PATH?>/posts">Posts</a></li> -->
                                <li><a href="<?=BASE_PATH?>/contact">Contact</a></li>
                            </ul>
                        </div>
                        <div class="right__icons">
                            <!-- <div class="right__icon-item">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div> -->
                            <div class="right__icon-item">
                                <?php if(isset($_SESSION['user'])): ?>
                                <img src="<?=BASE_PATH?>/<?= $_SESSION['user']['avatar'] ?>" alt="">
                                <?php else: ?>
                                <i class="fa-solid fa-user"></i>
                                <?php endif; ?>
                                <div class="right_icon-chirld">
                                    <?php if(isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1): ?>
                                    <a href="<?=BASE_PATH?>/admin"><div class="right_icon-chirld-item">Admin</div></a>
                                    <?php endif; ?>
                                    <?php if(isset($_SESSION['user'])){?>   
                                    <a href="<?=BASE_PATH?>/user/info/<?=$_SESSION['user']['id']?>"><div class="right_icon-chirld-item">Hồ sơ</div></a>
                                    <a href="<?=BASE_PATH?>/user/order/<?=$_SESSION['user']['id']?>"><div class="right_icon-chirld-item">Quản lý đơn hàng</div></a>
                                    <a href="<?=BASE_PATH?>/logout"><div class="right_icon-chirld-item">Đăng xuất</div></a>
                                    <?php }else{ ?>
                                    <a href="<?=BASE_PATH?>/login"><div class="right_icon-chirld-item">Đang nhập</div></a>
                                    <a href="<?=BASE_PATH?>/register"><div class="right_icon-chirld-item">Đăng ký</div></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="right__icon-item">
                                <a href="<?=BASE_PATH?>/cart" class="right__icon"><i class="fa-solid fa-cart-shopping"></i></a>
                                <!-- <span>(<?php echo isset($_SESSION['cart_count']) && count($_SESSION['cart_count']) > 0  ? $_SESSION['cart_count'][0]['cart_count'] : 0 ?>)</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>