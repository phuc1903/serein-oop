<?php

namespace App\Controller;

use App\Model\OrderModel;
use App\Model\VoucherModel;
use DateTimeZone;
use DateTime;

class VoucherController extends Controller {
    protected $voucher;
    protected $order;
    protected $response = array('success' => false, 'message' => '');

    public function __construct() {
        $this->voucher = new VoucherModel();
        $this->order = new OrderModel();
    }

    public function AddVoucher() {
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST") {
            $codeVouhcer = $_POST['code'];
            $voucherByCode = $this->voucher->vouchet_get_by_code($codeVouhcer);

            if($voucherByCode) {
            
                $dayNow = $this->GetTimeNow();

                if($dayNow < $voucherByCode['day_start']){
                    Ajax::setResponse(false, "Voucher chưa đến hạn sử dụng");
                }else if  ($dayNow < $voucherByCode['day_start']) {
                    Ajax::setResponse(false, "Voucher đã hết hạn sử dụng");
                }else {
                    if(isset($_SESSION['user'])) {
                        if($voucherByCode['quantity'] >= 0) {
                            $voucherByUser = $this->voucher->voucher_get_by_user($_SESSION['user']['id'], $voucherByCode['id']);
                            if(isset($voucherByUser) && $voucherByUser['quantity'] > 0) {
                                $this->voucher->voucher_update_quantiy_user($_SESSION['user']['id'], $voucherByCode['id']);
                                $_SESSION['voucher'] = $voucherByCode;
                                Ajax::setResponse(false, "Bạn đã thêm voucher thành công");
                            }else {
                                Ajax::setResponse(false, "Voucher này bạn đã hết");
                            }
                        }
                    }else {
                        Ajax::setResponse(false, "Vui lòng đăng nhập để sử dụng voucher này");
                    }
                }
            }else {
                Ajax::setResponse(false, "Voucher không tồn tại");
            }
            return;
        }
    }

    private function GetTimeNow() {
        $desiredTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $currentTime = new DateTime('now', new DateTimeZone('UTC'));
        $currentTime->setTimezone($desiredTimeZone);
        $formattedTime = $currentTime->format('Y-m-d H:i:s');
        return $formattedTime;
    }
}