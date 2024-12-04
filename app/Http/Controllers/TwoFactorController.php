<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.two-factor-verify');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|digits:5']);

        $userId = session('two_factor_user_id');

        if (!$userId) {
            return redirect()->route('login')->withErrors(['message' => 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.']);
        }

        $user = User::find($userId);
        if (!$user || !TwoFactorService::validateCode($user, $request->code)) {
            return back()->withErrors(['code' => 'El código es inválido o ha expirado.']);
        }

        // Limpiar el código de 2FA y autenticar al usuario
        TwoFactorService::clearCode($user);

        auth()->login($user);

        return redirect()->route('dashboard');

    }
}