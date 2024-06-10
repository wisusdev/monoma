<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => [
                'token' => $this->accessToken,
                'expires_at' => $this->minutes_until_expiration
            ]
        ];
    }
}
