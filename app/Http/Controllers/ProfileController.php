<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{
    public function getProfile($name)
    {
    	$user = User::where('name', $name)->first();

    	if (!$user) {
    		abort(400);
    	}

        $statuses = $user->statuses()->notReply()->get()->sortDesc();

    	return view('profile.mainProfile', [
            'user' => $user,
            'statuses' => $statuses,
            'authUserIsFriend' => Auth::user()->isFriendWith($user),
        ]);
    }

    

    public function getEdit()
    {
    	return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
    	$this->validate($request, [
            'name'     => 'nullable|alpha|min:2|max:15',
            'surname'  => 'nullable|alpha|max:15',
            'city'     => 'nullable|alpha|max:15',
            'birth'    => 'nullable|date',
            'email'    => 'nullable|unique:users|email|',
            'login'    => 'nullable|unique:users|min:6',
            'password' => 'nullable|min:6',

        ]);

        if($request != null){
        	
        	if($request['name'] != null){
    		Auth::user()->update([
    		'name' => $request->input('name')]);
    		}
    		if($request['surname'] != null){
    		Auth::user()->update([
    		'surname' => $request->input('surname')]);
    		}
    		if($request['city'] != null){
    		Auth::user()->update([
    		'city' => $request->input('city')]);
    		}
    		if($request['birth'] != null){
    		Auth::user()->update([
    		'birth' => $request->input('birth')]);
    		}
    		if($request['email'] != null){
    		Auth::user()->update([
    		'email' => $request->input('email')]);
    		}
    		if($request['login'] != null){
    		Auth::user()->update([
    		'login' => $request->input('login')]);
    		}
    		if($request['password'] != null){
    		Auth::user()->update([
    		'password' => $request->input('password')]);
    		}

    		return redirect()->route('profile.edit')->with('info', 'Profile success refresh!');
    	}

    }

    public function upAvatar(Request $request, $name)
    {
       $user = User::where('name', $name)->first();

       if (!Auth::user()->id === $user->id) {
            return redirect()->back();
        }

        if ($request->hasFile('avatar')) {

           $user->clearAvatars($user->id);

           $avatar = $request->file('avatar');
           $filename = time() .'.'. $avatar->getClientOriginalExtension();

           Image::make($avatar)->resize(300, 300)
                ->save(public_path($user->getAvatarPath($user->id)) . $filename);

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

        }

        return redirect()->back();
    }

}
