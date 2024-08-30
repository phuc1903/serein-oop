<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allows-Headers, Authorization, X-Request-With");

use App\Model\DatabaseModel;
require_once __DIR__."/../../Config/Define.php";
require_once __DIR__."/../../Model/DatabaseModel.php";

$database = new DatabaseModel();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 5; 

$startFrom = ($page - 1) * $perPage;

$sql = "SELECT orders.*, users.user_name, users.email
        FROM orders 
        JOIN users 
        ON users.id = orders.user_id 
        LIMIT {$startFrom}, {$perPage}";

$result = $database->get_all($sql);

$sql2 = "SELECT status.name as status_name, order_status.time as status_time, order_status.order_id
        FROM status
        JOIN order_status ON order_status.status_id = status.id
        WHERE order_status.now = 1";
$result2 = $database->get_all($sql2);

$statusInfo = [];
foreach ($result2 as $statusRow) {
    $statusInfo[$statusRow['order_id']] = $statusRow;
}

foreach ($result as &$order) {
    $order['status_name'] = isset($statusInfo[$order['id']]) ? $statusInfo[$order['id']]['status_name'] : 'Đang lỗi';
    $order['status_time'] = isset($statusInfo[$order['id']]) ? $statusInfo[$order['id']]['status_time'] : 'Không có';
}

$countSql = "SELECT COUNT(*) AS totalItems FROM orders";
$countResult = $database->get_all($countSql);
$totalItems = $countResult[0]['totalItems'];

$totalPages = ceil($totalItems / $perPage);

if($result) {
    $data = [
        'totalPages' => $totalPages,
        'data' => $result,
    ];
}

header("HTTP/1.0 200 OK");
echo json_encode($data);
?>
