
<div class="card mb-3" style="width: 300px; height: 100px">
	<div class="row g-0">
		<div class="col-md-4">
			@if (!$user->avatar)
				<img src="{{ $user->getAvatarUrl() }}" class="card-img-top" alt="">
			@else
				<img src="{{ $user->getAvatarPath($user->id) . $user->avatar }}" class="card-img-top" alt="">
			@endif
		</div>
		<div class="col-md-8">
			<div class="card-body">
				<h6 class="card-title" style="margin-top: -8px; font-size: 14px;">
					{{ $user->name }}
					@if ($user->surname)
					{{ $user->surname }}
					@endif
				</h6>
				<p class="card-text" style=" font-size: 12px;">
					@if ($user->city)
					City: {{ $user->city }}
					@else
					City: undefaind
					@endif
				</p>

				<div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 1vh;">
					<a href="{{ route('profile.mainProfile', ['name' => $user->name]) }}" 
						class="btn btn-info" style="font-size: 10px; margin-top: -14px;">Profile</a>
					<a href="{{ route('message.chat', ['name' => $user->name]) }}" 
						class="btn btn-primary" style="font-size: 10px; margin-top: -14px;">Chat</a>
				</div>
			</div>
		</div>
	</div>
</div>


