<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class GeneralService
{
    public function serviceResponse($status, $message = '', $data = null) {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }

    protected function  logError(Throwable $th) 
    {
        Log::warning("Error ", [
            '' => $th
        ]);
    }
}