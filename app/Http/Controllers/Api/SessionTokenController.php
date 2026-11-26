<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class SessionTokenController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if (! Auth::once($credentials)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Identifiants Invalide',
                ]
            );
        }


        $token = $request->user()->createToken('api', ['*'], now()->addDay());
        return response()->json(['token' => $token->plainTextToken]);
    }

    public function destroy(Request $request): Response
    {
        $token = $request->user()->currentAccessToken();
        abort_unless($token instanceof PersonalAccessToken, 403);

        $token->delete();

        return response()->noContent();
    }
}
