<?php

namespace App\Controller;

class Controller {
    protected $titlePage = "";
    protected $data=[];

    public function renderView($viewPage, $titlepage, $data) {
        $viewFile = "app/View/".$viewPage.".php";
        if(is_file($viewFile)) include_once $viewFile;
        else "File không tồn tại";
    }

    // public function renderViewAdmin($viewPage, $titlepage, $data) {
    //     $viewFile = "Admin/View/".$viewPage.".php";
    //     if(is_file($viewFile)) include_once $viewFile;
    //     else "File không tồn tại";
    // }
    
    public function htmlProductShop($id, $img, $name, $price) {
        return '
        <div class="col l-4">
                <div class="product-item">
                    <a href="'.BASE_PATH.'/product/detail/'.$id.'">
                        <div class="product-top">
                            <div class="product-item-img">
                                <img src="'.BASE_PATH.'/'.$img.'" alt="'.$name.'">
                            </div>
                        </div>
                        <div class="product-bottom">
                            <div class="product-item-bottom">
                                <div class="product-item-name">'.$name.'</div>
                                <div class="product-item-price"><a href="#">'.number_format($price, 0, '.', '.').' VNĐ</a></div>
                            </div>
                            <div class="buy-product">
                                <a class="buy-product-detail" href="'.BASE_PATH.'/product/detail/'.$id.'">Mua ngay<div></div></a>
                                <a class="add-cart" data-productid="'.$id.'"><div><i class="fa-solid fa-cart-shopping"></i></div></a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        ';
    }

    public function htmlProductShow($id, $img, $name, $price) {
        return '
            <div class="col l-3">
                <div class="product-item">
                    <a href="'.BASE_PATH.'/product/detail/'.$id.'">
                        <div class="product-top">
                            <div class="product-item-img">
                                <img src="'.BASE_PATH.'/'.$img.'" alt="'.$name.'">
                            </div>
                        </div>
                        <div class="product-bottom">
                            <div class="product-item-bottom">
                                <div class="product-item-name">'.$name.'</div>
                                <div class="product-item-price"><a href="#">'.number_format($price, 0, '.', '.').' VNĐ</a></div>
                            </div>
                            <div class="buy-product">
                                <a class="buy-product-detail" href="'.BASE_PATH.'/product/detail/'.$id.'">Mua ngay</a>
                                <a class="add-cart" data-productid="'.$id.'"><div><i class="fa-solid fa-cart-shopping"></i></div></a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        ';
    }

    public function gotoShop() {
        return '
            <span><a href="'.BASE_PATH.'/shop">Đi đến shop</a></span>
        ';
    }

    public function gotoPosts() {
        return '
            <span><a href="'.BASE_PATH.'/post">Đi đến posts</a></span>
        ';
    }

    public function comments($img, $content, $create_at, $name) {
        return '
        <div class="col l-4 ">
            <div class="evaluate__box">
                <div class="boxevaluate__head boxevaluate__head--brown"></div>
                <div class="containerbox">
                    <p class="boxevaluate__text">'.$content.'</p>
                    <div class="boxevaluate__user">
                        <div class="user__icon"><img src="'.BASE_PATH.'/'.$img.'" alt=""></div>
                        <div class="user__name_time">
                            <div class="user__name">'.$name.'</div>
                            <div class="user__time">
                                '.$create_at.'
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        ';
    }

    public function checkUrl($addressSearch, $index = 1) {
        $url = isset($_GET['page']) ? "/".rtrim($_GET['page'], '/') : '/index';
        $url_array = explode("/", $url);

        $addressItem = array_search($addressSearch, $url_array);

        if ($addressItem !== false) {
            return isset($url_array[$addressItem + $index]) ? $url_array[$addressItem + $index] : 1;
        }else {
            return 0;
        }
    }
}