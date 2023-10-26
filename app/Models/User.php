<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
 //use Illuminate\Contracts\Auth\CanResetPassword ;
 use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable ,CanResetPassword,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'last_seen',
        'is_email_verified',
    
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    

    public function products(){
        return $this->belongsToMany(Product::class);
    }
   
    



    //public function userRoles(){
        //return $this->hasMany(UserRole::class);
   // }

   public function hasPermissionsInRoles()
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($this->hasPermissionTo($permission)) {
                    return true;
                }
            }
        }
        return false;
    }

//public  function setNameAttribute($value){

    //$this->attributes['name'] = ucwords($value);
//}


/*public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }*/


    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim($value));
    }

    public function getEmailAttribute($value)
    {
        return ucfirst($value); // Capitalize the first letter of the email address
    }

    
   /*public function setNameAttribute($value)
    {
        $this->attributes['name'] = substr($value, 0, 3);
    }

    public function getNameAttribute($value)
    {
        return substr($value, 0, 3);
    }*/

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper(substr($value, 0, 3));
    }

    public function getNameAttribute($value)
    {
        return strtoupper(substr($value, 0, 3));
    }



    
   /* public  function getFullNameAttribute()
    {
        return $this->name  .' '. $this->email;
    }
*/
    
  /*  public function getFullNameAttribute()
{
    return "{$this->name} {$this->email}";
}

*/

public function getImageAttribute($value)
{

    if ($value) {
        // Ensure the 'images/' prefix is added if it's missing
        if (strpos($value, 'images/') === false) {
            $value = 'images/' . $value;
        }
        return asset($value);
    }

}

public function setFullNameEmailAttribute($value)
    {
        // Assuming $value is a string containing both name and email
        list($name, $email) = explode(' ', $value, 2);
        $this->attributes['name'] = $name;
        $this->attributes['email'] = $email;
    }


/*public function getFullNameEmailAttribute()
    {
     return $this->name . ' ' . $this->email;
    }
    */


    // Accessor to get the combined 'name' and 'email' attribute
    public function getFullNameEmailAttribute()
    {
        return $this->attributes['name'] . ' ' . $this->attributes['email'];
    }

    
    /*public function getRoleNamesAttribute()
    {
        return $this->roles->pluck('name')->toArray();
    }*/

    // Accessor for the 'last_seen' attribute formatted as a human-readable string
  /* public function getLastSeenHumanAttribute()
    {
        // Assuming 'last_seen' is a timestamp or a valid date string
        return Carbon::parse($this->attributes['last_seen'])->diffForHumans();
    }*/

    public function getRoleNamesAttribute()
{
    return $this->roles->pluck('name')->implode(', ');
}

/*public function getLastSeenAttribute($value)
{
    return $value ? \Carbon\Carbon::parse($value)->diffForHumans() : 'Never';
}*/

/*public function getLastSeenAttribute($value)
{
    $onlineStatus = Cache::has('user-is-online-' . $this->id) ? '<span class="text-success">Online</span>' : '<span class="text-secondary">Offline</span>';
    
    return $value ? \Carbon\Carbon::parse($value)->diffForHumans() . ' ' . $onlineStatus : 'Never ' . $onlineStatus;
}*/


/*public function getLastSeenAttribute($value)
{
    $onlineStatus = Cache::has('user-is-online-' . $this->id)
        ? '<span class="text-success">Online</span>'
        : '<span class="text-secondary">Offline</span>';

    return $value
        ? \Carbon\Carbon::parse($value)->diffForHumans() . ' ' . $onlineStatus
        : 'Never ' . $onlineStatus;
}*/

public function getStatusAndLastSeenAttribute()
{
    $onlineStatus = Cache::has('user-is-online-' . $this->id) ? '<span class="text-success">Online</span>' : '<span class="text-secondary">Offline</span>';
    $lastSeen = \Carbon\Carbon::parse($this->last_seen)->diffForHumans();
    
    return $onlineStatus . ' ' . $lastSeen;
}

public function userVerify()
{
    return $this->hasOne(UserVerify::class);
}


}