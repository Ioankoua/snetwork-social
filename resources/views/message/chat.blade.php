@extends('layouts.default')

@section('content')

	@include('layouts.block.addmessege')

	@foreach ($messages as $message)
		
		@if ($user->id == $message->getter_user_id && $authUserId == $message->sender_user_id 
		    || $user->id == $message->sender_user_id && $authUserId == $message->getter_user_id)
				
			@include('layouts.user.userchat')

		@endif

	@endforeach

@endsection