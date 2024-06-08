<?php

namespace App\Traits;

trait HttpResponses {

    protected function success($data, $message = null, $code=200)
    {
        return response()->json([
           'status' => '(^v^) Request ze Success.',
            'data' => $data,
           'message' => $message
        ], $code);
    }

    protected function error($data, $message = null, $code)
    {
        return response()->json([
           'status' => '(TvT) Error ze occured...',
            'data' => $data,
           'message' => $message
        ], $code);
    }
}

