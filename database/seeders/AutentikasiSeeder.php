<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AutentikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard',
            'pengguna',
            'daftar-pengguna',
            'detail-pengguna',
            'tambah-pengguna',
            'ubah-pengguna',
            'hapus-pengguna',
            'reset-password-pengguna',
            'peran',
            'daftar-peran',
            'detail-peran',
            'tambah-peran',
            'ubah-peran',
            'hapus-peran',
            'kelola-hak-akses-peran',
            'hak-akses',
            'daftar-hak-akses',
            'detail-hak-akses',
            'tambah-hak-akses',
            'ubah-hak-akses',
            'hapus-hak-akses',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = ['superadmin', 'admin', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $users = [
            ['name' => 'Superadmin', 'email' => 'superadmin@gmail.com', 'password' => 'password123', 'role' => 'superadmin'],
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => 'password123', 'role' => 'admin'],
            ['name' => 'User', 'email' => 'user@gmail.com', 'password' => 'password123', 'role' => 'user'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'password' => Hash::make($userData['password'])]
            );
            $user->assignRole($userData['role']);
        }

        $roleSuperadmin = Role::findByName('superadmin');
        $roleSuperadmin->syncPermissions($permissions);

        $excludedPermission = ['reset-password-pengguna', 'kelola-hak-akses-peran'];
        $roleAdmin = Role::findByName('admin');
        $roleAdmin->syncPermissions(array_diff($permissions, $excludedPermission));

        $roleUser = Role::findByName('user');
        $roleUser->syncPermissions(['dashboard']);
    }
}
