<?php

namespace App\Exceptions\JsonApi;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotFoundHttpException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request)
    {
        $id = $request->input('data.id');
        $type = $request->input('data.type');

        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => [
                    'No lead found'
                ]
            ]
        ], 404);
    }
}
