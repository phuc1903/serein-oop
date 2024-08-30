<?php

header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allows-Headers, Authorization, X-Request-With");

use App\Model\DatabaseModel;
require_once __DIR__."/../../Config/Define.php";
require_once __DIR__."/../../Model/DatabaseModel.php";

$database = new DatabaseModel();

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql = "SELECT orders.id as order_id, orders.total_amount, orders.created_at as day_created, orders.voucher,
            users.user_name, users.email, users.avatar, users.id as user_id, users.address, users.phone
            FROM orders
            JOIN users ON orders.user_id = users.id
            WHERE orders.id = ?";
    $order = $database->get_one($sql, $order_id);

    $sql2 = "SELECT products.name as product_name, products.img as product_img, products.price as product_price,
            order_detail.quantity as product_quantity, order_detail.price_product as total_price
            FROM order_detail
            JOIN products
            ON products.id = order_detail.product_id
            WHERE order_id = ?";
    $order_detail = $database->get_all($sql2, $order['order_id']);

    $link = BASE_PATH;
    
    $order_total = number_format($order['total_amount']);
    // echo json_encode($order);

    $htmlContent = <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Print Order</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 56px;
        }

        header {
            width: 100%;
            height: 100px;
            border: 1px dashed transparent;
            border-image: repeating-linear-gradient(0deg, black, black 2px, transparent 2px, transparent 4px);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            max-height: 100%;
            margin-right: 20px;
        }

        header div {
            flex-grow: 1;
        }

        header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        form {
            width: 100%;
        }

        h3 {
            margin-top: 0;
        }

        table.detail {
            width: 100%;
            border-collapse: collapse;
        }

        table.detail th, table.detail td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table.detail img {
            max-width: 100px;
            max-height: 100px;
        }

        table.detail th {
            width: 15%;
        }

        table.detail td {
            width: 17%;
        }
    </style>
    </head>
    <body>
        <main>
            <header>
                <div>
                <img src="{$link}/Public/img/logo3.png" alt="">
                </div>
                <div>
                    <h2></h2>
                    <!-- <span>
                        Chào mừng bạn đến với Serein - điểm đến thú vị cho những người yêu thời trang trang sức. 
                        Tại Serein, chúng tôi tự hào giới thiệu những thiết kế trang sức độc đáo và sang trọng, 
                        tạo nên những đường nét tinh tế và phong cách đẳng cấp.
                    </span> -->
                </div>
            </header>
            <table>
                <tr>
                    <th colspan="2">Thông tin khách hàng</th>
                </tr>
                <tbody>
                    <tr>
                        <td>Tên khách hàng</td>
                        <td>{$order['user_name']}</td>
                    </tr>
                    <tr>
                        <td>Ngày tạo tài khoản</td>
                        <td>{$order['day_created']}</td>
                    </tr>
                    <tr>
                        <td>Hình thức thanh toán</td>
                        <td>Tiền mặt</td> <!-- Thay bằng dữ liệu từ cơ sở dữ liệu nếu có -->
                    </tr>
                    <tr>
                        <td>Tổng tiền</td>
                        <td>{$order_total} VNĐ</td>
                    </tr>
                </tbody>
            </table>
            <form>
                <h3>Chi tiết đơn hàng</h3>
                <table class="detail">
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                    <tbody>
HTML;
                    $stt = 1;
                    foreach ($order_detail as $detail) {
                        $product_priceNew = number_format($detail['product_price']);
                        $total_price = number_format($detail['total_price']);
                        $htmlContent .= <<<HTML
                        <tr>
                            <td>{$stt}</td>
                            <td><img src="{$link}/{$detail['product_img']}" alt=""></td>
                            <td>{$detail['product_name']}</td>
                            <td>{$detail['product_quantity']}</td>
                            <td>{$product_priceNew} VNĐ</td>
                            <td>{$total_price} VNĐ</td>
                        </tr>
HTML;
                        $stt++;
}

$htmlContent .= <<<HTML
                    </tbody>
                        <tr>
                            <th colspan="4">Tổng thành tiền</th>
                            <td colspan="2">{$order_total} VNĐ</td>
                        </tr>
                    </table>
                </form>
            </main>
        </body>
        </html>
HTML;

header("HTTP/1.0 200 OK");
echo $htmlContent;
}
?>