<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
	
	protected $redirectPath = '/';
    protected $loginPath = '/login';
    protected $username = 'email';

    public function getLogin(){
        $page_title = 'Login';
        $data = compact('page_title');
        return view('user.login',$data);
    }

    public function getRegister(){
        $page_title = 'Register';
        $data = compact('page_title');
        return view('user.register',$data);
    }


    public function postLogin(Request $request)
    {
        $page_title = 'Login';
        $data = compact('page_title');

        $all = $request->all();
        $validator = Validator::make($all, [
            $this->loginUsername() => 'required|exists:users', 
            'password' => 'required',
        ]);

        if ($validator->fails()) {
 
            return view('user.login',$data)
                ->withErrors($validator->errors());
   
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return view('user.login',$data)
            ->withErrors([
                $this->loginUsername() => translang('Login failed'),
            ]);
    }


    public function postRegister(Request $request)
    {
        $page_title = 'Register';
        $data = compact('page_title');

        $all = $request->all();
        $validator = Validator::make($all, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
 
            return view('user.register',$data)
                ->withErrors($validator->errors());
   
        }

        $user = User::create([
            'name' => $all['name'],
            'email' => $all['email'],
            'password' => bcrypt($all['password']),
        ]);

        Auth::login($user);

        return redirect($this->redirectPath());
    }


}
