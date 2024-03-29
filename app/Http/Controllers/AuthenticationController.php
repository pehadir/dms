<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthenticationController extends Controller
{
    public function loginView()
    {
        $page['title'] = 'DMS';
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if ($validateData->fails()) {
            return redirect()->route('login.view')->with('errors', $validateData->messages());
        }

        $user = User::where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Update Last Login Time
            $user->update(
                [
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                ]
            );

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('failed', 'Login Failed, Please Cek Email & Password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
