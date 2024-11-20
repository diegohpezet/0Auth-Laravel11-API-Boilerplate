<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified'], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email sent successfully'], 200);
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified'], 400);
        }

        if ($request->user()->markEmailAsVerified()) {
            return response()->json(['message' => 'Email verified successfully'], 200);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
    }
}
