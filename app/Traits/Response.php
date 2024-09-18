<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Response
{
    private function sendResponse($status, $message, $data = null,  $code)
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $code ?: $status);
    }
}
