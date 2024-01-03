<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Pelaku_UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Redirecting to Login Page 
    public function login()
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            // redirect to the home page along with a flash message
            return redirect('/')->with('alreadyLogin', 'You already signed in! No need to login anymore!');
        }
        return view('auth.sign-in');
    }

    // Authenticate user's based on pelaku_umkm database
    public function authenticate(Request $request)
    {
        // If either of these fields are not present, an error message will be returned.
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // fetch the user data based on the username
        $query = DB::select('select users.user_id, users.username, users.password from users inner join pelaku_umkm on pelaku_umkm.user_id = users.user_id where users.username = ?', [$credentials['username']]);

        // If the query does not return any result, redirect to the previous page with a flash message 
        if (!empty($query)) {
            return back()->with('loginError', 'Login Failed!');
        }

        // Get username from credentials input
        $username_user = $credentials['username'];

        // Get user_id based on username
        $user_id = DB::selectOne("select getUserId('$username_user') as value from dual")->value;

        // Get role based on username
        $role_user = DB::selectOne("select getRoleUser('$username_user') as value from dual")->value;

        // Get email based on user_id
        $email_user = DB::selectOne("select getEmailUser('$user_id') as value from dual")->value;

        // Retrieve data pelaku_umkm where user_id is same as logined user
        $isPelaku_UMKM = Pelaku_UMKM::where('user_id', $user_id)->first();

        // if entered password matches the password in the database, then sets session variables
        if ($isPelaku_UMKM && Hash::check($credentials['password'], $query[0]->password)) {
            $request->session()->put('username', $username_user);
            $request->session()->put('hasLogin', 'true');
            $request->session()->put('role', $role_user);
            $request->session()->put('user_id', $user_id);
            $request->session()->put('email', $email_user);
            return redirect()->intended('/');
        } else {
            // if the login failed, redirect to the previous page with a flash message
            return back()->with('loginError', 'Login Failed!');
        }
    }

    // Redirecting to register page
    public function register()
    {
        return view('auth.sign-up');
    }

    // Registering a new users
    public function store(Request $request)
    {
        // create new instance of Users and save into Users table
        $users = new Users;
        $newId = DB::selectOne("select getNewId('users') as value from dual");
        $users->user_id = $newId->value;
        $users->password = Hash::make($request->password);
        $users->username = $request->username;
        $users->save();

        // create new instance of Pelaku Umkm and save into Pelaku Umkm table
        $pelaku_umkm = new Pelaku_UMKM;
        $pelaku_umkm->user_id = $newId->value;
        $pelaku_umkm->full_name = $request->full_name;
        $pelaku_umkm->email = $request->email;
        $pelaku_umkm->phone = $request->phone;

        $pelaku_umkm->save();

        return redirect('/auth/login')->with('successRegister', 'Registration Success! Please Login');
    }

    // LOGOUT PELAKU UMKM :POST
    public function logout(Request $request)
    {
        // logs out the currently authenticated user.
        Auth::logout();

        // destroys all data stored in the session
        $request->session()->invalidate();

        // regerenerates session, prevent session fixation attacks, where an attacker tries to hijack a user's session by stealing the session ID
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Redirecting to update password page
    public function update_password()
    {
        return view('auth.update_password');
    }

    // PROFILE PAGE PELAKU UMKM :GET
    // Edit profile handler and save it to database
    public function profile()
    {
        $pelaku_umkm_id = session()->get('user_id');
        $pelaku_umkm_name = session()->get('username');
        $pelaku_umkm_role = session()->get('role');
        $pelaku_umkm_address = session()->get('pelaku_umkm_address');

        // get saldo from pelaku_umkm table
        $saldo = DB::select('select pelaku_umkm.saldo from pelaku_umkm inner join users on users.user_id = ?', [$pelaku_umkm_id])[0]->saldo;
        $saldo == null ? $saldo = 0 : $saldo = $saldo;
        // dd($saldo);
        return view('auth.profile', compact('pelaku_umkm_name', 'saldo', 'pelaku_umkm_id', 'pelaku_umkm_role', 'pelaku_umkm_address'));
    }

    // EDIT PROFILE PELAKU UMKM :POST
    public function edit_profile(Request $request)
    {
        $pelaku_umkm_id = session()->get('user_id');
        $users = Users::find($pelaku_umkm_id);
        if ($request->username) {
            $users->username = $request->username;
            $users->update();
        }

        $pelaku_umkm = Pelaku_UMKM::find($pelaku_umkm_id);
        if ($request->address) {
            $pelaku_umkm->address = $request->address;
            $pelaku_umkm->update();
        }

        // Logout and redirect to login page
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('editProfile', 'Edit Profile Success! Please Login Again');
    }

}