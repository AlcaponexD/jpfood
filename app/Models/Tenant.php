<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'plan_id',
        'cnpj_cpf',
        'name',
        'email',
        'url',
        'logo',
        'active',
        'subscription',
        'expires_at',
        'subscription_id',
        'subscription_active',
        'subscription_suspended'
    ];

    /*
     * return users related
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /*
     * return plans related
     */
    public function plans()
    {
        return $this->belongsTo(Plan::class);
    }
}
