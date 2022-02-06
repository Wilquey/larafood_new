<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get Plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * Permissions not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('id', function($query){
            $query->select('permission_id');
            $query->from('permission_profile');
            $query->whereRaw("profile_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
    }

    
    /**
     * Plans not linked with this profile
     */
    public function plansAvailable($filter = null)
    {
        $plans = Plan::whereNotIn('id', function($query){
            $query->select('plan_id');
            $query->from('plan_profile');
            $query->whereRaw("profile_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('plan.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $plans;
    }

    public function search($filter = null)
    {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $results;
    }
}
