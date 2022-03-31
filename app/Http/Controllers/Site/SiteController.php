<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $plans = Plan::with('details')->orderBy('price', 'ASC')->get();
        
        return view('site.pages.home.index', compact('plans'));
    }

    public function plan($url)
    {
        $plan = Plan::where('url', $url)->first();
        
        if(!$plan){
            return redirect()->back();           
        }

        session()->put('plan', $plan);

        return redirect()->route('register');
    }

}
