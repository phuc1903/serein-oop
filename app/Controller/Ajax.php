<?php

namespace App\Controller;

class Ajax {
    public static function setResponse($success, $message, $object = null) {
        $response['success'] = $success;
        $response['message'] = $message;
        $response['html'] = $object;

        echo json_encode($response);
    }
}