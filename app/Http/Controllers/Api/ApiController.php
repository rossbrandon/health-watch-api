<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller as Controller;
use App\User;
use Auth;

class ApiController extends Controller
{
    /**
     * Send success response
     *
     * @param array $result
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $recordCount = is_iterable($result) ? count($result) : 1;
        $response = [
            'success' => true,
            'record_count' => $recordCount,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Send error response
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * Checks if the current user is an admin
     *
     * @return mixed
     */
    protected function isAdmin()
    {
        return User::find(Auth::id())->admin;
    }
}
