<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->insert([
            //User OR Customer
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
                'show_password' =>'12345678',
                'phone' =>'01741521414',
                'address' =>'Dhaka',
                'designation' =>'Student',
                'country' =>'Dhaka',
                'profile_photo' =>'user.png',
                'role' => 'user',
                'active_status' => '0',

            ],

            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'show_password' =>'12345678',
                'phone' =>'01741521414',
                'address' =>'Dhaka',
                'designation' =>'Student',
                'country' =>'Dhaka',
                'profile_photo' =>'user.png',
                'role' => 'admin',
                'active_status' => '0',

            ],



        ]);

    }
}
