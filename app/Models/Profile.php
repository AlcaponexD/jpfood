<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    /*
     * Search Like
     */
    public function search($filter)
    {
        $result = $this->where('description','LIKE',"%{$filter}%")
                ->orWhere('name','LIKE',"%{$filter}%")
                ->paginate(10);

        return $result;
    }

    /*
     * Get Permissions
     */

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /*
     * Show permissions not vinculed with profile
     */

    public function permissionsAvaliable()
    {
        $permissions = Permission::whereNotIn('id',function ($query){
           $query->select('permission_profile.permission_id');
           $query->from('permission_profile');
           $query->whereRaw("permission_profile.profile_id={$this->id}");
        })->paginate();

        return $permissions;
    }
}
