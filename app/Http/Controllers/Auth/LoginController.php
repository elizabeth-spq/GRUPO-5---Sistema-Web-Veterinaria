<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isDeactivated) {
                Auth::logout();
                return redirect('/login')->withErrors(['isDeactivated' => 'Esta cuenta ha sido desactivada.']);
            }

            // Verificar si el usuario debe cambiar la contraseña
            if ($user->password_changed) {
                // Establecer una bandera para indicar que se debe cambiar la contraseña
                session(['password_changed' => true]);
            }

            return redirect()->intended($this->redirectPath());
        }

        return redirect('/login')->withErrors([
            'invalidCredentials' => 'Las credenciales proporcionadas son inválidas.',
        ]);
    }

    /*protected function authenticated(Request $request, $user)
    {
        if (!$user->password_changed) {
            return redirect()->route('cambiar-contrasena');
        }

        return redirect()->intended($this->redirectPath());
    }*/
}
