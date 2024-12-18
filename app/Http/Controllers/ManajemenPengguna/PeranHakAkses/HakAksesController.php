<?php

namespace App\Http\Controllers\ManajemenPengguna\PeranHakAkses;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPengguna\PeranHakAkses\HakAkses\StoreHakAksesRequest;
use App\Http\Requests\ManajemenPengguna\PeranHakAkses\HakAkses\UpdateHakAksesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class HakAksesController extends Controller
{
    public function index(): View
    {
        $hakAkses = Permission::orderBy('updated_at', 'desc')->get();
        $data = [
            'title' => 'Hak Akses',
            'hakAkses' => $hakAkses
        ];

        return view('pages.manajemen-pengguna.peran-hak-akses.hak-akses', $data);
    }

    public function show(Permission $permission): JsonResponse
    {
        return response()->json($permission);
    }

    public function store(StoreHakAksesRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Permission::create($validated);
        return redirect()->back()->with('success', 'Data hak akses berhasil ditambahkan');
    }

    public function update(UpdateHakAksesRequest $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validated();
        $permission->update($validated);
        return redirect()->back()->with('success', 'Data hak akses berhasil diperbarui');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return redirect()->back()->with('success', 'Data hak akses berhasil dihapus');
    }
}
