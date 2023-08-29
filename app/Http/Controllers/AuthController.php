<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class AuthController extends Controller

{

    public function index()
    {
        return view('auth.login');
    }
    /*public function login(Request $request){

    $credentials = $request->validate([
        'email'=> 'required',
        'password'=>'required'
    ]);
    if(Auth::attempt($request->only('email','password'))){
        return redirect('home');
    }
    return redirect('login')->withError('Error');

}
*/
    /*protected $redirectTo = '/home';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function construct()
    {
        $this->middleware('guest')->except('logout');
    }
   */
    public function login(Request $request)
    {
        // dd(auth()->user()->roles);
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            //'roles'=> 'required|array',
        ]);
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {


            $roles = auth()->user()->roles->pluck('name');
            if ($roles->contains('Admin')) {
                //return redirect()->route('users.index');
                return redirect()->route('adminhome');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|string|min:6|confirmed'

        ]);
        // dd($request->all());
        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        /* if(Auth::attempt($request->only( 'email','password'))){
            return redirect('home');
        } */
        return redirect('login')->with('success', 'Registration successful! You can now log in.');
    }

    public function home()
    {
        return view('home');
    }

    public function adminhome()
    {
        return view('adminhome');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
