<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Daftar\StoreDaftarRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DaftarController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Daftar',
        ];

        return view('pages.auth.daftar', $data);
    }

    public function store(StoreDaftarRequest $request): RedirectResponse
    {
        $validated = $request->all();
        $user = User::create($validated);
        $user->assignRole('user');
        return redirect()->back()->with('success', 'Berhasil mendaftarkan akun baru');
    }
}
