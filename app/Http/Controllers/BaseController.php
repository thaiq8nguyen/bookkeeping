<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'result' => $result,
            'message' => $message
        ];


        return response()->json($response, 200);
    }

    public function sendError($errors, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message'=> $errors
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
