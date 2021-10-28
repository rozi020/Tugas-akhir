<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
             [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin_sapiku'),
                'gender' => 'male',
                'address' => 'localhost',
                'phone_number' => '089612625266',
                'id_role' => 1,
            ],
            [
                'name' => 'Pengurus 1',
                'username' => 'pengurus',
                'password' => bcrypt('pengurus_sapiku'),
                'gender' => 'female',
                'address' => 'localhost',
                'phone_number' => '089612625255',
                'id_role' => 2,
            ]
        ];

        foreach ($user as $u) {
            User::create($u);
        }
    }
}
