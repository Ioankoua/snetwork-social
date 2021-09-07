		@if(!$statuses->count())

		<h4 style="margin-left: 10vw;">You have not records</h4>

		@elseif($statuses->count())
		@foreach ($statuses as $status)

		<div class="card mb-3" style="max-width: 610px;">
			<div class="row g-0">
				<div class="col-md-4">
					<a class="mr-3" href="{{ route('profile.mainProfile', ['name' => $status->user->name]) }}">
						@if (!$status->user->avatar)
							<img src="{{ $status->user->getAvatarUrl() }}" class="card-img-top" alt="" style="width: 100px;">
						@else
							<img src="{{ $status->user->getAvatarPath($status->user->id) . $status->user->avatar }}" class="card-img-top" alt=""
								style="width: 100px; margin-left: 0.4vw; margin-top: 1vh">
						@endif
					</a>
				</div>
				<div class="col-md-8">
					<div class="card-body" style="margin-left: -6vw;">
						<h5 class="card-title">{{ $status->user->name }}</h5>
						<p class="card-text" align=justify>{{ $status->body }}</p>
						<div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 2vh;">
							<p class="card-text"><small class="text-muted">{{ $status->created_at->diffForHumans() }}</small></p>


							<li class="list-inline-item" style="margin-left: 1vw;">
								<a href="{{ route('status.like', ['statusId' => $status->id]) }}" style="text-decoration: none;">&#128150:</a>
							</li>
							<li class="list-inline-item">
								{{ $status->likes->count() }}
							</li>

						</div>
					</div>
				</div>
			</div>
		</div>

		@include('layouts.comment.commdaughter')

				<form method="post" action="{{ route('status.reply', ['statusId' => $status->id]) }}" class="mb-4">
					@csrf
					<div class="form-group">
						<textarea name="reply-{{ $status->id }}" 
							class='form-control{{ $errors->has("reply-{$status->id}") ? " is-invalid" : "" }}'
							style="width: 40vw;">
						</textarea>

						@if ($errors->has("reply-{$status->id}"))
						<span class="help-block text-danger">
							{{ $errors->first("reply-{$status->id}") }}
						</span>
						@endif

					</div>
					<button type="submit" class="btn btn-primary btn-sm" 
					style="margin-top: 2vh;">
					Comment
				</button>
			</form>
	@endforeach

	@endif
