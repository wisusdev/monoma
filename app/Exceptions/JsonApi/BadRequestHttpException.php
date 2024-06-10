<?php

namespace App\Exceptions\JsonApi;

use Exception;
use Illuminate\Http\Request;

class BadRequestHttpException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => [
                    $this->getMessage()
                ]
            ]
        ], 400);
    }
}
