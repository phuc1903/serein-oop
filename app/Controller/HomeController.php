<?php

namespace App\Controller;
use App\Model\ProductModel;
use App\Model\PostModel;
use App\Model\BannerModel;


class HomeController extends Controller {

    private $pro;
    private $banner;

    function  __construct() {
        $this->pro = new ProductModel();
        $this->banner = new BannerModel();
    }
    public function index() {
        $this->titlePage = "Trang chủ shop";
        $this->data['banner'] = $this->banner->getBannerShow();
        $this->data['product_new'] = $this->pro->product_get_all_new(4);
        $this->data['product_bestseller'] = $this->pro->product_get_all_bestseller(4);
        $this->data['product_like'] = $this->pro->product_get_all_like(4);
        $this->renderView("Home", $this->titlePage, $this->data);
        // require_once "app/View/home.php";
    }
}