<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileValidate;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    public function index()
    {
        $profiles = $this->repository->paginate(10);

        return view('admin.pages.profiles.index',compact('profiles'));
    }
    public function create()
    {
        return view('admin.pages.profiles.create');
    }
    public function search(Request $request)
    {
        $profiles = $this->repository->search($request->filter);

        return view('admin.pages.profiles.index',compact('profiles'));
    }
    public function store(StoreProfileValidate $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('profiles.index')->with([
            'message' => 'Perfil cadastrado com sucesso!',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $profile = $this->repository->find($id);
        if (!$profile)
            return redirect()->back()->with([
                'message' => 'Perfil não encontrado!',
                'type' => 'danger'
            ]);

        $profile->delete();
        return redirect()->route('profiles.index')->with([
            'message' => 'Perfil deletado com sucesso!',
            'type' => 'success'
        ]);
    }
}
