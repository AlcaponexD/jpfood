<?php

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Tenant
};

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'Jeison Pedroso',
            'email' => 'jeison.contas@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
