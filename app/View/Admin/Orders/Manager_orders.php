<?php

include_once __DIR__."/../../Layout/Header.php";
include_once __DIR__."/../Layouts/header_admin.php";

?>

<div class="col l-9 main__admin">
    <h1>Quản lý đơn hàng</h1>
    <div class="manager-main">
        <table class="manager-table" style="width: 100%;">
            <tr class="manager-header">
                <th>STT</th>
                <th>Tổng tiền</th>
                <th>Tên khách hàng</th>
                <th>Voucher</th>
                <th>Trạng thái</th>
                <th>Ngày trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
            <tbody class="manager-body" id="orders">
                
            </tbody>
        </table>
        <hr style="margin-bottom: 20px;">
        <div class="pagination" id="pagi">

        </div>
    </div>
</div>

<?php

include_once __DIR__."/../../Layout/Footer.php";