<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allows-Headers, Authorization, X-Request-With");

use App\Model\DatabaseModel;
require_once __DIR__."/../../Config/Define.php";
require_once __DIR__."/../../Model/DatabaseModel.php";

$database = new DatabaseModel();

function GetUsers() {
    $sql = "SELECT * FROM users";
    $users = $database->get_all($sql);
    return $users;
}