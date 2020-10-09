<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function redirectTo()
    {
        if(auth()->user()->roles_id == 'admin')
        {
            return '/admin/home';
        }else
            {return '/user/home';}
        //bingung method buat apa

    }

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->roles_id == 'Admin') {
                return redirect()->route('admin.home');
            }elseif(auth()->user()->roles_id == 'Performer'){
                return redirect()->route('performer.home');
            }
            else{
                return redirect()->route('home');
            }
        }
        else
        {
            return redirect()->route('/login')->with('error','Email-Address And Password Are Wrong.');
        }
    }

    public function logout(Request $request)
{
    $this->guard()->logout();

    $request->session()->invalidate();

    return redirect('/login');
}

}
