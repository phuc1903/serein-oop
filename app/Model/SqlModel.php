<?php

namespace App\Model;

class SqlModel {
    protected $db;
    protected $table;
    protected $table1;
    protected $where;
    protected $orderBy;
    protected $column;
    protected $value;
    protected $primaryKey = "id";
    
    public function __construct() {
        $this->db = new DatabaseModel;
    }

    // public function __destruct(){
    //     unset($this->db);
    // }
    

    public function get_all_orderBy($limit) {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$this->orderBy} DESC LIMIT {$limit}";
        return $this->db->get_all($sql);
    }

    public function get_all_table() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->get_all($sql); 
    }

    public function get_all_view_limit($view, $limit) {
        $sql = "SELECT * FROM {$this->table} ";

        if ($view < 0)  $sql .= "ORDER BY view DESC LIMIT " . $limit;
        else $sql .= "ORDER BY {$this->primaryKey} DESC LIMIT " . $limit;

        return $this->db->get_all($sql);
    }

    public function get_all_by_iddm($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->orderBy} = ". $id;
        return $this->db->get_all($sql);
    }

    public function get_all_by_one($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->orderBy} = ". $id;
        return $this->db->get_one($sql);
    }

    public function get_one_table($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->db->get_one($sql, $id);
    }

    public function get_all_limit($limit) {
        $sql = "SELECT * FROM {$this->table} LIMIT " . $limit;
        return $this->db->get_all($sql);
    }

    // public function product_get_all_By_IdCate($idCate, $page, $ProductQuantity) {
    //     $limit1 = ($page - 1) * $ProductQuantity;
    //     $limit2 = $ProductQuantity;
    
    //     $sql = "SELECT products.* FROM products";
    
    //     if ($idCate > 0) {
    //         $sql .= " INNER JOIN product_category ON products.id = product_category.product_id";
    //         $sql .= " WHERE product_category.category_id = {$idCate}";
    //     }
    
    //     $sql .= " ORDER BY products.id DESC LIMIT {$limit1}, {$limit2}";
    
    //     return $this->db->get_all($sql);
    // }

    public function getTotalProducts($idCate) {
        $sql = "SELECT COUNT(products.id) as total FROM products";

        if ($idCate > 0) {
            $sql .= " INNER JOIN product_category ON products.id = product_category.product_id";
            $sql .= " WHERE product_category.category_id = {$idCate}";
        }

        $result = $this->db->get_one($sql);

        return isset($result['total']) ? $result['total'] : 0;
    }
    

    public function get_all_related($id, $view, $limit = null) {
        $sql = "SELECT * FROM {$this->table1} WHERE {$this->where} = (SELECT id FROM {$this->table} WHERE id = {$id})";
        if ($view > 0 && isset($limit)) {
            $sql .= " LIMIT {$limit}";
        }
        return $this->db->get_all($sql);
    }

    public function checkAll($parameter) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->where} = ?";
        return $this->db->get_one($sql,$parameter);
    }

    public function delete_one($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->where} = ?";
        return $this->db->CRUD($sql, $id);
    }

    public function InsertInto(...$paramter) {
        $sql = "INSERT INTO {$this->table} ({$this->column}) VALUE({$this->value})";
        $this->db->CRUD($sql, ...$paramter);
        $lastInsertId = $this->db->lastInsertId();
        return $lastInsertId;
    }

    


}