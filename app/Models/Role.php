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
     * Get Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Permissions not linked with this roles
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('id', function($query){
            $query->select('permission_id');
            $query->from('permission_role');
            $query->whereRaw("role_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
    }

    /**
     * Roles not linked with this user
     */
    public function rolesAvailable($filter = null)
    {
        $roles = Role::whereNotIn('id', function($query){
            $query->select('role_id');
            $query->from('role_user');
            $query->whereRaw("user_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('roles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $roles;
    }

    /**
     * Users not linked with this role
     */
    public function usersAvailable($filter = null)
    {
        $users = User::whereNotIn('id', function($query){
            $query->select('user_id');
            $query->from('role_user');
            $query->whereRaw("role_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $users;
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
