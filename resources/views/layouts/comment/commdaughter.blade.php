

<div class="comm" style="margin-left: 10vw;">	
@foreach ($status->replies as $reply )

<div class="card mb-3" style="max-width: 540px;">
	<div class="row g-0">
		<div class="col-md-4">
			<a class="mr-3" href="{{ route('profile.mainProfile', ['name' => $reply->user->name]) }}">
				@if (!$reply->user->avatar)
					<img src="{{ $reply->user->getAvatarUrl() }}" class="card-img-top" alt="" style="width: 100px;">
				@else
					<img src="{{ $reply->user->getAvatarPath($reply->user->id) . $reply->user->avatar }}" class="card-img-top" alt=""
					style="width: 100px; margin-left: 0.4vw; margin-top: 1vh">
				@endif
			</a>
		</div>
		<div class="col-md-8">
			<div class="card-body">
				<h5 class="card-title" style="margin-left: -3.5vw;">{{ $reply->user->name }}</h5>
				<p class="card-text" style="margin-left: -3.5vw;" align=justify>{{ $reply->body }}</p>
				<div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 2vh;">
					<p class="card-text" style="margin-left: -3.5vw;"><small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small></p>


					<li class="list-inline-item">
						<a href="{{ route('status.like', ['statusId' => $status->id]) }}" style="text-decoration: none; margin-left: 0.5vw;">&#128150:</a>
					</li>
					<li class="list-inline-item">
						{{ $status->likes->count() }}
					</li>


				</div>
			</div>
		</div>
	</div>
</div>

@endforeach
</div>



