<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = \App\Models\User::create([
            'first_name' => 'Mohamed',
            'last_name' => 'Elorabi',
            'email' => 'elorabi199@gmail.com',
            'password' => bcrypt('orabi123'),
        ]);

        $user->attachRole('super_admin');
        
    }
}
