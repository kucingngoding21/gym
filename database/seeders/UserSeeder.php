<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'Hi Admin',
            'middle_name' => 'Hi Admin',
            'last_name' => 'Hi Admin',
            'gender' => 'Male',
            'role_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'first_name' => 'Hi owner',
            'middle_name' => 'Hi owner',
            'last_name' => 'Hi owner',
            'gender' => 'Male',
            'role_name' => 'owner',
            'email' => 'owner@owner.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('owner');

        $kasir = User::create([
            'first_name' => 'Hi kasir',
            'middle_name' => 'Hi kasir',
            'last_name' => 'Hi kasir',
            'gender' => 'Male',
            'role_name' => 'kasir',
            'email' => 'kasir@kasir.com',
            'password' => bcrypt('12345678'),
        ]);

        $kasir->assignRole('kasir');

        $kasir = User::create([
            'first_name' => 'Hi Instruktur',
            'middle_name' => 'Hi Instruktur',
            'last_name' => 'Hi Instruktur',
            'gender' => 'Male',
            'role_name' => 'instruktur',
            'email' => 'instruktur@instruktur.com',
            'password' => bcrypt('12345678'),
        ]);

        $kasir->assignRole('member');

        $kasir = User::create([
            'first_name' => 'Hi Member',
            'middle_name' => 'Hi Member',
            'last_name' => 'Hi Member',
            'gender' => 'Male',
            'role_name' => 'member',
            'email' => 'member@member.com',
            'password' => bcrypt('12345678'),
        ]);

        $kasir->assignRole('member');

    }
}
