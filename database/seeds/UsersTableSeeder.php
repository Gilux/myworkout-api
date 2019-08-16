<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\Hash;
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $u = new \App\User();
        $u->name = "Gilux";
        $u->email = "gilux762@gmail.com";
        $u->password = Hash::make("01234");
        $u->save();
    }
}
