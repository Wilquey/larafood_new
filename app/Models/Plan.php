<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Profile;
use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'url',
        'price',
        'description',
    ];

    /**
     * Get all of the details for the Plan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    /**
     * Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Get Tenants
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    /**
     * Profiles not linked with this plan
     */
    public function profilesAvailable($filter = null)
    {
        $profiles = Profile::whereNotIn('id', function ($query) {
            $query->select('profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $profiles;
    }

    /**
    * Filtro pesquisar
    **/
    public function search($filter = null)
    {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $results;
    }

}

// settings.json - anterior ;;;... agora está como         "editor.autoClosingBrackets": "always"
// "editor.defaultFormatter": "shufo.vscode-blade-formatter"

