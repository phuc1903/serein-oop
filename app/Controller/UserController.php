<?php


namespace App\Controller;
require_once __DIR__."/../../PHPMailer-using-OOP--master/Mail.php";

use App\Model\UserModel;
use App\Model\CartModel;
use DateInterval;
use DateTime;
use Mail;

class UserController extends Controller {
    
    protected $carts;
    protected $email;
    protected $password;
    protected $name;
    protected $users;
    protected $cpassword;
    protected $phone;
    protected $response = array('success' => false, 'message' => '');


    public function __construct() {
        $this->users = new UserModel();
        $this->carts = new CartModel();
        $this->password = isset($_POST['password']) ? $_POST['password'] : null;
        $this->email = isset($_POST['email']) ? $_POST['email'] : "";
        $this->name = isset($_POST['name']) ? $_POST['name'] : "";
        $this->cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : "";
        $this->phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    }

    public function Login() {
        $this->titlePage = "Dang nhap"; 

        if(isset($_SESSION['user'])) {
            header("Location: ".BASE_PATH."/index");
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $this->users->user_get_by_email($this->email);
            if (!empty($user)) {
                if (empty($this->email) || empty($this->password)) {
                    $this->response['message'] = "Vui lòng nhập đầy đủ thông tin";
                } else {
                    if (password_verify($this->password, $user['password'])) {
                        // if(isset($_SESSION['cart'])) {
                        //     foreach ($_SESSION['cart'] as $item) {
                        //         $product_id = $item['product_id'];
                        //         $quantity = $item['cart_quantity'];
                        //         $this->carts->addCart($user['id'], $product_id, $quantity);
                        //         unset($_SESSION['cart']);
                        //     }
                        // }
                        $this->response['success'] = true;
                        $this->response['message'] = "Đăng nhập thành công";
                        $_SESSION['user'] = $user;
                    } else {
                        $this->response['success'] = false;
                        $this->response['message'] = "Mật khẩu sai";
                    }
                }
            } else {
                $this->response['success'] = false;
                $this->response['message'] = "Người dùng không tồn tại";
            }
            header('Content-Type: application/json');
            echo json_encode($this->response);
            return;
        }
    
        $this->renderView("User/Login", $this->titlePage, $this->data);
    }

    public function Register() {
        $this->titlePage = "Đăng ký thành viên";

        if(isset($_SESSION['user'])) {
            header("Location: ".BASE_PATH."/index");
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $passHash = password_hash($this->password, PASSWORD_DEFAULT);
            $this->users->registerUser($this->name, $this->email, $passHash);
            $user = $this->users->check_email_existed($this->email);

            if($user) {
                $this->users->AddVoucherUser($user['id']);
            }

            $this->response['success'] = true;

            header('Content-Type: application/json');
            echo json_encode($this->response);
            return;
        }
        $this->renderView("User/Register", $this->titlePage, $this->data);
    }

    public function Logout() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($_SESSION['voucher']);
        }
        header('Location: '. BASE_PATH . '/index');
    }

    public function Info() {
        $this->titlePage = "Thông tin khách hàng";
        $id = $this->checkUrl('info');
        if(!$_SESSION['user']) {
            header('Location: '.BASE_PATH.'/index');
        }
        $this->renderView('User/Info', $this->titlePage, $this->data);
    }

    public function InfoSave() {
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
            $this->users->updateUser($_POST['name'], $_POST['avatar'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['sex'], $_SESSION['user']['id']);
            $user = $this->users->user_get_by_email($_POST['email']);
            $_SESSION['user'] = $user;
            $this->response['success'] = true;
            $this->response['message'] = "Lưu thông tin thành công";
        }else {
            $this->response['success'] = false;
            $this->response['message'] = "Lỗi";
        }

        echo json_encode($this->response);
    }

    public function RessetPassword() {
        $this->titlePage = "Quên mật khẩu";
        
        $this->renderView("User/RessetPassword", $this->titlePage, $this->data);
    }

    public function HandleRessetPassword() {

        $email = isset($_POST['email']) ? $_POST['email'] : false;

        if($email) {
            $user =  $this->users->user_get_by_email($email);
            if($user) {
                $OTP = rand(100000, 999999);

                $now = new DateTime();
                $now->add(new DateInterval("PT10M"));
                $time_OTP = $now->format("Y-m-d H:i:s");

                $this->users->SetOTP($email, $OTP, $time_OTP);

                $senderName = "SEREIN shop trang sức";
                $senderEmail = "dinhtrongphuc19@gmail.com";
                $senderEmailPassword = "ibug gyin oapk dppd";

                $recieverEmail = $email;
                $subject = "Thay đổi mật khẩu";
                $body = "Vui lòng sử dụng mã OTP sau đây để xác minh và lấy lại mật khẩu. OTP của bạn là: <strong>".$OTP."</strong>. Mã OTP có hiệu lực trong vòng 10 phút";
                
                $mailer = new Mail($senderName,$senderEmail,$senderEmailPassword);
                $senMail = $mailer->sendMail($recieverEmail,$subject,$body);
                if($senMail) {
                    $_SESSION['email'] = $email;
                    Ajax::setResponse(true, "Đã gửi mã OTP cho bạn");
                }else {
                    Ajax::setResponse(false, "Thất bại");
                }
            }else {
                Ajax::setResponse(false, "Tài khoản không tồn tại");
            }
        }else {
            Ajax::setResponse(false, "Vui lòng nhập email");
        }
    }

    public function PasswordNew() {
        $this->titlePage = 'Nhập lại mật khẩu';
        $this->renderView('User/PasswordNew', $this->titlePage, $this->data);
    }


    public function HandlePasswordNew() {
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : false;
        $OTP = isset($_POST['OTP']) ? $_POST['OTP'] : false;
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : false;


        if($password && $cpassword && $OTP && $email) {
            if($password == $cpassword) {
                $passwordMD5 = password_hash($password, PASSWORD_DEFAULT);
                $user = $this->users->user_get_by_email($email);

                $now = new DateTime();
                $time_now = $now->format("Y-m-d H:i:s");

                if($OTP == $user['OTP']) {
                    if ($user['time_OTP'] >= $time_now && $time_now <= $user['time_OTP']) {
                        $updatePassword = $this->users->UpdatePassword($passwordMD5);
                        if($updatePassword) {
                            if(isset($_SESSION['email'])) {
                                unset($_SESSION['email']);
                            }    
                            Ajax::setResponse(true, "Bạn đã đổi password thành công");
                        }
                    } else {
                        Ajax::setResponse(false, "OTP đã hết hạn");  
                    }
                    
                }else {
                    Ajax::setResponse(false, "OTP sai ");    
                }
            }else {
                Ajax::setResponse(false, "Nhập lại mật khẩu sai");
            }
        }else {
            Ajax::setResponse(false, "Vui lòng nhập đầy đủ thông tin");
        }
    }

}
