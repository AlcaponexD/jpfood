<?php

namespace App\Observers;

use App\Models\Tenant;
use Psy\Util\Str;
use Ramsey\Uuid\Uuid;

class TenantObserver
{
    public function creating(Tenant $tenant)
    {
        $tenant->uuid = \Illuminate\Support\Str::uuid();
        $tenant->url = \Illuminate\Support\Str::kebab($tenant->name);
    }
}

