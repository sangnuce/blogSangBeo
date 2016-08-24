<?php

use Illuminate\Database\Seeder;
use Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'username' => 'Admin',
                'password' => Hash::make('123456'),
                'name' => 'Sáng Béo',
                'email' => 'sanga2k50@gmail.com',
                'level' => 2,
                'status' => 1
            ]
        );
    }
}
