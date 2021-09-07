<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\User;
use Auth;

class MainController extends Controller
{
    public function mainPage()
    {

    	if (Auth::check()) {

    		$statuses = Status::notReply()->where(function($query) {
    			return $query->where('user_id', Auth::user()
                       ->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
    		           })->orderBy('created_at', 'desc')->paginate(10);

    		return view('wall.timeline', [
                'statuses' => $statuses,
            ]);
    	}

    	return view('auth.enter');

    }
}
