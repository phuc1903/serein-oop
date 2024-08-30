<?php

namespace App\Controller;

use App\Model\CartModel;
use App\Model\ProductModel;
use App\Model\UserModel;

class CartController extends Controller {
    protected $cart;
    protected $pro;
    protected $user;
    protected $voucher;
    protected $response = array('success' => false, 'message' => '', 'cart_new' => []);
    
    public function __construct(){
        $this->cart = new CartModel();
        $this->pro = new ProductModel();
        $this->user = new UserModel();
    
    }

    public function Index() {
        $this->titlePage = "Giỏ hàng của bạn";

        $this->renderView("Cart", $this->titlePage, $this->data);
    }


    
    public function AddToCart(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            // echo $product_id;
            $product = $this->pro->product_get_by_id($product_id);

            if($product['default_quantity'] <= 0 ) {
                $this->response['success'] = false;
                    Ajax::setResponse(false, "Sản phẩm đã hết");
                // echo json_encode($this->response);
            }
            else {
                    
                if(!isset($_SESSION["carts"])){
                    $_SESSION["carts"] = [];
                }

                $cartItem = $product;
                $cartItem['cart_quantity'] = $quantity;

                $existingKey = array_search($product["id"], array_column($_SESSION["carts"], 'id'));

                if($existingKey !== false){
                    $_SESSION["carts"][$existingKey]["cart_quantity"] += $_POST["quantity"];
                } else {
                    $_SESSION['carts'][] = $cartItem;
                }

                Ajax::setResponse(true, "Thêm sản phẩm vào giỏ hàng thành công");
            }
            // echo json_encode($this->response);
            // }
        }
    }

    public function DeleteToCart() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_SESSION['carts'])) {
                $product_id = $_POST['product_id'];
                foreach($_SESSION['carts'] as $index => $item) {
                    if($item['id'] == $product_id) {
                        unset($_SESSION['carts'][$index]);
                        $html = $this->renderViewCart();
                        Ajax::setResponse(true, "Xoa san pham thanh cong", $html);
                        break;
                    }
                }
            }
        }
    }

    public function RenderViewCart() {
        $html = "";
        $html .= '<div class="col l-8 cart__list__product">';
                        
        $totalPrices = 0;
        $total = 0;
        
        if (!isset($_SESSION['carts']) || empty($_SESSION['carts'])) {
            $html .= "<h1>Giỏ hàng rỗng</h1>";
        } else {
            if (isset($_SESSION['carts'])) {
                $carts = $_SESSION['carts'];
                
                foreach ($carts as $cart) {
                    extract($cart);
                    $totalPrice = $cart_quantity * $price;
                    
                    $html .= '<div class="product__item">
                        <!-- img -->
                        <div class="product__item__img">
                            <img src="' . BASE_PATH . '/' . $img . '" alt="">
                        </div>
                        <div class="product__item-right">
                            <div class="product__item__infomation">
                                <!-- information  -->
                                <div class="information__name">
                                    <div class="name line-champ-1">' . $name . '</div>
                                </div>
        
                                <div class="information__choice">
                                    <a data-cart-id="' . $id . '" class="information__choice-btn choice__remove cart-delete">Xóa</a>
                                </div>
                            </div>
                            <!-- price and quantity -->
                            <div class="information__quantity">
                                <div class="choice__price">
                                    <div class="price__value" data-price="' . $price . '">' . number_format($totalPrice, 0, '.', '.') . '</div>
                                    <div class="price__usa">VNĐ </div>
                                </div>
                                <!-- quantity -->
                                <div class="choice__quantity">
                                    <a class="pre-quantity-cart" onclick="PreQuantity(this)"><div class="quantity__minus">-</div></a>
                                    <input class="quantity__value input-quantity-cart" onkeyup="CheckQuantity(this)" data-default-quantity="' . $default_quantity . '" data-id="' . $id . '" value="' . $cart_quantity . '"></input>
                                    <a class="add-quantity-cart" onclick="AddQuantity(this)" class=""><div class="quantity__add">+</div></a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    
                    $totalPrices += $totalPrice;
                }
                
                if (isset($_SESSION['voucher'])) {
                    $discount = isset($discount) ? $discount : 0;
                    $total = $totalPrices + SHIPPING_FEE - $discount;
                } else {
                    $total = $totalPrices + SHIPPING_FEE;
                }
            }
        }
        
        $html .= '</div>
            <div class="col l-4 cart__pay">
                <div class="cart__pay__box">
                    <form method="post" class="pay__voucher">
                        <label for="" class="text__voucher ">Nhập mã giảm giá</label>
                        <div class="value__voucher">
                            <input type="text" placeholder="' . (isset($_SESSION['voucher']) ? $_SESSION['voucher']['code'] : 'Nhập voucher') . '" id="code-voucher" name="voucher">
                            <button type="button" id="add-voucher" name="addVoucher">Áp dụng</button>
                        </div>  
                        <div class="voucher-err error"></div>
                    </form>
                    <form method="post" class="totalprice">
                        <div class="cart__pay__price">
                            <div class="product__price">
                                <label for="" class="text">Giá sản phẩm</label>
                                <div class="box__price">
                                    <div class="price price-total">' . number_format($totalPrices) . '</div>
                                    <div class="usas">VNĐ</div>
                                </div>
                            </div>
                            <!-- ship -->                            
                            <div class="product__price">
                                <label for="" class="text">Phí giao hàng</label>
                                <div class="box__price">
                                    <div class="price">' . number_format(SHIPPING_FEE) . '</div>
                                    <div class="usas">VNĐ</div>
                                </div>
                            </div>
                            <!-- voucher -->
                            <div class="product__price">
                                <label for="" class="text">Giảm giá</label>
                                <div class="box__price">
                                    <div class="price price-voucher" data-discount="' . (isset($discount) ? $discount : 0) . '">- ' . (isset($discount) ? $discount : 0) . '</div>
                                    <div class="usas">VNĐ</div>
                                </div>
                            </div>
                            <hr class="hr__pay">
                            <div class="product__price">
                                <label for="" class="text text--bold">Tổng tiền</label>
                                <div class="box__price">
                                    <div class="price text--bold">' . number_format($total) . '</div>
                                    <div class="usas usas--m">VNĐ</div>
                                </div>
                            </div>
                            <!-- button thanh toan -->
                            <button type="button" name="pay" id="btn-pay" class="btn__pay"><a>Thanh toán</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
        
        return $html;
    }
    
    

    public function AddQuantity(){
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"]; 
        $cartNew = [];
    
        if(isset($_SESSION["carts"])){
            foreach($_SESSION["carts"] as $index => $item){
                if($item["id"] == $product_id){
                    $newQuantity = $item["cart_quantity"] + 1;
                    $item["cart_quantity"] = $newQuantity;
                    $_SESSION['carts'][$index]['cart_quantity'] = $item['cart_quantity'];
                    array_push($cartNew, $_SESSION["carts"][$index]);
                    // echo json_encode($_SESSION["carts"][$index]);
                    $html = $this->renderViewCart();
                    Ajax::setResponse(true, "", $html);
                    break;
                } else {
                    array_push($cartNew, $item);
                }
            }
        }
    
        $_SESSION['carts'] = $cartNew;
    }

    public function SubtractQuantity(){
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"]; 
        $cartNew = [];
    
        if(isset($_SESSION["carts"])){
            foreach($_SESSION["carts"] as $index => $item){
                if($item["id"] == $product_id){
                    $newQuantity = $item["cart_quantity"] - 1;
                    $item["cart_quantity"] = $newQuantity;
                    $_SESSION['carts'][$index]['cart_quantity'] = $item['cart_quantity'];
                    array_push($cartNew, $_SESSION["carts"][$index]);
                    // echo json_encode($_SESSION["carts"][$index]);
                    $html = $this->renderViewCart();
                    Ajax::setResponse(true, "", $html);
                    break;
                } else {
                    array_push($cartNew, $item);
                }
            }
        }
    
        $_SESSION['carts'] = $cartNew;
    }
    

}