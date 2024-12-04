<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class TwoFactorService
{
    public static function generateCode($user)
    {
        $code = rand(10000, 99999);

        $user->two_factor_code = $code;
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        // $user->update([
        //     'two_factor_code' => $code,
        //     'two_factor_expires_at' => now()->addMinutes(10),
        // ]);

        Mail::to($user->email)->send(new \App\Mail\TwoFactorCodeMail($code));
    }

    public static function validateCode($user, $code)
    {
        return $user->two_factor_code === $code && now()->lessThanOrEqualTo($user->two_factor_expires_at);
    }

    public static function clearCode($user)
    {
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();
    }
}
