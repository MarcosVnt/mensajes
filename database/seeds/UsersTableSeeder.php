<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
        User::create([
        	'name' => 'marcos',
        	'email' => 'marcos@visualnt.net',
        	'password' => bcrypt('123123123')
        ]);

        User::create([
        	'name' => 'pedro',
        	'email' => 'pedro@visualnt.net',
        	'password' => bcrypt('123123123')
        ]);

        }
}
