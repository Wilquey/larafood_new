<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Plan;

class TenantService 
{
    private $plan, $data = [];

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
        
        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);
        return $user;
    }

    public function storeTenant()
    {
        $data = $this->data;
        
        return $this->plan->tenants()->create([
            'cnpj' => $data['cnpj'],
            'name' => $data['empresa'],
            'url' => Str::kebab($data['empresa']),
            'email' => $data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);        
    }
    
    public function storeUser()
    {
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        return $user;        
    }

}