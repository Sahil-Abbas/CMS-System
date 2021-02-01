<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Facades\Hash;

class admin_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name'=>'SahilAdmin',
            'email'=>'sahilabbas521uet@gmail.com',
            'password'=>Hash::make('12121212'),
            'role_id'=>1],

            ['name'=>'SahilAuthor',
            'email'=>'sahilabbas@gmail.com',
            'password'=>Hash::make('12121212'),
            'role_id'=>2],

            ['name'=>'SahilUser',
            'email'=>'sahilabbasuser@gmail.com',
            'password'=>Hash::make('12121212'),
            'role_id'=>3]
            
        ]);
    }
}
