<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","La nueva contraseña no puede ser la misma que su contraseña actual. Elija una contraseña diferente.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->password_changed = \Carbon\Carbon::now();
        $user->save();

        //return redirect()->back()->with("success","¡Contraseña cambiada con éxito!");
        return redirect()->route('home')->with("success", "¡Contraseña cambiada con éxito!");
        //return redirect()->route('home')->withTime(2000)->with("success", "¡Contraseña cambiada con éxito!");
        //return redirect()->route('changePassword')->with("success", "¡Contraseña cambiada con éxito!")->delay(5);
    }
}
