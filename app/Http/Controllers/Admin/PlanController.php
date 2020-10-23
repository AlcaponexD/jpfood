<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanValidate;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->paginate(15);
        return view('admin.pages.plans.index',[
            'plans' => $plans
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StorePlanValidate $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('plans.index')->with([
            'message' => 'Plano cadastrado com sucesso',
            'type' => 'success'
        ]);
    }
    public function show($url)
    {
        $plan = $this->repository->where('url',$url)->first();
        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show',[
            'plan' => $plan
        ]);
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url',$url)->first();
        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit',[
            'plan' => $plan
        ]);
    }

    public function update(StorePlanValidate $request,$url)
    {
        $data = $request->except('_token');
        $plan = $this->repository->where('url',$url)->first();
        if(!$plan)
            return redirect()->back();

        $plan->update($data);

        return redirect()->route('plans.index')->with([
            'message' => 'Plano atualizado com sucesso',
            'type' => 'success'
        ]);
    }

    public function destroy($url)
    {
        $plan = $this->repository->where('url',$url)->first();
        if(!$plan)
            return redirect()->back()->with([
                'message' => 'Plano não encontrado',
                'type' => 'danger'
            ]);

        $plan->delete();

        return redirect()->route('plans.index')->with([
            'message' => 'Plano deletado com sucesso',
            'type' => 'success'
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        $plans = $this->repository->search($data['filter']);

        return view('admin.pages.plans.index',[
            'plans' => $plans,
            'filters' => $data
        ]);
    }
}
