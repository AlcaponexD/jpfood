<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'cnpj_cpf' => '39957539817',
            'name' => 'ZeroP Foods',
            'url' => 'zrp',
            'email' => 'contato@zrp.com.br'
        ]);
    }
}
