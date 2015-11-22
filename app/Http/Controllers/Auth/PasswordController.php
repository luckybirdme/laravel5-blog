<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use Validator;
use Password;
use Illuminate\Mail\Message;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	protected $redirectTo = '/';
    protected $redirectPath = '/';
    protected $subject = "Luckybird password reset link"; 

    public function getEmail(){
        $page_title = 'Email';
        $data = compact('page_title');
        return view('user.password',$data);
    }

    public function getReset($token = null)
    {

        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        $page_title = 'Reset';
        $data = compact('page_title','token');
        return view('user.reset',$data);
        
    }

    public function postEmail(Request $request)
    {
        $page_title = 'Email';
        $data = compact('page_title');

        $validator = Validator::make($request->all(), ['email' => 'required|email']);

        if ($validator->fails()) {
 
            return view('user.password',$data)
                ->withErrors($validator->errors());
   
        }

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return view('user.password',$data)->with('status', translang($response));

            case Password::INVALID_USER:
                return view('user.password',$data)->withErrors(['email' => translang($response)]);
        }
    }

    public function postReset(Request $request)
    {
        $page_title = 'Reset';
        $data = compact('page_title');

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
 
            return view('user.reset',$data)->with('token',$request->input('token'))
                ->withErrors($validator->errors());
   
        }

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
            return redirect($this->redirectPath())->with('status', trans($response));

            default:
                return view('user.reset',$data)->with('token', $request->input('token'))
                ->withErrors(['email' => translang($response)]);
        }
    }
}
