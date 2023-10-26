<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


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
 $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
     
        $token = Str::random(64);
        $tokenExpiration = now()->addHours(24);

        UserVerify::create([
            'user_id' => $user->id, 
            'token' => $token,
            'token_expires_at' => $tokenExpiration,
            
          ]);

    /*  Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });*/
        // Send the verification email with the token
    Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
        $message->to($request->email);
        $message->subject('Email Verification Mail');
    });

       
      return redirect("login")->withSuccess('Great! You have Successfully loggedin');
  
        //event(new Registered($user));

       // $user->sendEmailVerificationNotification();
        /* if(Auth::attempt($request->only( 'email','password'))){
            return redirect('home');
        } */
       // return redirect('auth.verify-email')->with('success', ' email verify link sended.');
        //return redirect('login')->with('success', ' Email verify link sendedand Registration successful! You can now log in .');
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


   /* public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('login')->with('message', $message);
    }
*/
/*public function verifyAccount($token)
{
    $verifyUser = UserVerify::where('token', $token)->first();

    if (!$verifyUser) {
        return redirect()->route('login')->with('error', 'Invalid token or email verification link has expired.');
    }

    $user = $verifyUser->user;

    if ($user->is_email_verified) {
        return redirect()->route('login')->with('info', 'Your email is already verified. You can now log in.');
    }

    $expiresAt = $verifyUser->created_at->addMinutes(0.5);

    if (Carbon::now()->gt($expiresAt)) {
        // The verification link has expired
        return redirect()->route('login')->with('error', 'Email verification link has expired.');
    }

    // Mark the user's email as verified
    $user->is_email_verified = true;
    $user->save();

    // Delete the verification token
    $verifyUser->delete();

    return redirect()->route('login')->with('success', 'Your email has been verified. You can now log in.');

}*/
public function verifyAccount($token)
{
    $verifyUser = UserVerify::where('token', $token)->first();

    if (is_null($verifyUser)) {
        return redirect()->route('login')->with('message', 'Sorry, your email verification link is invalid.');
    }

    $user = $verifyUser->user;

    if ($user->is_email_verified) {
        return redirect()->route('login')->with('message', 'Your email is already verified. You can now login.');
    }

    // Check if the token is still valid
    if (now()->lt($verifyUser->token_expires_at)) {
        $user->is_email_verified = true;
        $user->save();
        return redirect()->route('login')->with('message', 'Your email is verified. You can now login.');
    } else {
        return redirect()->route('login')->with('message', 'Your email verification link has expired. Please request a new one.');
    }
}

}
