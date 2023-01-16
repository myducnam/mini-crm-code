<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //Number of login attempts (times)
    protected $maxAttempts = 2;

    // login lock time (minutes)
    protected $decayMinutes = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $activeGuards = 0;
        foreach (config('auth.guards') as $guard => $guardConfig) {
            if ('session' === $guardConfig['driver']) {
                $guardName = Auth::guard($guard)->getName();
                if ($request->session()->has($guardName)
                    && $request->session()->get($guardName) === Auth::guard($guard)->user()->getAuthIdentifier()) {
                    ++$activeGuards;
                }
            }
        }

        if (0 === $activeGuards) {
            $request->session()->invalidate();
        }

        return redirect()->route('admin.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return route('admin.home');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
