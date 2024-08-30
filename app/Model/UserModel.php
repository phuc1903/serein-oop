<?php

namespace App\Model;

class UserModel extends SqlModel {
    protected $table;
    protected $db;

    public function __construct() {
        $this->table = "users";
        $this->db = new DatabaseModel();
    }

    public function user_get_all() {
        return parent::get_all_table();
    }
    public function user_get_by_email($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return $this->db->get_one($sql, $email);
    }

    public function registerUser($name, $email, $password) {
        $sql = "INSERT INTO {$this->table} (`user_name`, `email`, `password`) VALUES (?, ?, ?)";
        return $this->db->CRUD($sql, $name, $email, $password);
    }

    public function check_email_existed($email) {
        $this->where = "email";
        return parent::checkAll($email);
    }

    public function AddVoucherUser($id) {
        $sql = "INSERT INTO `user_voucher` (`user_id`, `voucher_id`, `quantity`) VALUES (?, 1, 2)";
        return $this->db->CRUD($sql, $id);
    }

    public function updateUser($name, $avatar, $email, $phone, $address, $sex, $user_id) {
        $sql = "UPDATE {$this->table} SET `user_name` = ?, `avatar` = ?, `email` = ?, `phone` = ?, `address` = ?, `sex` = ? WHERE id = ?";
        return $this->db->CRUD($sql, $name, $avatar, $email, $phone, $address, $sex, $user_id);
    }

    public function SetOTP($email, $OTP, $time_OTP) {
       $sql = "UPDATE {$this->table} SET OTP = ?, time_OTP = ? WHERE email = ?";
        return $this->db->CRUD($sql, $OTP, $time_OTP, $email);
    }

    public function UpdatePassword($password) {
        $sql = "UPDATE {$this->table} SET `password` = ?";
        $result = $this->db->CRUD($sql, $password);
        if(!$result) {
            return true;
        }else {
            return false;
        }
    }
}