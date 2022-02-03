<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    private $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;        
    }
    
    /******************************************************************************************************
     * Plans
     ******************************************************************************************************/

    public function profiles($idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if(!$plan) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));

    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }

    public function attachProfilesPlan(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um plano');

        }

        //dd($request->profiles);

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }

    public function detachPlanProfile($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile) {
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);
    }

    /******************************************************************************************************
     * Plans
     ******************************************************************************************************/


    public function plans($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact('plans', 'profile'));
    }

    public function plansAvailable(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', compact('plans', 'profile', 'filters'));
    }


    public function attachPlansProfile(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        if (!$request->plans || count($request->plans) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um perfil');

        }

        //dd($request->profiles);

        $profile->plans()->attach($request->plans);

        return redirect()->route('profiles.plans', $profile->id);
    }


    public function detachProfilePlan($idProfile, $idPlan)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile) {
            return redirect()->back();
        }

        $profile->plans()->detach($plan);

        return redirect()->route('profiles.plans', $profile->id);
    }


}
