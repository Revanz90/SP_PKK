<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view data_simpanan']);
        Permission::create(['name' => 'create data_simpanan']);
        Permission::create(['name' => 'view data_pinjaman']);
        Permission::create(['name' => 'create data_pinjaman']);
        Permission::create(['name' => 'view data_angsuran']);
        Permission::create(['name' => 'create data_angsuran']);

        //create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view data_simpanan');
        $adminRole->givePermissionTo('create data_simpanan');
        $adminRole->givePermissionTo('view data_pinjaman');
        $adminRole->givePermissionTo('create data_pinjaman');
        $adminRole->givePermissionTo('view data_angsuran');
        $adminRole->givePermissionTo('create data_angsuran');

        $ketuaRole = Role::create(['name' => 'ketua']);
        $ketuaRole->givePermissionTo('view data_simpanan');
        $ketuaRole->givePermissionTo('create data_simpanan');
        $ketuaRole->givePermissionTo('view data_pinjaman');
        $ketuaRole->givePermissionTo('create data_pinjaman');
        $ketuaRole->givePermissionTo('view data_angsuran');
        $ketuaRole->givePermissionTo('create data_angsuran');

        $bendaharaRole = Role::create(['name' => 'bendahara']);
        $bendaharaRole->givePermissionTo('view data_simpanan');
        $bendaharaRole->givePermissionTo('create data_simpanan');
        $bendaharaRole->givePermissionTo('view data_pinjaman');
        $bendaharaRole->givePermissionTo('create data_pinjaman');
        $bendaharaRole->givePermissionTo('view data_angsuran');
        $bendaharaRole->givePermissionTo('create data_angsuran');

        $anggotaRole = Role::create(['name' => 'anggota']);
        $anggotaRole->givePermissionTo('view data_simpanan');
        $anggotaRole->givePermissionTo('create data_simpanan');
        $anggotaRole->givePermissionTo('view data_pinjaman');
        $anggotaRole->givePermissionTo('create data_pinjaman');
        $anggotaRole->givePermissionTo('view data_angsuran');
        $anggotaRole->givePermissionTo('create data_angsuran');

        // create superadmintaud
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($adminRole);

        // create kamus
        $user = User::factory()->create([
            'name' => 'ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($ketuaRole);

        // create admintaud
        $user = User::factory()->create([
            'name' => 'bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($bendaharaRole);

        // create stafftaud
        $user = User::factory()->create([
            'name' => 'anggota',
            'email' => 'anggota@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($anggotaRole);
    }
}
