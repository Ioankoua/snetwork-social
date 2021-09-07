

@if($authUserId == $message->sender_user_id)

<div class="card mb-3" style="width: 38vw; height: auto; margin-top: 5vh; margin-left: 5vw; background-color: #b4ede9;">
	<div class="row g-0">
		<div class="col-md-4">
			<a href="{{ route('profile.mainProfile', ['name' => $authUser->name]) }}">
				@if (!$authUser->avatar)
					<img src="{{ $authUser->getAvatarUrl() }}" class="card-img-top" alt="" style="width: 100px;">
				@else
					<img src="{{ $authUser->getAvatarPath($authUser->id) . $authUser->avatar }}" class="card-img-top" alt="" 
						style="width: 100px; margin-top: 1vh; margin-left: 0.5vw;">
				@endif
			</a>
		</div>
		<div class="col-md-8">
			<div class="card-body">
				<h5 class="card-title" style="margin-top: -8px; margin-left: -90px;">
					{{ $authUser->name }}
					@if ($authUser->surname)
					{{ $authUser->surname }}
					@endif
				</h5>
				<p class="card-text">
					<p align=justify style="margin-left: -90px;">{{ $message->message_text }}</p>
					<li class="list-inline-item" style="margin-left: -90px;">
						{{ $message->created_at->diffForHumans() }}
					</li>
				</p>
			</div>
		</div>
	</div>
</div>

@else

<div class="card text-end" style="width: 38vw; height: auto; margin-top: 5vh; margin-left: 15vw; background-color: #f0f26f;">
	<div class="row g-0">
		<div class="col-md-9">
			<div class="card-body" style="margin-right: -2.7vw;">
				<h5 class="card-title" style="" >
					{{ $user->name }}
					@if ($user->surname)
					{{ $user->surname }}
					@endif
				</h5>
				<p class="card-text">
					<p align=justify style="float: right; margin-top: vh">{{ $message->message_text }}</p>
					<p style="margin-top: 8vh;"></p>
					<li class="list-inline-item" style="">
						{{ $message->created_at->diffForHumans() }}
					</li>
				</p>
			</div>
		</div>
		<div class="col-md-3">
			<a href="{{ route('profile.mainProfile', ['name' => $user->name]) }}">
				@if (!$user->avatar)
					<img src="{{ $user->getAvatarUrl() }}" class="card-img-top" alt="" style="width: 100px;">
				@else
					<img src="{{ $user->getAvatarPath($user->id) . $user->avatar }}" class="card-img-top" alt="" 
						style="width: 100px; margin-top: 1vh; margin-right: 0.5vw;">
				@endif
			</a>
		</div>
	</div>
</div>


@endif

