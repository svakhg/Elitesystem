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
        	'email' => 'admin@admin.com',
        	'password' => bcrypt('superuser')
        ]);
    }
}
