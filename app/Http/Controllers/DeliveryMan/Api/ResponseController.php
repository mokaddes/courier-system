<?php

namespace App\Http\Controllers\DeliveryMan\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;


class ResponseController extends Controller
{

    /**
     * @param int $code
     * @param string $msg
     * @param $data
     * @param int $status
     * @param string $description
     * @return object
     */
    public static function sendResponse(int $code, string $msg, $data = null, int $status = 1, string $description = '') : object
    {
        return (object) array(
            'status'        => $status,
            'success'       => true,
            'code'          => $code,
            'message'       => $msg,
            'description'   => $description,
            'data'          => $data,
        );
    }

    /**
     * return error response.
     * @param $error
     * @param mixed $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public static function sendError($error, $errorMessages , int $code = 500)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * @param int $status
     * @param string $res
     * @param $msg
     * @param array $data
     * @param $mode
     * @return object
     */
    public static function apiResponse(int $status, string $res, $msg, array $data = [], $mode = null) : object
    {
        return (object) array(
            'status'        => $status,
            'response'      => $res,
            'message'       => $msg,
            'data'          => $data,
            'mode'          => $mode,
        );
    }




}
