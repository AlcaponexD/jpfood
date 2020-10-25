<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionValidate;
use App\Http\Requests\StoreProfileValidate;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    public function index()
    {
        $permissions = $this->repository->paginate(10);

        return view('admin.pages.permissions.index',compact('permissions'));
    }
    public function create()
    {
        return view('admin.pages.permissions.create');
    }
    public function search(Request $request)
    {
        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index',compact('permissions'));
    }
    public function store(StorePermissionValidate $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permissions.index')->with([
            'message' => 'Permissão cadastrada com sucesso!',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $permission = $this->repository->find($id);
        if (!$permission)
            return redirect()->back()->with([
                'message' => 'Permissão não encontrada!',
                'type' => 'danger'
            ]);

        $permission->delete();
        return redirect()->route('permissions.index')->with([
            'message' => 'Permissão deletada com sucesso!',
            'type' => 'success'
        ]);
    }
}
