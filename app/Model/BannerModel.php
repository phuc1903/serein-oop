<?php

namespace App\Model;

class BannerModel extends SqlModel {

    public function __construct() {
        parent::__construct();
        $this->table = "banners";
    }

    public function getBannerShow() {
        $sql = "SELECT * FROM banners WHERE banner_show = 1 LIMIT 1 ";
        return $this->db->get_one($sql);
    }

    public function banner_get_all() {
        return parent::get_all_table();
    }

    public function banner_delete_one($id) {
        $this->where = "id";
        return parent::delete_one($id);
    }

    public function AddBanner($collection, $title, $des, $link, $action, $banner_show, $img, $background) {
        $sql = "INSERT INTO {$this->table} (`collection`, `title`, `des`, `link`, `action`, `banner_show`, `img`, `background`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->CRUD($sql, $collection, $title, $des, $link, $action, $banner_show, $img, $background);
    }

    public function banner_get_by_id($id) {
        return parent::get_one_table($id);
    }

    public function UpdateBanner($banner_id, $collection, $title, $des, $link, $action, $banner_show, $img, $background) {
        if($img !== "") {
            $sql = "UPDATE {$this->table} SET `collection` = ?, `title` = ?, `des` = ?, `link` = ?, `action` = ?, `banner_show` = ?, `img` = ?, `background` = ? WHERE id = ?";
            return $this->db->CRUD($sql, $collection, $title, $des, $link, $action, $banner_show, $img, $background, $banner_id);
        }else {
            $sql = "UPDATE {$this->table} SET `collection` = ?, `title` = ?, `des` = ?, `link` = ?, `action` = ?, `banner_show` = ?, `background` = ? WHERE id = ?";
            return $this->db->CRUD($sql, $collection, $title, $des, $link, $action, $banner_show, $background, $banner_id);
        }
    }
}