<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiController extends Controller
{
    /**
     * Return success response.
     * 
     * @return \Illuminate\Http\Response
     */
    public function successful($data, int $code = Response::HTTP_OK, string $message = null)
    {
        return response()->json([
            'message'     => $message,
            'code'        => $code,
            'data'        => $data,

        ], $code);
    }

    /**
     * Return error response.
     * 
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\Response
     */
    public function failed(string $message, int $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
        ], $code);
    }
}
