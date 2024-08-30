<?php

namespace App\Controller;
use App\Model\ProductModel;
use App\Model\CategoryModel;

class ShopController extends Controller {
    private $pro;
    private $cate;

    public function __construct() {
        $this->pro = new ProductModel;
        $this->cate = new CategoryModel;
    }

    public function index() {
        $this->titlePage = "Trang shop SEREIN";

        $idCategory = 0;
        $page = 1;
        $ProductQuantity = 6;
        

        if($this->checkUrl('category')) {
            $idCategory = $this->checkUrl('category');

        }
        if($this->checkUrl('pagi')) {
            $page = $this->checkUrl('pagi');
        }
        if($this->checkUrl('search') || $this->checkUrl('search') > 0) {
            $keySearch = $this->checkUrl('search');
        }else {
            $keySearch = "";
        }

        $totalProducts = $this->pro->getTotalProducts($idCategory);
        $totalPages = ceil($totalProducts / $ProductQuantity);

        $products = $this->pro->product_get_all_By_IdCate($keySearch, $idCategory, $page, $ProductQuantity);

        
        $this->data['products'] = $products;
        $this->data['idCategory'] = $idCategory;
        $this->data['categories'] = $this->cate->category_get_all();
        $this->data['totalPages'] = $totalPages;
        $this->data['countProduct'] = count($products);

        $this->renderView('Shop', $this->titlePage, $this->data);
    }

    public function search() {
        require_once __DIR__."/../Config/func.php";
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['productSearch'])) {
            $keySearch = create_slug($_POST['search'], 1); 
            header('Location: '.BASE_PATH.'/shop/search/'.$keySearch);
        }else {
            header('Location: '.BASE_PATH.'/shop');
        }
    }

    function Detail() {
        $id = $this->checkUrl('detail');
        $this->titlePage = "Trang chi tiết sản phẩm";
        $product = $this->pro->product_get_by_id($id);
        $productRelated = $this->pro->product_related();

        $randomKeys = array_rand($productRelated, 4);

        $randomProducts = [];
        foreach ($randomKeys as $key) {
            $randomProducts[] = $productRelated[$key];
        }

        $this->data['product'] = $product;
        $this->data['product_thumbnails'] = $this->pro->product_get_all_thumbnails($id, 1, 4);
        $this->data['product_sizes'] = $this->pro->get_all_size($id);
        $this->data['product_view'] = $randomProducts;
        $this->data['categories'] = $this->cate->category_get_all();
        $this->data['product_category'] = $this->pro->get_all_cate($id);
        $this->renderView("Product/Detail", $this->titlePage, $this->data);
    }
    
}

