<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetailsPlanValidate;
use App\Models\DetailsPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository,$plan;

    public function __construct(DetailsPlan $detailsPlan,Plan $plan)
    {
        $this->repository = $detailsPlan;
        $this->plan = $plan;
    }

    public function index($url)
    {
        if (!$plan = $this->plan->where('url',$url)->first())
        {
            return redirect()->back();
        }

        $details = $plan->details()->paginate(10);

        return view('admin.pages.plans.details.index',[
            'plan' => $plan,
            'details' => $details
        ]);
    }
    public function create($url)
    {
        if (!$plan = $this->plan->where('url',$url)->first())
        {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create',[
            'plan' => $plan
        ]);
    }

    public function store(StoreDetailsPlanValidate $request,$url)
    {
        if (!$plan = $this->plan->where('url',$url)->first())
        {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('plans.details.index',['url' => $plan->url])->with([
            'message' => "Detalhes do plano {$plan->name} cadastrado com sucesso",
            'type' => 'success'
        ]);
    }
    public function destroy($id)
    {
        if (!$detail = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()->back()->with([
            'message' => "Detalhe de plano deletado com sucesso",
            'type' => 'success'
        ]);
    }

}
