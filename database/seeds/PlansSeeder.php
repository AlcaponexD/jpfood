<?php

use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plan::create(
            [
                'name' => 'Plano A',
                'description' => 'Descrição do plano A',
                'url' => 'plano-a',
                'price' => 499.99
            ]
        );
    }
}
