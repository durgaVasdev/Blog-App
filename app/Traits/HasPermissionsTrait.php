<?php

namespace App\Traits;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
trait HasPermissionsTrait{
     // give permission
    public function getAllPermissions($permission){
        return Permission::whereIn('slug', $permission)->get();
    }

    // check has role
    public function  hasPermission($permission){
        return(bool)$this->permission->where('slug',$permission)->count();
    }
//check has role
    public function hasRole(...$roles){
        foreach($roles as $role){
            if($this->roles->contains('slug',$role)){
                return true;
            }
        }
        return false;

    }

    // give permission 

    public function givePermissionTo(...$permissions){
        $permission = $this->getAllPerissions($permissions);
        if($permissions == null){
            return $this;

        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function  hasPermissionTo($permission){
        return  $this-> hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permissions){
        foreach($permissions->roles as $role){
            if($this->roles->contains($role)){

            }
        }
    }




    public function permission(){
        return $this->belongsTomany(permission::class,'users_permissions');
    }

    public function roles(){
        return $this->belongsTomany(Role::class,'users_roles');
    }

}
