<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Product;

use App\Models\Permission;
use Closure;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function __construct1()
    {
        $this->middleware('roles', ['except' => [
            'create'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request){
       // $users = User::latest()->get();
       //return view('users.index',['users'=>$users]);
        

        //$users = User::with('role')->paginate(10); // Load the related role for each user
        //$roles = Role::all(); // Fetch all roles

        //return view('users.index', compact('users', 'roles'));
       // $users = User::with('role')->get(); // Load the related role for each user

        //return view('users.index', compact('users','roles'));

    



    // Get the search parameters from the request
    $name = $request->input('name');
    $email = $request->input('email');
    $role = $request->input('role');

    $lastSeen = $request->input('last_seen');

    // Get all roles for the dropdown
    $roles = Role::all();

    // Query to fetch users with filtering
    $users = User::query();

    if (!empty($name)) {
        $users->where('name', 'LIKE', '%' . $name . '%');
    }

    if (!empty($email)) {
        $users->where('email', 'LIKE', '%' . $email . '%');
    }

    if ($role) {
          $users->whereHas('roles', function ($q) use ($role) {
              $q->where('roles.id', $role);
       });
     }


     



    $users = $users->paginate(10); // You can adjust the pagination settings
    // Load the online users into the cache
   // Cache::put('online-users', $users->pluck('id')->toArray(), now()->addMinutes(5));
   // Fetch distinct last_seen values from the users table
   //$lastSeenOptions = User::distinct()->pluck('last_seen')->filter()->toArray();


    if ($request->ajax()) {
        return response()->json($users);
    }

    return view('users.index', compact('users', 'roles'));
}
       




    
/*public function search(Request $request){

    $name = $request->input('name');
    $email = $request->input('email');
    //$role = $request->input('role');

    dd('dff');

    $query = User::query();
   
    if ($name) {
        $query->where('name', 'LIKE', "%$name%");
        
    }
    if ($email) {
        $query->where('email', 'LIKE', "%$email%");
    }

    //if ($role) {
      //  $query->whereHas('roles', function ($q) use ($role) {
           // $q->where('roles.id', $role);
   //  });
   // }

    $users = $query->get();

        // Fetch dynamic values for the role dropdown from the database
       // $roles = Role::all();

       

    //$users = $query->with('role')->get();
        return view('users.search-results', compact('users'));
}*/






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    //create porduct 


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('is_admin');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'roles' => 'required|array',
            // 'products'=>'required|string'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        /*DB::beginTransaction();
        $user = User::create($input);
        // dd($request->input('roles'));
        $roles = [];
        foreach($request->roles as $role)
        {
            $roles[] = [
                'role_id' => $role,
            ];
        }

        // dd($roles);

        $user->userRoles()->createMany($roles);
        DB::commit();
        */
        $user = User::create($input);
        $user->roles()->attach($request->input('roles'));
        $user->products()->attach($request->input('products'));


        return redirect()->route('users.index')->with('success', 'User create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            //'is_admin'=>'required|boolean',

            // 'password' => 'required|string|min:6',
            'roles' => 'required|array'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }
        $user->update($input);
        $user->roles()->sync($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User update successfully');
    }

    /** for user status */

    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            else
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User delete successfully');
    }
}
