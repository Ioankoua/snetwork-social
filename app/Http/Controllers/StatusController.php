<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
    	$this->validate($request, [
    		'status' => 'required|max:500'
    	]);

    	Auth::user()->statuses()->create([
    		'body' => $request->input('status')
    	]);

    	return redirect()->back()->with('info', 'Add post');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:200'],
        [
            'required' => 'The field is required.'
        ]);

        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return redirect()->back();
        }

        if (!Auth::user()->isFriendWith($status->user) && Auth::user()->id !== $status->user->id) {
            return redirect()->back();
        }

        $reply = new Status();
        $reply->body = $request->input("reply-{$status->id}");
        $reply->user()->associate(Auth::user() );

        $status->replies()->save($reply);

        return redirect()->back();

    }

    public function getLike($statusId)
    {

        $status = Status::find($statusId);


        if (!$status) {
            return redirect()->back();
        }

        if (!Auth::user()->isFriendWith($status->user)) {
            return redirect()->back();
        }

        if (Auth::user()->hasLikedStatus($status)) {
            return redirect()->back();
        }

        $status->likes()->create(['user_id' => Auth::user()->id]);

        return redirect()->back();
    }
}
