<?php
/**
 * Created by PhpStorm.
 * User: AlcaponexD
 * Date: 29/10/2020
 * Time: 01:14
 */

namespace App\Services;


use Illuminate\Support\Str;

class TenantService
{
    private $plan, $data = [];
    public function make(array $data,$plan)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);

        return $user;
    }
    public function storeTenant()
    {
        $tenant = $this->plan->tenants()->create([
            'cnpj_cpf' => $this->data['cnpj_cpf'],
            'name' => $this->data['empresa'],
            'email' => $this->data['email'],
            'url' => Str::kebab($this->data['empresa']),
            'subscription' => now(),
            'expires_at' => now()->addDays(7)
        ]);

        return $tenant;
    }

    public function storeUser($tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        return $user;
    }
}