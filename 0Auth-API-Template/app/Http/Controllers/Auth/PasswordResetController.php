<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Http\Requests\Auth\SendPasswordResetLinkRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function sendPasswordResetLink(SendPasswordResetLinkRequest $request)
    {
        Password::sendResetLink($request->only('email'));

        return response()->json([
            'message' => 'Password reset link sent successfully.'
        ], 200);
    }

    public function resetPassword(PasswordResetRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);
    }
}
