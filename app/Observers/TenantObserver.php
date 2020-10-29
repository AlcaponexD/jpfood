<?php

namespace App\Observers;

use App\Models\Tenant;

class TenantObserver
{
    public function creating(Tenant $tenant)
    {
        $tenant->uuid = \Illuminate\Support\Str::uuid();
        $tenant->url = \Illuminate\Support\Str::kebab($tenant->name);
    }
}

