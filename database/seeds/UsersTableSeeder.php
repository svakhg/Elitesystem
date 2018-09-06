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
        DB::table('users')->insert([
        	'first_name' => 'admin',
        	'permissions' => 'superuser',
        	'email' => 'admin@elitesystem.com',
        	'password' => bcrypt('superuser')
        ]);

        DB::table('users')->insert([
            'first_name' => 'recepsion',
            'permissions' => 'recepsion',
            'email' => 'recepsion@elitesystem.com',
            'password' => bcrypt('recepsion')
        ]);

        DB::table('users')->insert([
            'first_name' => 'bar',
            'permissions' => 'bar',
            'email' => 'bar@elitesystem.com',
            'passowrd' => bcrypt('baruser')
        ]);
    }
}
