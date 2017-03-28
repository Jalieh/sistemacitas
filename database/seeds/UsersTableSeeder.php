<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'name' => 'King',
            'lastname'=>'Admin',
            'birthdate'=>'2000-01-01',
            'age'=>'17',
            'identification'=>'09876543',
            'gender'=>'other',
            'phone'=>'55555555555',
            'mobile'=>'555555555555',
            'address'=>'Nowhere',
            'email' => 'king@admin.com',
            'password' => bcrypt('123456'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}