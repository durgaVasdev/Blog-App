<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
trait HaspermssionsTrait{

    public function getAllPerissions($permission){
        return Permission::whereIn('slug', $permission)->get();
    }

    public function  hasPermission($permission){
        return(bool)$this->permission->where('slug',$permission->slug)->count();
    }

    public function hasRole(...$roles){
        foreach($roles as $role){
            if($this->roles->contains('slug',$slug)){
                return true;
            }
        }
        return false;

    }

    public function permission(){
        return $this->belongsTomany(permission::class,'users_permissions');
    }

    public function roles(){
        return $this->belongsTomany(Role::class,'users_roles');
    }

}
