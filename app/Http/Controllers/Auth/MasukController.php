<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Masuk\AuthenticateMasukRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MasukController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Masuk',
        ];

        return view('pages.auth.masuk', $data);
    }

    public function authenticate(AuthenticateMasukRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->back()->with('error', 'Login gagal, email atau password salah.');
    }
}
