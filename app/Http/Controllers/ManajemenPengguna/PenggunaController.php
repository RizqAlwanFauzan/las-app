<?php

namespace App\Http\Controllers\ManajemenPengguna;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPengguna\Pengguna\ResetPasswordPenggunaRequest;
use App\Http\Requests\ManajemenPengguna\Pengguna\StorePenggunaRequest;
use App\Http\Requests\ManajemenPengguna\Pengguna\UpdatePenggunaRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $pengguna = User::orderBy('updated_at', 'desc')->get();
        $peran    = Role::orderBy('updated_at', 'asc')->pluck('name');
        $data     = [
            'title'    => 'Pengguna',
            'pengguna' => $pengguna,
            'peran'    => $peran
        ];

        return view('pages.manajemen-pengguna.pengguna', $data);
    }

    public function show(User $user): JsonResponse
    {
        $user->load('roles');
        return response()->json($user);
    }

    public function store(StorePenggunaRequest $request): RedirectResponse
    {
        $validated = $request->all();
        $user = User::create($validated);
        $user->assignRole($validated['peran']);
        return redirect()->back()->with('success', 'Data pengguna berhasil ditambahkan');
    }

    public function update(UpdatePenggunaRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $user->update($validated);
        $user->syncRoles($validated['peran']);
        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->back()->with('success', 'Data pengguna berhasil dihapus');
    }

    public function resetPassword(ResetPasswordPenggunaRequest $request, User $user): RedirectResponse
    {
        $validated = $request->all();
        $user->update($validated);
        return redirect()->back()->with('success', 'Password pengguna berhasil direset');
    }
}
