<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Franklin Shera',
           'email' => 'fshera96@gmail.com',
            'password' => Hash::make('admin'),
            'access' => '0'
        ]);
    }
}
