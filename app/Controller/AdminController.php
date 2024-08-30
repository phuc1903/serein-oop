<?php

namespace App\Controller;

use App\Model\ProductModel;
use App\Model\CategoryModel;
use App\Model\BannerModel;
use App\Model\OrderModel;
use App\Model\StatusOrderModel;
use App\Model\VoucherModel;
use App\Model\UserModel;

class AdminController extends Controller {

    private $pro;
    private $cate;
    private $banner;
    private $order;
    private $voucher;
    private $user;
    private $status;

    public function __construct() {
        $this->pro = new ProductModel();
        $this->cate = new CategoryModel();
        $this->banner = new BannerModel();
        $this->order = new OrderModel();
        $this->voucher = new VoucherModel();
        $this->user = new UserModel();
        $this->status = new StatusOrderModel();
        if(!$_SESSION['user']['is_admin']){
            header("Location: ".BASE_PATH."/index");
        }
    }

    public function Index() {
        $this->titlePage = "DashBoard";
        $orders = $this->order->order_get_all();
        $this->data['orders'] = $orders;
        $this->data['count_order'] = count($orders);
        $this->data['order_success'] = $this->order->order_success();
        // print_r($this->data['order_success']);
        $this->renderView("Admin/Dashboard", $this->titlePage, $this->data);
    }

    function generatePaginationLinks($currentPage, $totalPages) {
        $paginationLinks = '';
        
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            $paginationLinks .= "<a class='pagination-link $activeClass' href='?page=$i'>$i</a>";
        }
    
        return $paginationLinks;
    }

    // Products

    public function ListProduct() {
        $this->titlePage = "Danh sách sản phẩm";
        $page = $this->checkUrl('pagi');
        if($page <= 0) $page  = 1;
        $itemsPerPage = 5;
        
        $totalProducts = $this->pro->count_all_products(); 
        
        $totalPages = ceil($totalProducts / $itemsPerPage);
    
        $products = $this->pro->product_get_all_by_cate($page, $itemsPerPage);
    
        $this->data['products'] = $products;
        $this->data['currentPage'] = $page;
        $this->data['totalPages'] = $totalPages;
    
        $this->renderView('Admin/Products/Manager_products', $this->titlePage, $this->data);
    }
    

    public function DeleteProduct() {
        $product_id = $this->checkUrl('delete');
        $product = $this->pro->product_get_by_id($product_id);
        $img = $product['img'];
        $delete = $this->pro->product_category_delete($product_id);
        $deleteSize = $this->pro->product_size_delete($product_id);
        if(!$delete && !$deleteSize) {
            unlink($img);
            $this->pro->product_delete($product_id);
            header('Location: '.BASE_PATH."/admin/products");
        }
    }

    public function AddProduct() {
        $this->titlePage = "Thêm sản phẩm";
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['AddProduct'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $imgName = $_FILES['img']['name'] !== "" ? $_FILES['img']['name'] : "";
            move_uploaded_file($_FILES['img']['tmp_name'], 'Public/Upload/img/' . $imgName);
            $img = 'Public/Upload/img/' . $imgName;

            
            $AddProduct = $this->pro->AddProduct($name, $img, $price, $description, $quantity);
            if($AddProduct) {
                $product_id = $AddProduct;
                $this->cate->AddCategoryByProduct($category, $product_id);
                header("Location: ".BASE_PATH."/admin/products");
            }
        }
        $this->data['categories'] = $this->cate->category_get_all();
        $this->renderView('Admin/Products/Manager_productAdd', $this->titlePage, $this->data);
    }

    public function UpdateProduct() {
        $this->titlePage = "Sửa sản phẩm";
        $product_id = $this->checkUrl('update');
        $product = $this->pro->product_get_by_id($product_id);
        $this->data['product'] = $product;
        $this->data['categories'] = $this->cate->category_get_all();
    
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['UpdateProduct'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $imgName = $_FILES['img']['name'];
    
            if ($imgName !== "") {
                $imgOld = 'Public/Upload/img/' . $product['img'];
                if (file_exists($imgOld)) {
                    unlink($imgOld);
                }
                $img = 'Public/Upload/img/' .$imgName;
                move_uploaded_file($_FILES['img']['tmp_name'], $img);
            } else {
                $img = $product['img'];
            }
    
            $this->pro->UpdateProduct($product_id, $name, $img, $price, $description, $quantity);
            header("Location: ".BASE_PATH."/admin/products");
        }
    
        $this->renderView('Admin/Products/Manager_productUpdate', $this->titlePage, $this->data);
    }
    

    // Categories

    public function ListCategory() {
        $this->titlePage = "Danh sách danh mục";
        $categories = $this->cate->category_get_all();
        $this->data['categories'] = $categories;
        $this->renderView('Admin/Categories/Manager_categories', $this->titlePage, $this->data);
    }
    
    public function DeleteCategory() {
        $cate_id = $this->checkUrl('delete');
        $delete = $this->cate->product_category_delete($cate_id);
        if(!$delete) {
            $this->cate->category_delete($cate_id);
            header('Location: '.BASE_PATH."/admin/categories");
        }
    }

    public function AddCategory() {
        $this->titlePage = "Thêm danh mục";
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['AddCategory'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $imgName = $_FILES['img']['name'] !== "" ? $_FILES['img']['name'] : "";
            $img = 'Public/Upload/img/'.$imgName;
            move_uploaded_file($_FILES['img']['tmp_name'], $img);
            
            $this->cate->AddCategory($name, $img, $description, $status);
            header("Location: ".BASE_PATH."/admin/categories");
        }
        $this->renderView('Admin/Categories/Manager_categoryAdd', $this->titlePage, $this->data);
    }

    public function UpdateCategory() {
        $this->titlePage = "Sửa danh mục";
        $category_id = $this->checkUrl('update');
        $category = $this->cate->category_get_by_id($category_id);
        $this->data['category'] = $category;
    
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['UpdateCategory'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $imgName = $_FILES['img']['name'] !== "" ? $_FILES['img']['name'] : "";
    
            if ($imgName !== "") {
                $imgOld = 'Public/Upload/img/' . $category['img'];
                if (file_exists($imgOld)) {
                    unlink($imgOld);
                }
                $img = 'Public/Upload/img/' .$imgName;
                move_uploaded_file($_FILES['img']['tmp_name'], $img);
            } else {
                $img = $category['img'];
            }
    
            $this->cate->UpdateCategory($category_id, $name, $img, $description, $status);
            header("Location: ".BASE_PATH."/admin/categories");
        }
    
        $this->renderView('Admin/Categories/Manager_categoryUpdate', $this->titlePage, $this->data);
    }

    // Banners

    public function ListBanner() {
        $this->titlePage  = "Danh sách banners";
        $banners = $this->banner->banner_get_all();
        $this->data['banners'] = $banners;
        $this->renderView("Admin/Banners/Manager_banners", $this->titlePage, $this->data);
    }

    public function DeleteBanner() {
        $banner_id = $this->checkUrl('delete');
        $this->banner->banner_delete_one($banner_id);
        header("Location: ".BASE_PATH."/admin/banners");
    }

    public function AddBanner() {
        $this->titlePage = "Thêm banner";
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['AddBanner'])) {
            $collection = $_POST['collection'];
            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $des = isset($_POST['des']) ? $_POST['des'] : "";
            $link = isset($_POST['link']) ? $_POST['link'] : "";
            $action = isset($_POST['action']) ? $_POST['action'] : "";
            $banner_show = isset($_POST['banner_show']) ? intval($_POST['banner_show']) : 0;
            $imgName = $_FILES['img']['name'] !== "" ? $_FILES['img']['name'] : "";
            $backgroundName = $_FILES['background']['name'] !== "" ? $_FILES['background']['name'] : "";
            $img = 'Public/Upload/img/'.$imgName;
            $background = 'Public/Upload/img/'.$backgroundName;
            move_uploaded_file($_FILES['img']['tmp_name'], $img);
            move_uploaded_file($_FILES['img']['tmp_name'], $background);
            
            $this->banner->AddBanner($collection, $title, $des, $link, $action, $banner_show, $img, $background);
            header("Location: ".BASE_PATH."/admin/banners");
        }
        $this->renderView('Admin/Banners/Manager_bannerAdd', $this->titlePage, $this->data);
    }

    public function UpdateBanner() {
        $this->titlePage = "Sửa banner";
        $banner_id = $this->checkUrl('update');
        $banner = $this->banner->banner_get_by_id($banner_id);
        $this->data['banner'] = $banner;
    
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['UpdateBanner'])) {
            $collection = $_POST['collection'];
            $title = $_POST['title'];
            $des = $_POST['des'];
            $link = $_POST['link'];
            $action = $_POST['action'];
            $banner_show = $_POST['banner_show'];
            $imgName = $_FILES['img']['name'] !== "" ? $_FILES['img']['name'] : "";
            $backgroundName = $_FILES['background']['name'] !== "" ? $_FILES['img']['name'] : "";
    
            if ($imgName !== "") {
                $imgOld = 'Public/Upload/img/' . $banner['img'];
                if (file_exists($imgOld)) {
                    unlink($imgOld);
                }
                $img = 'Public/Upload/img/' .$imgName;
                move_uploaded_file($_FILES['img']['tmp_name'], $img);
            } else {
                $img = $banner['img'];
            }

            if ($backgroundName !== "") {
                $backgroundOld = 'Public/Upload/img/' . $banner['img'];
                if (file_exists($backgroundOld)) {
                    unlink($backgroundOld);
                }
                $background = 'Public/Upload/img/' .$backgroundName;
                move_uploaded_file($_FILES['img']['tmp_name'], $img);
            } else {
                $background = $banner['img'];
            }
    
            $this->banner->UpdateBanner($banner_id, $collection, $title, $des, $link, $action, $banner_show, $img, $background);
            header("Location: ".BASE_PATH."/admin/banners");
        }
    
        $this->renderView('Admin/Banners/Manager_bannerUpdate', $this->titlePage, $this->data);
    }

    // Orders

    public function ListOrder() {
        $this->titlePage = "Danh sách đơn hàng";
        // $orders = $this->order->order_get_all();
        // $this->data['orders'] = $orders;
        $this->renderView('Admin/Orders/Manager_orders', $this->titlePage, $this->data);
    }

    public function UpdateOrder() {
        $this->titlePage = "Update Status";
        $order_id = $this->checkUrl('update'); 
        $order = $this->order->Order_by_id($order_id);
        $status = $this->status->status_get_all();
        $status_now = $this->order->status_get_by_order($order_id);
        // print_r($status_now);
        $this->data['status'] = $status;
        $this->data['order'] = $order;
        $this->data['status_now'] = $status_now;
        $this->renderView('Admin/Orders/Manager_orderUpdate', $this->titlePage, $this->data);
    }

    public function UpdateOrderStatus() {
        $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
        $status_id = isset($_POST['status_id']) ? $_POST['status_id'] : null;
        $status_now = $status_now = $this->order->status_get_by_order($order_id);
        $result = $this->status->UpdateStatusOrder($order_id, $status_id, $status_now['status_id']);
        if($result) {
            Ajax::setResponse(true, "Cập nhật trạng thái thành công");
        }else {
            Ajax::setResponse(false, "Lỗi");
        }   
    }

    // Order detail

    public function ListDetailOrder() {
        $order_id = $this->checkUrl("detail");
        $orders = $this->order->orderDetail_get_by_id($order_id);
        $this->data['orderDetail'] = $orders;
        // print_r($orders);
        $this->renderView('Admin/Orders/Manager_orderDetail', $this->titlePage, $this->data);
    }

    // Vouchers

    public function ListVoucher(){
        $this->titlePage = "Danh sách Voucher";
        $vouchers = $this->voucher->voucher_get_all();
        $this->data["vouchers"] = $vouchers;
        $this->renderView("Admin/Vouchers/Manager_vouchers", $this->titlePage, $this->data);
    }
    
    public function DeleteVoucher(){
        $voucher_id = $this->checkUrl("delete");
        $delete = $this->voucher->voucher_user_delete($voucher_id);
        if($delete == ""){
            $this->voucher->voucher_delete($voucher_id);
            header("Location: ".BASE_PATH."/admin/vouchers");
        }
    }

    // Users

    public function ListUser() {
        $this->titlePage  = "Danh sách User";
        $users = $this->user->user_get_all();
        $this->data['users'] = $users;
        $this->renderView("Admin/Users/Manager_users", $this->titlePage, $this->data);
    }

    public function DeleteUser() {
        $user_id = $this->checkUrl('banner');
        $this->banner->banner_delete_one($user_id);
        header("Location: ".BASE_PATH."/admin/users");
    }
}