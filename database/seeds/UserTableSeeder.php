<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jeison Pedroso',
            'email' => 'jeison.contas@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
