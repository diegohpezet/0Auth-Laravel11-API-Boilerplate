<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function socialiteLogin(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Handle the callback from the Google authentication page.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleSocialiteCallback(string $provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = User::firstOrCreate([
            'provider' => ucfirst($provider),
            'provider_id' => $providerUser->id,
        ], [
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(12))
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return redirect(env('APP_URL') . '/?token=' . $token);
    }
}
