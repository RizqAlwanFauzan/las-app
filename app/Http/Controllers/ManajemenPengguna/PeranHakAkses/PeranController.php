<?php

namespace App\Http\Controllers\ManajemenPengguna\PeranHakAkses;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPengguna\PeranHakAkses\Peran\KelolaHakAksesPeranRequest;
use App\Http\Requests\ManajemenPengguna\PeranHakAkses\Peran\StorePeranRequest;
use App\Http\Requests\ManajemenPengguna\PeranHakAkses\Peran\UpdatePeranRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PeranController extends Controller
{
    public function index(): View
    {
        $peran        = Role::orderBy('updated_at', 'desc')->get();
        $hakAkses     = Permission::orderBy('updated_at', 'asc')->get();
        $hakAksesGrup = $hakAkses->groupBy(fn($permission) => explode('.', $permission->name)[0])->map(fn($group) => $group->pluck('name', 'id'));
        $data         = [
            'title'        => 'Peran',
            'peran'        => $peran,
            'hakAksesGrup' => $hakAksesGrup
        ];

        return view('pages.manajemen-pengguna.peran-hak-akses.peran', $data);
    }

    public function show(Role $role): JsonResponse
    {
        $role->load('permissions');
        return response()->json($role);
    }

    public function store(StorePeranRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Role::create($validated);
        return redirect()->back()->with('success', 'Data peran berhasil ditambahkan');
    }

    public function update(UpdatePeranRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();
        $role->update($validated);
        return redirect()->back()->with('success', 'Data peran berhasil diperbarui');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()->back()->with('success', 'Data peran berhasil dihapus');
    }

    public function kelolaHakAkses(KelolaHakAksesPeranRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();
        $role->syncPermissions($validated['hak_akses'] ?? []);
        return redirect()->back()->with('success', 'Data hak akses berhasil diperbarui');
    }
}
