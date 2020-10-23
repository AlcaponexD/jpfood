<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'price'
    ];

    public function search($filter)
    {
        $result = $this->where('name','LIKE',"%{$filter}%")
                       ->orWhere('description','LIKE',"%{$filter}%")
                       ->paginate(15);
        return $result;
    }

    public function details()
    {
        return $this->hasMany(DetailsPlan::class);
    }
}
