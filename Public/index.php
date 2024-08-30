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
                <img src="" alt="">
            </div>
            <div>
                <h2>SEREIN - Shop trang sức sang trọng quý phái</h2>
                <span>
                    Chào mừng bạn đến với Serein - điểm đến thú vị cho những người yêu thời trang trang sức. 
                    Tại Serein, chúng tôi tự hào giới thiệu những thiết kế trang sức độc đáo và sang trọng, 
                    tạo nên những đường nét tinh tế và phong cách đẳng cấp.
                </span>
            </div>
        </header>
        <table>
            <tr>
                <th colspan="2">Thông tin khách hàng</th>
            </tr>
            <tbody>
                <tr>
                    <td>Tên khách hàng</td>
                    <td>Đinh Trọng Phúc</td>
                </tr>
                <tr>
                    <td>Ngày tạo tài khoản</td>
                    <td>29/03/2004 02:22:19</td>
                </tr>
                <tr>
                    <td>Hình thức thanh toán</td>
                    <td>Tiền mặt</td>
                </tr>
                <tr>
                    <td>Tổng tiền</td>
                    <td>220.000.222.222 VNĐ</td>
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
                    <tr>
                        <td>2</td>
                        <td><img src="" alt=""></td>
                        <td>Nhẫn kim cương</td>
                        <td>12</td>
                        <td>222.222.222.000 VNĐ</td>
                        <td>222.222.222.000 VNĐ</td>
                    </tr>
                </tbody>
                <tr>
                    <th colspan="5">Tổng thành tiền</th>
                    <td>78.222.222 VND</td>
                </tr>
            </table>
        </form>
    </main>
</body>
</html>
