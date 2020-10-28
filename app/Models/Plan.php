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

    /*
 * Get profiles
 */

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /*
     * Show profiles not vinculed with plan
     */

    public function profilesAvaliable()
    {
        $profiles = Profile::whereNotIn('id',function ($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })->paginate();

        return $profiles;
    }
}
