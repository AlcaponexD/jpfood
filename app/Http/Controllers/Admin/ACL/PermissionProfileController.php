<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $permission,$profile;

    public function __construct(Permission $permission,Profile $profile)
    {
        $this->permission = $permission;
        $this->profile = $profile;
    }

    public function permissions($idProfile)
    {

        $profile = $this->profile->with('permissions')->find($idProfile);
        if (!$profile)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum perfil encontrado',
                'type' => 'danger'
            ]);
        }
        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.index',compact('permissions','profile'));

    }

    public function permissionsAvaliable($idProfile)
    {

        $profile = $this->profile->with('permissions')->find($idProfile);
        if (!$profile)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum perfil encontrado',
                'type' => 'danger'
            ]);
        }
        $permissions = $profile->permissionsAvaliable();

        return view('admin.pages.profiles.permissions.avaliable',compact('permissions','profile'));
    }

    public function permissionsAttach(Request $request,$idProfile)
    {

        $profile = $this->profile->with('permissions')->find($idProfile);
        if (!$profile)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum perfil encontrado',
                'type' => 'danger'
            ]);
        }

        if (!$request->permissions || count($request->permissions) == 0)
        {
            return redirect()->back()->with([
                'message' => 'Escolha pelo menos uma permissão para vincular',
                'type' => 'danger'
            ]);
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('permission.profile',$profile->id)->with([
            'message' => 'Permissões vinculadas com sucesso',
            'type' => 'success'
        ]);
    }

    public function detachPermissionProfile($idProfile,$idPermission)
    {

        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        if (!$profile || !$permission)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum perfil encontrado',
                'type' => 'danger'
            ]);
        }



        $profile->permissions()->detach($permission);

        return redirect()->route('permission.profile',$profile->id)->with([
            'message' => 'Permissão desvinculada com sucesso',
            'type' => 'success'
        ]);
    }
}
