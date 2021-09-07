<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FreindsController extends Controller
{
    public function getIndex()
    {
    	$friends = Auth::user()->friends();
    	$requests = Auth::user()->friendRequests();

    	return view('friends.index')->with([
    		'friends' => $friends, 
    		'requests' => $requests,
    	]);
    }
    //Отправляет запрос на дружбу
    public function getAdd($name)
    {
    	$user = User::where('name', $name)->first();

    	if (!$user) {
    		return redirect()->back()->with('info', 'User not found');
    	}

        if (Auth::user()->id === $user->id) {
            return redirect()->back();
        }

    	if (Auth::user()->hasFriendRequestPending($user) 
    		|| $user->hasFriendRequestPending(Auth::user() ) )
    	{
    		return redirect()->back()
    			->with('info', 'friend request has already been sent');
    	}

    	if(Auth::user()->isFriendWith($user)){
    		return redirect()->back()
    			->with('info', 'User already your friend');
    	}

    	Auth::user()->addFriend($user);
    		return redirect()->back()
    			->with('info', 'friend request has been sent');
    }
    //Принамает запрос на дружбу
    public function getAccept($name)
    {
        $user = User::where('name', $name)->first();

        if (!$user) {
            return redirect()->back()->with('info', 'User not found');
        }

        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->back();
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('friends.index')
                ->with('info', 'friend request accept');
    }
    //Удаляет из друзей
    public function deleteFriend($name)
    {
        $user = User::where('name', $name)->first();

        if(!Auth::user()->isFriendWith($user)){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back()->with('info', 'Delete');
    }
}
