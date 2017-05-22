<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Core\Services\Contracts\Request;
use Core\Services\Contracts\Response;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the application's login form.
     *
     * @return Response
     */
    public function form()
    {
        return view('auth.login', ['errors' => collect([])]); // todo errors!
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return Response
     */
    public function login()
    {
//        $this->validateLogin($request);
//
//        // If the class is using the ThrottlesLogins trait, we can automatically throttle
//        // the login attempts for this application. We'll key this by the username and
//        // the IP address of the client making these requests into this application.
//        if ($this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//
//            return $this->sendLockoutResponse($request);
//        }
//
//        $credentials = $this->credentials($request);
//
//        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
//            return $this->sendLoginResponse($request);
//        }
//
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
//        $this->incrementLoginAttempts($request);
//
//        return $this->sendFailedLoginResponse($request);

        return null;
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Response
     */
    public function logout()
    {
//        $this->guard()->logout();
//
//        $request->session()->flush();
//
//        $request->session()->regenerate();
//
//        return redirect('/');

        return null;
    }
}
