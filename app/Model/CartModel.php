<?php

namespace App\Model;

class CartModel extends SqlModel {
    protected $table;
    protected $db;

    public function __construct() {
        $this->table = "carts";
        $this->db = new DatabaseModel;
    }

    public function addCart($user_id, $product_id, $quantity) {
        $sql = "INSERT INTO carts (`user_id`, `product_id`, `quantity`) VALUES (?, ?, ?)";
        return $this->db->CRUD($sql, $user_id, $product_id, $quantity);
    }
    public function getCart($user_id) { 
        $sql = "SELECT * FROM carts WHERE user_id = ?";
        return $this->db->get_all($sql, $user_id);
    }

    public function getProductCart($product_id, $user_id) {
        $sql = "SELECT * FROM {$this->table} WHERE product_id = ? AND user_id = ?";
        return $this->db->get_one($sql, $product_id, $user_id);
    }

    public function addProduct($product_id, $quantity, $user_id) {
        $sql = "INSERT INTO {$this->table} (`product_id`, `quantity`, `user_id`) VALUES (?, ?, ?)";
        return $this->db->CRUD($sql, $product_id, $quantity, $user_id);
    }
    

    public function updateProductQuantity($product_id, $new_quantity) {
        $sql = "UPDATE carts SET quantity = ? WHERE product_id = ?";
        return $this->db->CRUD($sql, $new_quantity, $product_id);
    }

    public function GetProductCartByUser($user_id) {
        $sql = "SELECT products.* , carts.quantity as cart_quantity 
        FROM products
        LEFT JOIN carts ON products.id = carts.product_id WHERE carts.user_id = ?";
        return $this->db->get_all($sql, $user_id);
    }

    public function updateQuantityInDatabase($product_id, $quantity, $user_id) {
        $sql = "UPDATE {$this->table}
                SET cart_quantity = cart_quantity + {$quantity}
                WHERE product_id = {$product_id} AND user_id = {$user_id}";
    
        return $this->db->CRUD($sql);
    }

    public function GetProductCartByProduct($product_id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        return $this->db->get_one($sql, $product_id);
    }

    public function getCartByUser($user_id) {
        $sql = "SELECT * FROM carts WHERE user_id = ?";
        return $this->db->get_all($sql, $user_id);
    }

}