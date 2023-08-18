<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class AuthController extends Controller

{
    
    public function index(){
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
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('users.index');
            }else{
                return redirect()->route('home');
            }

        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }

    public function register_view(){
        return view('auth.register');
    }

    public function register(Request $request){
        //dd($request->all());
        $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users|email',
        'password'=>'required|confirmed'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if(Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        return redirect('register')->withError('Error');

    }

    public function home(){
        return view('home');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('');

    }
}
