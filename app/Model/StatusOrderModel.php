<?php

namespace App\Model;

class StatusOrderModel extends SqlModel{
    protected $table;
    protected $tableForeign;
    protected $db;

    public function __construct(){
        $this->table = "status";
        $this->tableForeign = "order_status";
        $this->db = new DatabaseModel();
    }

    public function status_get_all() {
        return parent::get_all_table();
    }

    public function UpdateStatusOrder($order_id, $status_id, $status_now) {
        $sql1 = "UPDATE order_status SET `now` = 0 WHERE order_id = ? AND `status_id` = ?";
        $result1 = $this->db->CRUD($sql1, $order_id, $status_now);
    
        $sql2 = "INSERT INTO order_status (`order_id`, `status_id`, `now`) VALUES (?, ?, ?)";
        $result2 = $this->db->CRUD($sql2, $order_id, $status_id, 1);
        // $sql2 = "UPDATE order_status SET `now` = 1 WHERE order_id = ? AND status_id = ?";
        // $result2 = $this->db->CRUD($sql2, $status_now, $order_id, $status_id);
    
        if (!$result1 && !$result2) {
            return true;
        } else {
            return false;
        }
    }
    
}