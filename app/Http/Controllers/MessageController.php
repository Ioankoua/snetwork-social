<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessage()
    {
        $users = \App\Models\User::all();

        $messages = \App\Models\Messages::all()->sortDesc();

        $authUserId = Auth::User()->getId();

        $authUser =  Auth::User();

        return view('message.messagesPage', [
            'messages' => $messages,
            'authUserId' => $authUserId,
            'users' => $users,
            'authUser' => $authUser,
        ]);

    }

    public function postMessage(Request $request)
    {
    	$this->validate($request, [
    		'message' => 'required|max:500'
    	]);

        $message = $request['message'];
    	$senderId =  Auth::User()->getId();
        $getterId = $request['userid'];

    	$result =  new Messages();

        $result->message_text = $message;
        $result->sender_user_id  = $senderId;
        $result->getter_user_id = $getterId;

        $result->save();  	   	

    	return redirect()->back();
    }

    public function chatMessage($name)
    {
        $user = User::where('name', $name)->first();

        $messages = \App\Models\Messages::all()->sortDesc();

        $authUserId = Auth::User()->getId();

        $authUser =  Auth::User();

    	return view('message.chat', [
            'messages' => $messages,
            'authUserId' => $authUserId,
            'user' => $user,
            'authUser' => $authUser,
        ]);
    }
}
