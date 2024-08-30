<?php
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

// print_r($_SESSION);

// unset($_SESSION['email']);

// unset($_SESSION['productCart']);

require_once "vendor/autoload.php";
require_once "app/Config/Define.php";

use App\Core\Router;

// USER

Router::add('/', 'HomeController@index');
Router::add('/index', 'HomeController@index');

Router::add('/login', "UserController@Login");
Router::add('/register', "UserController@Register");
Router::add('/logout', "UserController@Logout");
Router::add('/ressetPassword', 'UserController@RessetPassword');
Router::add('/handleressetPassword', 'UserController@HandleRessetPassword');
Router::add('/passwordNew', 'UserController@PasswordNew');
Router::add('/handlePasswordNew', 'UserController@HandlePasswordNew');

Router::add('/shop', 'ShopController@index');
Router::add('/shop/category/(\d+)', 'ShopController@index');
Router::add('/shop/pagi/(\d+)', 'ShopController@index');
Router::add('/shop/category/(\d+)/pagi/(\d+)', 'ShopController@index');
Router::add('/shop/search', 'ShopController@search');
Router::add('/shop/search/(\w+)', 'ShopController@index');

Router::add('/about', 'AboutController@index');

Router::add('/contact', 'ContactController@index');


Router::add('/product/detail/(\d+)', 'ShopController@Detail');
// Router::add('/product/pay/(\d+)', 'ShopController@Pay');


Router::add('/cart', 'CartController@Index');
Router::add('/deleteToCart', 'CartController@DeleteToCart');
Router::add('/addToCart', 'CartController@AddToCart');
Router::add('/orderPay', 'OrderControllr@OrderPay');
Router::add('/cart/quantity/add', 'CartController@AddQuantity');
Router::add('/cart/quantity/subtract', 'CartController@SubtractQuantity');
// Router::add('/cart/(\d+)/(\d+)/like', 'CartController@AddFavorites');
// Router::add('/cart/(\d+)/(\d+)/delete', 'CartController@DeleteItemCart');
Router::add('/addVoucher', 'VoucherController@AddVoucher');

Router::add('/addOrder', 'OrderController@OrderPay');
Router::add('/user/order/(\d+)', 'OrderController@Index');
Router::add('/user/order/detail/(\d+)', 'OrderController@OrderDetail');
Router::add('/order/view', 'OrderController@View');


Router::add('/user/info/(\d+)', "UserController@Info");
Router::add('/user/info/save', "UserController@InfoSave");

// ADMIN


Router::add('/admin','AdminController@Index');
Router::add('/admin/products', 'AdminController@ListProduct');
Router::add('/admin/products/pagi/(\d+)', 'AdminController@ListProduct');
Router::add('/admin/products/add', 'AdminController@AddProduct');
Router::add('/admin/products/delete/(\d+)', 'AdminController@DeleteProduct');
Router::add('/admin/products/update/(\d+)', 'AdminController@UpdateProduct');

Router::add('/admin/categories', 'AdminController@ListCategory');
Router::add('/admin/categories/add', 'AdminController@AddCategory');
Router::add('/admin/categories/delete/(\d+)', 'AdminController@DeleteCategory');
Router::add('/admin/categories/update/(\d+)', 'AdminController@UpdateCategory');

Router::add('/admin/orders', 'AdminController@ListOrder');
Router::add('/admin/orders/update/(\d+)', 'AdminController@UpdateOrder');
Router::add('/admin/orders/update/status', 'AdminController@UpdateOrderStatus');

Router::add('/admin/orders/detail/(\d+)', 'AdminController@ListDetailOrder');
Router::add('/admin/orders/detail/delete/(\d+)', 'AdminController@ListDetailOrder');
Router::add('/admin/orders/detail/update/(\d+)', 'AdminController@ListDetailOrder');

Router::add('/admin/banners', "AdminController@ListBanner");
Router::add('/admin/banners/add', "AdminController@AddBanner");
Router::add('/admin/banners/delete/(\d+)', "AdminController@DeleteBanner");
Router::add('/admin/banners/update/(\d+)', "AdminController@UpdateBanner"); 

Router::add('/admin/vouchers', "AdminController@ListVoucher");
Router::add('/admin/vouchers/add', "AdminController@ListVoucher");
Router::add('/admin/vouchers/delete/(\d+)', "AdminController@DeleteVoucher");
Router::add('/admin/vouchers/update/(\d+)', "AdminController@UpdateVoucher"); 

Router::add('/admin/users', "AdminController@ListUser");
Router::add('/admin/users/delete/(\d+)', "AdminController@DeleteUser");
Router::add('/admin/users/update/(\d+)', "AdminController@UpdateUser"); 

$uri = isset($_GET['page']) ? "/".rtrim($_GET['page'], '/') : '/index';
Router::dispatch($uri);
