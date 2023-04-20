<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $roles = Role::all();
        foreach ($roles as $role) {
            User::create([
                'role_id' => $role->id,
                'nama' => str_replace(' ', '_', $role->role),
                'email' => str_replace(' ', '_', $role->role) . '@gmail.com',
                'password' => bcrypt(str_replace(' ', '_', $role->role)),
            ]);
        }
    }
}