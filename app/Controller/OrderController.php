<?php

namespace App\Controller;

use App\Model\CartModel;
use App\Model\OrderModel;
use App\Model\ProductModel;
use App\Model\StatusOrderModel;

class OrderController extends Controller {
    protected $pro;
    protected $cart;
    protected $order;
    protected $status;
    protected $response = array('success' => false, 'message' => '');

    public function __construct() {
        $this->pro = new ProductModel();
        $this->cart = new CartModel();
        $this->order = new OrderModel();
        $this->status = new StatusOrderModel();
    }

    public function Index() {
        $this->titlePage = "Đơn hàng của bạn";
        $user_id = $this->checkUrl('order');
        $orderByUser = $this->order->order_by_user($user_id);
        // print_r($orderByUser);
        $this->data['orders'] = $orderByUser;
        $this->renderView('User/Manager_order', $this->titlePage, $this->data);
    }

    public function View() {
        $orders = $this->order->order_get_all();
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
            echo json_encode($orders);
        } 
    }

    public function OrderPay() {
        if(isset($_SESSION['user'])) {
            // $CartByUser = $this->cart->getCartByUser($_SESSION['user']['id']);
            // print_r(json_encode($CartByUser));
            if($_SESSION['carts']) {
                $user = $_SESSION['user'];
                $total_amount = 0;
                $carts = $_SESSION['carts'];
                $voucherHaveAdd = isset($_SESSION['voucher']) ? $_SESSION['voucher'] : false;

                foreach ($carts as $index => $cart) {
                    $quantityProductCart = (int)$cart['cart_quantity'];
                    $priceProductCart = $cart['price'];
                    $total = $priceProductCart * $quantityProductCart;
                    $total_amount += $total;
                }
                if($user['email'] && $user['user_name'] && $user['phone'] && $user['address']) {
                    if($voucherHaveAdd) {
                        $orderNew = $this->order->AddOrderHaveVoucher($user['id'], $total_amount, $voucherHaveAdd['code']);
                    }else {
                        $orderNew = $this->order->AddOrder($user['id'], $total_amount);
                    }
                        
                    // echo $orderNew;
                    if($orderNew) {
                        foreach($carts as $index => $cart) {
                            $addOrderdetail = $this->order->AddOrderDetail($orderNew, $cart['id'], $cart['cart_quantity'], $cart['price']);
                            if($addOrderdetail) {
                                $product = $this->pro->product_get_by_id($cart['id']);
                                $this->pro->UpdateQuantityProduct($cart['id'], $cart['cart_quantity'], $product['default_quantity']);
                            }
                        }
                        
                        $addStatusOrder = $this->order->AddStatusOrder($orderNew);
                        if($addStatusOrder) {
                            unset($_SESSION['voucher']);
                            unset($_SESSION['carts']);
                            Ajax::setResponse(true, "Thanh toán thành công");
                        }
                        // echo "thanh cong";

                        // print_r($orderByUser);
                    }
                }else {
                    Ajax::setResponse(false, "Vui lòng nhập đầy đủ thông tin để thanh toán");
                }
            }else {
                Ajax::setResponse(false, "Bạn có chưa sản phẩm trong giỏ hàng");
            }   

        }else {
            Ajax::setResponse(false, "Vui lòng đăng nhập để thanh toán");
        }
        // echo "hello";
    }
    // Order detail

    public function OrderDetail() {
        $user_id = $this->checkUrl("detail");
        $orders = $this->order->orderDetail_get_by_id($user_id);
        $this->data['orderDetail'] = $orders;
        // print_r($orders);
        $this->renderView('User/Manager_orderDetail', $this->titlePage, $this->data);
    }
}