<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $profile,$plan;

    public function __construct(Profile $profile,Plan $plan)
    {
        $this->profile = $profile;
        $this->plan = $plan;
    }

    public function plans($idPlan)
    {

        $plan = $this->plan->with('profiles')->find($idPlan);
        if (!$plan)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum plano encontrado',
                'type' => 'danger'
            ]);
        }
        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.index',compact('plan','profiles'));

    }

    public function plansAvaliable($idPlan)
    {

        $plan = $this->plan->with('profiles')->find($idPlan);
        if (!$plan)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum plano encontrado',
                'type' => 'danger'
            ]);
        }
        $profiles = $plan->profilesAvaliable();

        return view('admin.pages.plans.profiles.avaliable',compact('profiles','plan'));
    }

    public function plansAttach(Request $request,$idPlan)
    {

        $plan = $this->plan->with('profiles')->find($idPlan);
        if (!$plan)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum perfil encontrado',
                'type' => 'danger'
            ]);
        }

        if (!$request->profiles || count($request->profiles) == 0)
        {
            return redirect()->back()->with([
                'message' => 'Escolha pelo menos um perfil para vincular',
                'type' => 'danger'
            ]);
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plan.profile',$plan->id)->with([
            'message' => 'Perfis vinculadas com sucesso',
            'type' => 'success'
        ]);
    }

    public function detachProfilePlan($idPlan,$idProfile)
    {

        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);
        if (!$plan || !$profile)
        {
            return redirect()->back()->with([
                'message' => 'Nenhum perfil encontrado',
                'type' => 'danger'
            ]);
        }



        $plan->profiles()->detach($profile);

        return redirect()->route('plan.profile',$plan->id)->with([
            'message' => 'Perfis desvinculada com sucesso',
            'type' => 'success'
        ]);
    }
}
