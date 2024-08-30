<?php

namespace App\Model;

use App\Model\DatabaseModel;

class OrderModel extends SqlModel {
    protected $table;
    protected $tableForeign;
    protected $orderStatus;
    protected $db;
    protected $order;

    public function __construct() {
        $this->table = 'orders';
        $this->orderStatus = 'order_status';
        $this->tableForeign = 'order_detail';
        $this->db = new DatabaseModel();
    }

    public function order_get_all() {
        return parent::get_all_table();
    }

    public function AddOrderHaveVoucher($user_id, $total_amount, $code_voucher) {
        $sql = "INSERT INTO {$this->table} (`user_id`, `total_amount`, `voucher`) VALUES (?, ?, ?)";
        $this->db->CRUD($sql, $user_id, $total_amount, $code_voucher);
        return $this->db->lastInsertId();   
    }

    public function AddOrder($user_id, $total_amount) {
        $sql = "INSERT INTO {$this->table} (`user_id`, `total_amount`) VALUES (?, ?)";
        $this->db->CRUD($sql, $user_id, $total_amount);
        return $this->db->lastInsertId();   
    }

    public function Order_by_id($order_id) {
        return parent::get_one_table($order_id);
    }

    public function order_by_user($user_id) {
        $sql = "SELECT orders.id as order_id, orders.total_amount as total_price, orders.voucher as voucher, orders.created_at as day_create, users.user_name, users.email, users.avatar, status.name as status_now
            FROM orders
            JOIN users ON users.id = orders.user_id
            JOIN order_status ON orders.id = order_status.order_id
            JOIN status ON status.id = order_status.status_id
            WHERE order_status.now = 1 AND users.id = ?";
        return $this->db->get_all($sql, $user_id);
    }
    

    public function AddOrderDetail($orer_id, $product_id, $cart_quantity, $price) {
        $sql = "INSERT INTO {$this->tableForeign} (`order_id`,`product_id`, `quantity`, `price_product`) VALUES (?, ? , ?, ?)";
        $this->db->CRUD($sql, $orer_id, $product_id, $cart_quantity, $price);
        return true; 
    }

    public function getOrders($page, $itemsPerPage) {
        $offset = ($page - 1) * $itemsPerPage;

        // Truy vấn SQL để lấy dữ liệu sản phẩm theo trang và số sản phẩm trên mỗi trang
        $sql = "SELECT * FROM {$this->table} LIMIT {$offset}, {$itemsPerPage}";
        // Thực hiện truy vấn và trả về kết quả dưới dạng mảng JSON
        return $this->db->get_all($sql);
    }

    public function AddStatusOrder($order_id) {
        
        $sql = "INSERT INTO {$this->orderStatus} (`order_id`, `status_id`, `now`) VALUES ( ?, (SELECT id FROM status WHERE name = 'Đã đặt hàng'), ?)";
        $this->db->CRUD($sql, $order_id, 1);
        return true; 
    }

    public function orderDetail_get_by_id($order_id) {
        $sql = "SELECT order_detail.*, products.name as product_name, products.img as product_img, products.description as product_description, products.price as product_price
                FROM order_detail 
                JOIN products ON products.id = order_detail.product_id
                WHERE order_id = ?";
        return $this->db->get_all($sql, $order_id);
    }

    public function status_get_by_order($order_id) {
        $sql = "SELECT orders.id as order_id, status.name, status.id as status_id
                FROM orders
                JOIN order_status ON orders.id = order_status.order_id
                JOIN status ON status.id = order_status.status_id
                WHERE orders.id = ? AND order_status.now = 1;
                ";
        return $this->db->get_one($sql, $order_id);
    }
public function order_success() {
        $sql = "SELECT orders.*, status.name
        FROM orders
        JOIN order_status ON orders.id = order_status.order_id
        JOIN status ON status.id = order_status.status_id
        WHERE order_status.status_id = (SELECT id FROM status WHERE name = 'Đã giao thành công')
        AND order_status.now = 1
        ";
        return $this->db->get_all($sql);
    }
    


}