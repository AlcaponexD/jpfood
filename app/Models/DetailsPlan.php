<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsPlan extends Model
{
    protected $table = 'details_plans';

    protected $fillable = [
        'name',
        'plan_id'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
