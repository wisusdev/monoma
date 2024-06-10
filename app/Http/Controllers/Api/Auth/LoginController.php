<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();
        $user = User::whereUsername($credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return new JsonResponse([
                'meta' => [
                    'success' => false,
                    'errors' => [
                        'password incorrect for : ' . $credentials['username']
                    ]
                ],
            ]);
        }

        $tokenResult = $user->createToken('Login');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addHours(24);
        $token->save();

        $minutesUntilExpiration = Carbon::now()->diffInMinutes($token->expires_at);

        $dataResponse = (object)[
            'accessToken' => $tokenResult->accessToken,
            'minutes_until_expiration' => $minutesUntilExpiration
        ];

        return LoginResource::make($dataResponse);
    }
}
