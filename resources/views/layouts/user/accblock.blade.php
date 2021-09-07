<div class="mainblock" style="margin-top: 4vh;"> 
	<div class="card mb-3" style="width: 500px; height: 210px;" >
		<div class="row g-0">
			<div class="col-md-5">
				@if (!$user->avatar)
				<img src="{{ $user->getAvatarUrlMain() }}" class="card-img-top" alt="">
				@else
				<img src="{{ $user->getAvatarPath($user->id) . $user->avatar }}" class="card-img-top" alt="">
				@endif
			</div>
			<div class="col-md-4" style="= margin-top: -25vh;">
				<div class="card-body">
					<h4 class="card-title" style="margin-top: -8px;">
						{{ $user->name }}
						@if ($user->surname)
						{{ $user->surname }}
						@endif
					</h4>
					<p class="card-text" style="margin-top: -5px"><small class="text-muted"></small>
						@if ($user->city)
						City: {{ $user->city }}
						@else
						City: undefaind
						@endif
					</p>

					<div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 2vh;">
						<a href="{{ route('profile.mainProfile', ['name' => $user->name]) }}" 
							class="btn btn-info" style="font-size: 14px; margin-top: -14px;">Profile</a>
							@if ( Auth::user()->id !== $user->id)
							<a href="{{ route('message.chat', ['name' => $user->name]) }}" 
								class="btn btn-primary" style="font-size: 14px; margin-top: -14px;">Chat</a>
								@else
								<a href="{{ route('message.chat', ['name' => $user->name]) }}" 
									class="btn btn-primary" style="font-size: 14px; margin-top: -14px;">Selfchat</a>
									@endif
								</div>

								<div style="margin-top: 1vh;"> 

									@if (Auth::user()->hasFriendRequestPending($user))
									<p>Waiting {{ $user->name }} friend request</p>

									@elseif( Auth::user()->hasFriendRequestReceived($user))
									<a href="{{ route('friends.accept', ['name' =>  $user->name]) }}" class="btn btn-primary">Accept</a>

									@elseif( Auth::user()->isFriendWith($user))
									<p>{{ $user->name }} your freind </p>

									<form method="post" action="{{ route('friends.delete', ['name' =>  $user->name]) }}">
										@csrf
										<input type="submit" class="btn-primary" value="Delete friend">
									</form>

									@elseif( Auth::user()->id !== $user->id)
									<a href="{{ route('friends.add', ['name' =>  $user->name]) }}" class="btn btn-primary">Add Friend</a>
									@endif

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>