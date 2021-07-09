<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message, $code = 200) {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errMessage = [], $code = 500) {
        $response = [
            'success' => false,
            'message' => $error
        ];
        if (empty($errMessage)) {
            return response()->json($response, $code);
        }
        $response['errMessage'] = $errMessage;
        return response()->json($response, $code);
    }
}
