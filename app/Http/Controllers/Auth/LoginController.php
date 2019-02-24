<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

/*     public function username()
    {
        return \request('guard') == 'pt' ? 'email' : 'username';
    } */

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'success' => true,
            'redirect' => url($this->redirectTo)
        ]);
    }

    public function attemptLogin(Request $request)
    {
        $data = explode(',',$request->get('data'));
        if ($request->has('data')){
            $email = $data[0];
            $password = $data[1];
            $creadential = [
                'email' => $email,
                'password' => $password
            ];
        } else {
            $creadential = [
                'email' => $request->email,
                'password' => $request->password
            ];
        }
        
        /* checking email */
        $checking = User::where('email',$email)->first();
        if ($checking){
            if(Auth::attempt($creadential)) {
                return response()->json([
                    'message' => true,
                    'redirect' => $this->redirectTo
                ],200);
            } else {
                return response()->json([
                    'message' => 'Your email or password wrong'
                ],404);
            }
        } else {
            return response()->json([
                'message' => 'your account not found'
            ],404);
        }
    }

    public function qrCodeLogin()
    {
        return view('auth.qr-login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
