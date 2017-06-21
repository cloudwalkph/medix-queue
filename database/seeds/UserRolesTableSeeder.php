<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin',
            'Staff'
        ];

        foreach ($roles as $role) {
            \App\Models\UserRole::create([
                'name'  => $role,
                'slug'  => \Illuminate\Support\Str::slug($role)
            ]);
        }
    }
}
