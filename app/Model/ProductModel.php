<?php

namespace App\Model;

class ProductModel extends SqlModel {
    public function __construct() {
        parent::__construct();
        $this->table = "products";
    }

    public function product_get_all() {
        return parent::get_all_table();
    }

    public function product_delete($id) {
        $this->where = 'id';
        return parent::delete_one($id);
    }

    function product_get_all_bestseller($limit) {
        $this->orderBy = "bestseller";
        return parent::get_all_orderBy($limit);
    }

    function product_get_all_new($limit) {
        $this->orderBy = "product_new";
        return parent::get_all_orderBy($limit);
    }

    function product_get_all_like($limit) {
        $this->orderBy = "product_like";
        return parent::get_all_orderBy($limit);
    }

    public function product_get_by_iddm($id) {
        $this->orderBy = "id_category";
        return parent::get_all_by_iddm($id);
    }

    public function product_get_by_id($id) {
        return parent::get_one_table($id);
    }

    public function product_get_limit($limit) {
        return parent::get_all_limit($limit);
    }

    public function product_get_all_thumbnails($id, $limit) {
        $this->table1 = "thumbnails";
        $this->where = "product_id";
        return parent::get_all_related($id, $limit);
    }

    public function product_get_all_size($id, $limit) {
        $this->table1 = "size";
        $this->where = "id_product";
        return parent::get_all_related($id, $limit);
    }

    public function product_get_all_related($id, $view, $limit) {
        return parent::get_all_related($id, $view, $limit);
    }

    public function get_all_cate($id) {
        $sql = 'SELECT proCate.*, cate.name as cate_name, pro.name as pro_name
        FROM product_category as proCate 
        JOIN categories as cate ON cate.id = proCate.category_id 
        JOIN products as pro ON pro.id = proCate.product_id WHERE pro.id = ?';
        return $this->db->get_all($sql, $id);
    }

    public function get_all_size($id) {
        $sql = 'SELECT proSize.*, size.name as size_name, pro.name as pro_name
        FROM product_size as proSize 
        JOIN sizes as size ON size.id = proSize.size_id 
        JOIN products as pro ON pro.id = proSize.product_id WHERE pro.id = ?    ';
    
        return $this->db->get_all($sql, $id);
    }

    public function product_get_all_by_iddm($id) {
        $sql = "SELECT pro.*, cate.name as name_cate FROM products as pro 
                JOIN product_category as proCate ON pro.id = proCate.product_id
                JOIN categories as cate ON cate.id = proCate.category_id 
                WHERE cate.id = ? ";
        return $this->db->get_all($sql, $id);
    }
    
    public function get_all_by_iddm($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->orderBy} = ". $id;
        return $this->db->get_all($sql);
    }

    
    public function getTotalProducts($idCate) {
        $sql = "SELECT COUNT(products.id) as total FROM products";

        if ($idCate > 0) {
            $sql .= " INNER JOIN product_category ON products.id = product_category.product_id";
            $sql .= " WHERE product_category.category_id = {$idCate}";
        }

        $result = $this->db->get_one($sql);

        return isset($result['total']) ? $result['total'] : 0;
    }

    public function product_search($key) {
        $sql = "SELECT * FROM products WHERE name LIKE '%{$key}%'";
        return $this->db->get_all($sql);
    }

    public function product_get_all_By_IdCate($keySearch, $idCate, $page, $ProductQuantity) {
        $limit1 = ($page - 1) * $ProductQuantity;
        $limit2 = $ProductQuantity;
    
        $sql = "SELECT products.* FROM products";
    
        if ($idCate > 0) {
            $sql .= " INNER JOIN product_category ON products.id = product_category.product_id";
            $sql .= " WHERE product_category.category_id = {$idCate}";
    
            if ($keySearch !== "" ) {
                $sql .= " AND products.name LIKE '%{$keySearch}%'";
            }
        } elseif ($keySearch !== "" ) {
            $sql .= " WHERE products.name LIKE '%{$keySearch}%'";
        }
    
        $sql .= " ORDER BY products.id DESC LIMIT {$limit1}, {$limit2}";
    
        return $this->db->get_all($sql);
    }

        public function count_all_products() {
        $sql = "SELECT COUNT(*) as total FROM products";
        $result = $this->db->get_one($sql);

        return $result['total'];
    }

  
    public function product_get_all_by_cate($page, $ProductQuantity) {
        $limit1 = ($page - 1) * $ProductQuantity;
        $limit2 = $ProductQuantity;
        
        $sql = "SELECT
            products.*,
            GROUP_CONCAT(categories.name) AS all_categories
            FROM products
            LEFT JOIN product_category ON products.id = product_category.product_id
            LEFT JOIN categories ON product_category.category_id = categories.id
            GROUP BY products.id
            ORDER BY products.id DESC
            LIMIT {$limit1}, {$limit2};";
    
        return $this->db->get_all($sql);
    }

    public function product_count_by_cate() {
        $sql = "SELECT COUNT(DISTINCT products.id) AS total_products
                FROM products
                LEFT JOIN product_category ON products.id = product_category.product_id
                LEFT JOIN categories ON product_category.category_id = categories.id";
    
        $result = $this->db->get_one($sql);
        return $result['total_products'];
    }
    

    public function AddProduct($name, $img, $price, $description, $quantity) {
        $sql = "INSERT INTO {$this->table} (`name`, `img`, `price`, `description`, `default_quantity`) VALUES (?, ?, ?, ? ,?)";
        $this->db->CRUD($sql, $name, $img, $price, $description, $quantity);
        return $this->db->lastInsertId();
    }

    public function GetProductAdmin() {
        $sql = "SELECT
        COUNT(id) as total_products
        FROM products";
        return $this->db->get_one($sql);
    }

    public function product_category_delete($id) {
        $sql = "DELETE FROM product_category WHERE product_category.product_id = ?";
        return $this->db->CRUD($sql, $id);
    }

    public function product_size_delete($id) {
        $sql = "DELETE FROM product_size WHERE product_size.product_id = ?";
        return $this->db->CRUD($sql, $id);
    }

    public function UpdateProduct($product_id, $name, $img, $price, $description, $quantity) {
        if($img !== "") {
            $sql = "UPDATE {$this->table} SET `name` = ?, `img` = ?, `price` = ?, `description` = ?, `default_quantity` = ? WHERE id = ?";
            return $this->db->CRUD($sql, $name, $img, $price, $description, $quantity, $product_id);
        }else {
            $sql = "UPDATE {$this->table} SET `name` = ?, `price` = ?, `description` = ?, `default_quantity` = ? WHERE id = ?";
            return $this->db->CRUD($sql, $name, $price, $description, $quantity, $product_id);
        }
    }

    public function product_related() {
        $sql = "SELECT * FROM products LIMIT 10";
        return $this->db->get_all($sql);
    }

    public function UpdateQuantityProduct($product_id, $quantity, $default_quantity){
        $newQuantity = $default_quantity - $quantity;
        $sql = "UPDATE products SET `default_quantity` = ? WHERE id = ?";
        $this->db->CRUD($sql, $newQuantity, $product_id);
        return true;
    }
}
