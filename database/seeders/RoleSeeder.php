<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'owner', 'guard_name' => 'web']);
        Role::create(['name' => 'kasir','guard_name' => 'web']);
        Role::create(['name' => 'instruktur','guard_name' => 'web']);
        Role::create(['name' => 'admin','guard_name' => 'web']);
        Role::create(['name' => 'member','guard_name' => 'web']);
    }
}
