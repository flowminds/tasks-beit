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
        \App\User::create([
            'name'  => 'Miroslav Vitanov',
            'email' => 'mvitanov@flowminds.com',
            'password'  => Hash::make('password'),
        ]);
    }
}
