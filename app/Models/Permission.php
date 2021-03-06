<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function search($filter)
    {
        $result = $this->where('description','LIKE',"%{$filter}%")
                ->orWhere('name','LIKE',"%{$filter}%")
                ->paginate(10);

        return $result;
    }

    /*
    * Get profiles
    */

    public function permissions()
    {
        return $this->belongsToMany(Profile::class);
    }
}
