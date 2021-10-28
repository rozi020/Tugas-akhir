<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'Pengurus',
            ]
        ];

        foreach ($role as $r) {
            Roles::create($r);
        }
    }
}
