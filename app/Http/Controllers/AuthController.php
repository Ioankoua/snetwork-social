<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getRegister()
    {
    	return view('auth.register');
    }

    public function postRegister(Request $request)
    {
    	$this->validate($request, [
            'name'     => 'required|alpha|min:2|max:15',
            'surname'  => 'required|alpha|max:15',
            'city'     => 'nullable|alpha|max:15',
            'birth'    => 'nullable|date',
            'email'    => 'required|unique:users|email|',
            'login'    => 'required|unique:users|min:6',
            'password' => 'required|min:6',

        ]);

        User::create([
            'name'     => $request->input('name'),
            'surname'  => $request->input('surname'),
            'city'     => $request->input('city'),
            'birth'    => $request->input('birth'),
            'email'    => $request->input('email'),
            'login'    => $request->input('login'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('auth.enter');
    }

    public function getEnter()
    {
    	return view('auth.enter');
    }

    public function postEnter(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|min:6',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($request->only(['login', 'password']), $request->has('remember') ) ) 
        {
            return redirect()->back()->with('info', 'Incorrect login or password');
        }

        return redirect()->route('wall.timeline');	
    }

    public function getExit()
    {
        Auth::logout();
        return redirect()->route('auth.enter');
    }
}
