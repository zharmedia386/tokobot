<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Manager;
use App\Models\Waiter;
use App\Models\Pelaku_UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // LOGIN PELAKU UMKM :GET
    public function login()
    {
        if (session()->has('hasLogin')) {
            echo "<script>alert('You already signed in')</script>";
            return view('home');
        }
        return view('auth.sign-in');
    }

    // LOGIN PELAKU UMKM :POST
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $query = DB::select('select users.user_id, users.username, users.password from users inner join pelaku_umkm on pelaku_umkm.user_id = users.user_id where users.username = ?', [$credentials['username']]);
        // dd($query);

        // Session User_id, Username, hasLogin, and Role
        if (!$query) {
            return back()->with('loginError', 'Login Failed!');
        }
        $request->session()->put('username', $credentials['username']);
        $username_user = $credentials['username'];
        $role_user = DB::selectOne("select getRoleUser('$username_user') as value from dual")->value;

        $user_id = $query[0]->user_id;
        $email_user = DB::selectOne("select getEmailUser('$user_id') as value from dual")->value;

        // dd($email_user);
        
        $user_id = DB::selectOne("select getUserId('$username_user') as value from dual")->value;

        $isPelaku_UMKM = Pelaku_UMKM::where('user_id', $query[0]->user_id)->first();
        if ($isPelaku_UMKM && Hash::check($credentials['password'], $query[0]->password)) {
            $request->session()->put('hasLogin', 'true');
            $request->session()->put('role', $role_user);
            $request->session()->put('username', $username_user);
            $request->session()->put('user_id', $user_id);
            $request->session()->put('email', $email_user);
            return redirect()->intended('/');
        } else {
            return back()->with('loginError', 'Login Failed!');
        }
    }

    // REGISTER PELAKU UMKM :GET
    public function register()
    {
        return view('auth.sign-up');
    }

    // REGISTER PELAKU UMKM :POST
    public function store(Request $request)
    {
        // Users
        $users = new Users;
        $newId = DB::selectOne("select getNewId('users') as value from dual");
        $users->user_id = $newId->value;
        $users->password = Hash::make($request->password);
        $users->username = $request->username;
        $users->save();

        // Pelaku_UMKM
        $pelaku_umkm = new Pelaku_UMKM;
        $pelaku_umkm->user_id = $newId->value;
        $pelaku_umkm->full_name = $request->full_name;
        $pelaku_umkm->email = $request->email;
        $pelaku_umkm->phone = $request->phone;

        $pelaku_umkm->save();

        return redirect('/auth/login')->with('successLogin', 'Registration Success! Please Login');
    }

    // LOGOUT PELAKU UMKM :POST
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // UPDATE PASSWORD PELAKU UMKM :GET
    public function update_password()
    {
        return view('auth.update_password');
    }

    // PROFILE PAGE PELAKU UMKM :GET
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