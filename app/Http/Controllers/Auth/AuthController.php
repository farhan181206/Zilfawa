<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function register()
    {
        return view('dashboard.auth.register');
    }

    public function register_process(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'email|required|unique:users,email',
            'phone' => 'string|required',
            'age' => 'required',
            'gender' => 'string|required',
            'password' => 'required|min:8',
        ]);

        $data['password'] = bcrypt($request->password);
        $data['role'] = 'user';
        $user = User::create($data);
        // dd($user);
        auth()->login($user);

        return redirect()->route('front.index');
    }

    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'password' => 'required'
        ]);

        $credentials = $request->only('phone', 'password');
        $authenticated = Auth::attempt($credentials, $request->has('remember'));

        if (!$authenticated){
            return redirect()->back()->with('error', 'email atau password salah.');
        }

        // dd(auth()->guard('admin')->user()->name);

        // return redirect()->intended('/');

        $input = $request->all();

        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == 'user') {
                return redirect()->route('front');
            }else{
                return redirect()->route('admin.dashboard');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
