<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }


    public function login(Request $request)
    {
        //    echo json_encode($request->all());
        //    die();
        // $input = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('home');
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));

        // if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        // {
        //     if (auth()->user()->role_id == 1) {
        //         echo "Log in";
        //         return redirect('admin/home');
        //     }else{
        //         echo "error";
        //         // return redirect()->route('home');
        //     }
        // }else{
        //     return redirect()->route('login')
        //         ->with('error','Email-Address And Password Are Wrong.');
        // }


    }



    //Google login
    public function redirectToGoogle()
    {

     return Socialite::driver('google')->stateless()->redirect();
    }
 //Google Callback
    public function handleGoogleCallback(){

        $user=Socialite::driver('google')->stateless()->user();
        $authuser=User::where('email',$user->email)->first();
        if($authuser){
            Auth::login($authuser);
            return redirect()->route('home');

        }
        else{
            $newuser= new User;
            $newuser->name=$user->email;
            $newuser->email=$user->email;
            $newuser->social_id=$user->id;
            $newuser->device_id='nil';
            $newuser->contact='nil';
            $newuser->status=1;
            $newuser->password=uniqid();
            $newuser->save();
            Auth::login($newuser);
            return redirect()->route('home');

        }

    }

     //Facebook login
     public function redirectToFacebook()
     {
      return Socialite::driver('facebook')->redirect();
     }
  //Google Callback
     public function handleFacebookCallback(){
         $user=Socialite::driver('facebook')->user();
     }

      //Google Instagram
    public function redirectToInstagram()
    {
     return Socialite::driver('instagram')->redirect();
    }
 //Google Callback
    public function handleInstagramCallback(){
        $user=Socialite::driver('instagram')->user();
    }
}
