@extends('layouts.default')

@section('content')

<div class="row align-items-start">

	<div class="col" style="margin-top: 5vh;">
		<h5>Last dialogues</h5>

	@php $arrA =[]; $arrU =[];  @endphp

	@foreach ($messages as $message)
		
		@if($authUserId == $message->sender_user_id)

			@foreach ($users as $user)

				@if ($user->id == $message->getter_user_id)

					@if (in_array($user->id , $arrA))

					@else

					@php array_push($arrA, $user->id); @endphp

					@include('layouts.user.userblock')

						<div class="alert alert-secondary" role="alert">
							<p align=justify> {{ $message->message_text }}</p>
							<li class="list-inline-item">
								{{ $message->created_at->diffForHumans() }}
							</li>
						</div>

					@endif

				@endif

			@endforeach

		@endif

	@endforeach

	</div>

	<div class="col" style="margin-top: 5vh;">
		<h5>Last messages received</h5>

	@foreach ($messages as $message)

			
		@if($authUserId == $message->getter_user_id)

			@foreach ($users as $user)

				@if ($user->id == $message->sender_user_id)

					@if (in_array($user->id , $arrU))

					@else

					@php array_push($arrU, $user->id); @endphp

					@include('layouts.user.userblock')

						<div class="alert alert-secondary" role="alert">
							<p align=justify> {{ $message->message_text }}</p>
							<li class="list-inline-item">
								{{ $message->created_at->diffForHumans() }}
							</li>
						</div>

					@endif

				@endif

			@endforeach

		@endif

	@endforeach

	</div>
</div>


@endsection