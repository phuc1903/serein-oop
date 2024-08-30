<?php

namespace App\Model;

class CategoryModel extends SqlModel {
    public function __construct() {
        parent::__construct();
        $this->table = "categories";
    }

    public function category_get_all() {
        return parent::get_all_table();
    }

    public function category_get_by_id($id) {
        return parent::get_one_table($id);
    }

    public function category_delete($id) {
        $sql = "DELETE FROM categories WHERE categories.id = ?";
        return $this->db->CRUD($sql, $id);
    }

    public function product_category_delete($id) {
        $sql = "DELETE FROM product_category WHERE product_category.category_id = ?";
        return $this->db->CRUD($sql, $id);
    }

    public function AddCategoryByProduct($category_id, $product_id) {
        $sql = "INSERT INTO product_category (`category_id`, `product_id`) VALUE (?, ?)";
        return $this->db->CRUD($sql, $category_id, $product_id);
    }

    public function AddCategory($name, $img, $description, $status) {
        $sql = "INSERT INTO {$this->table} (`name`, `img`, `description`, `status`) VALUES (?, ?, ?, ?)";
        return $this->db->CRUD($sql,$name, $img, $description, $status);
    }

    public function UpdateCategory($category_id, $name, $img, $description, $status) {
        if($img !== "") {
            $sql = "UPDATE {$this->table} SET `name` = ?, `img` = ?, `description` = ?, `status` = ? WHERE id = ?";
            return $this->db->CRUD($sql, $name, $img, $description, $status, $category_id);
        }else {
            $sql = "UPDATE {$this->table} SET `name` = ?, `description` = ?, `status` = ? WHERE id = ?";
            return $this->db->CRUD($sql, $name, $description, $status, $category_id);
        }
    }
}