<?php

namespace App\Http\Controllers;
  
  use Illuminate\Support\Facades\Auth;
  use App\Models\Role;
  use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
         //dd($user);
        
       // assign role 
       //dd($user->roles);
       //$role = Role::where('slug' , 'editor')->first();
       //$user->roles()->attach($role);
      // dd($user->roles);
    //dd($user->hasRole('author'));
      //check permission
      //$permission = Permission::first();
      //$user->permissions()->attach($permission);
      //dd ($user->permissions);
        
        //return view('home');

    }
}
