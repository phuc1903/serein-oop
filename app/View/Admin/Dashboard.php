<?php

include_once __DIR__."/Layouts/Header.php";
include_once __DIR__."/Layouts/header_admin.php";

// print_r($data['Products']);

// $Sales = $data['Sales'];
// $Products = $data['Products'];

$revenue = 0;
foreach($data['order_success'] as $item) {
    $revenue += $item['total_amount'];
} 

?>

<head>
        <meta charset="utf-8">
        <title>Dashboard 2 | Zircos - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->

        <!-- <link href="assets\libs\bootstrap-daterangepicker\daterangepicker.css" rel="stylesheet"> -->

        <!-- App css -->
        <link href="<?=BASE_PATH.'/Public/assets/css\bootstrap.min.css'?>" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
        <link href="<?=BASE_PATH.'/Public/assets/css\icons.min.css'?>" rel="stylesheet" type="text/css">
        <link href="<?=BASE_PATH.'/Public/assets/css\app.min.css'?>" rel="stylesheet" type="text/css" id="app-stylesheet">

    </head>

    <body data-layout="horizontal">

        <!-- Begin page -->
        <div id="wrapper">

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li> -->
                                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard </a></li> -->
                                    <!-- <li class="breadcrumb-item active">Dashboard 2</li> -->
                                </ol>
                            </div>
                            <h4 class="page-title">Doanh thu</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-primary bg-soft-primary">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-chart-areaspline font-30 widget-icon rounded-circle avatar-title text-primary"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="Statistics">Doanh thu</p>
                                    <h2><span data-plugin="counterup"><?=number_format($revenue)?></span> <i class="mdi mdi-arrow-up text-success font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 30.4k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-warning bg-soft-warning">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-layers font-30 widget-icon rounded-circle avatar-title text-warning"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="User This Month">Tổng đơn hàng</p>
                                    <h2><span data-plugin="counterup"><?=$data['count_order']?></span> <i class="mdi mdi-arrow-up text-success font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medi um">Last:</span> 40.33k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-danger bg-soft-danger">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-av-timer font-30 widget-icon rounded-circle avatar-title text-danger"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="Statistics">Đã hủy</p>
                                    <h2><span data-plugin="counterup"><?=$Sales['fail']?></span> <i class="mdi mdi-arrow-down  font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 956</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-warning bg-soft-warning">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-av-timer font-30 widget-icon rounded-circle avatar-title text-warning"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="Statistics">Đang xử lý</p>
                                    <h2><span data-plugin="counterup"><?=$Sales['processing']?></span> <i class="mdi mdi-arrow-up text-success  font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 956</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-success bg-soft-success">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-account-convert font-30 widget-icon rounded-circle avatar-title text-success"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="User Today">Thành công</p>
                                    <h2><span data-plugin="counterup"><?=$Sales['success']?></span> <i class="mdi mdi-arrow-up text-success  font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 1250</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>

                <!-- products -->

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li> -->
                                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard </a></li> -->
                                    <!-- <li class="breadcrumb-item active">Dashboard 2</li> -->
                                </ol>
                            </div>
                            <h4 class="page-title">Sản phẩm</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-primary bg-soft-primary">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-chart-areaspline font-30 widget-icon rounded-circle avatar-title text-primary"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="Statistics">Số mặt hàng</p>
                                    <h2><span data-plugin="counterup"><?=$Products['total_products']?></span> <i class="mdi mdi-arrow-up text-success font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 30.4k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-warning bg-soft-warning">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-layers font-30 widget-icon rounded-circle avatar-title text-warning"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="User This Month">Số lượng tồn kho</p>
                                    <h2><span data-plugin="counterup"><?=$Sales['total_order']?></span> <i class="mdi mdi-arrow-up text-success font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 40.33k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-danger bg-soft-danger">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-av-timer font-30 widget-icon rounded-circle avatar-title text-danger"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-6 text-uppercase font-weight-bold text-muted" title="Statistics">Số lượng sản phẩm bán ra</p>
                                    <h2><span data-plugin="counterup"><?=$Sales['fail']?></span> <i class="mdi mdi-arrow-down  font-24"></i></h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Last:</span> 956</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col-lg-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Messages</h4>

                            <div class="inbox-widget slimscroll" style="max-height: 360px;">
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-1.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Chadengle</p>
                                        <p class="inbox-item-text font-12">Hey! there I'm available...</p>
                                        <p class="inbox-item-date">13:40 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-2.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Tomaslau</p>
                                        <p class="inbox-item-text font-12">I've finished it! See you so...</p>
                                        <p class="inbox-item-date">13:34 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-3.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Stillnotdavid</p>
                                        <p class="inbox-item-text font-12">This theme is awesome!</p>
                                        <p class="inbox-item-date">13:17 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-4.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Kurafire</p>
                                        <p class="inbox-item-text font-12">Nice to meet you</p>
                                        <p class="inbox-item-date">12:20 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-5.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Shahedk</p>
                                        <p class="inbox-item-text font-12">Hey! there I'm available...</p>
                                        <p class="inbox-item-date">10:15 AM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-6.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Adhamdannaway</p>
                                        <p class="inbox-item-text font-12">This theme is awesome!</p>
                                        <p class="inbox-item-date">9:56 AM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-8.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Arashasghari</p>
                                        <p class="inbox-item-text font-12">Hey! there I'm available...</p>
                                        <p class="inbox-item-date">10:15 AM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-9.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Joshaustin</p>
                                        <p class="inbox-item-text font-12">I've finished it! See you so...</p>
                                        <p class="inbox-item-date">9:56 AM</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-lg-8">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Recent Users</h4>

                            <div class="table-responsive">
                                <table class="table table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <img src="assets\images\users\avatar-6.jpg" alt="user" class="avatar-sm rounded-circle">
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Louis Hansen</h5>
                                                <p class="m-0 text-muted font-13"><small>Web designer</small></p>
                                            </td>
                                            <td>+12 3456 789</td>
                                            <td>USA</td>
                                            <td>07/08/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-primary">C</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Craig Hause</h5>
                                                <p class="m-0 text-muted font-13"><small>Programmer</small></p>
                                            </td>
                                            <td>+89 345 6789</td>
                                            <td>Canada</td>
                                            <td>29/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <img src="assets\images\users\avatar-7.jpg" alt="user" class="avatar-sm rounded-circle">
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Edward Grimes</h5>
                                                <p class="m-0 text-muted font-13"><small>Founder</small></p>
                                            </td>
                                            <td>+12 29856 256</td>
                                            <td>Brazil</td>
                                            <td>22/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-pink">B</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Bret Weaver</h5>
                                                <p class="m-0 text-muted font-13"><small>Web designer</small></p>
                                            </td>
                                            <td>+00 567 890</td>
                                            <td>USA</td>
                                            <td>20/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <img src="assets\images\users\avatar-8.jpg" alt="user" class="avatar-sm rounded-circle">
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Mark</h5>
                                                <p class="m-0 text-muted font-13"><small>Web design</small></p>
                                            </td>
                                            <td>+91 123 456</td>
                                            <td>India</td>
                                            <td>07/07/2016</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <!-- table-responsive -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div>
            <!-- end container-fluid -->

        </div>
                <!-- end content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2018 - 2020 &copy; Zircos theme by <a href="">Coderthemes</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- <script src="<?=BASE_PATH.'\assets\js\vendor.min.js'?>"></script>

        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.time.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.tooltip.min.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.resize.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.pie.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.crosshair.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\flot-charts\jquery.flot.selection.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\moment\moment.min.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\libs\bootstrap-daterangepicker\daterangepicker.js'?>"></script>
        <script src="<?=BASE_PATH.'\assets\js\pages\dashboard_2.init.js'?>"></script> -->

        <!-- App js -->
        <!-- <script src="<?=BASE_PATH.'\assets\js\app.min.js'?>"></script> -->

<?php 

include_once __DIR__."/../Layout/Footer.php";
// $sales = $data['Sales'];
// echo $sales['total_sum'];   
?>

