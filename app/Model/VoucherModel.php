<?php

namespace App\Model;

class VoucherModel extends SqlModel {
    protected $table;
    protected $db;

    public function __construct() {
        $this->table = "voucher";
        $this->db = new DatabaseModel;
    }

    public function voucher_get_all() {
        return parent::get_all_table();
    }

    public function voucher_delete($id) {
        $this->where = "voucher.id";
        return parent::delete_one($id);
    }

    public function voucher_user_delete($id) {
        $this->where = "voucher_user.voucher_id";
        $this->table = "voucher_user";
        return parent::delete_one($id);
    }

    public function vouchet_get_by_code($code) {
        $sql = "SELECT * FROM {$this->table} WHERE code LIKE '%{$code}%'";
        return $this->db->get_one($sql);
    }

    public function voucher_get_by_user($user_id, $voucher_id) {
        $sql = "SELECT * FROM user_voucher WHERE user_id = ? AND voucher_id = ?";
        return $this->db->get_one($sql, $user_id, $voucher_id);
    }

    public function voucher_update_quantiy_user($user_id, $voucher_id) {
        $sql = "UPDATE user_voucher SET quantity = quantity - 1 WHERE user_id = ? AND voucher_id = ?";
        return $this->db->CRUD($sql, $user_id, $voucher_id);
    }

}