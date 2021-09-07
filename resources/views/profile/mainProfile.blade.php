@extends('layouts.default')

@section('content')

<div class="row align-items-start">
	<div class="col-6">

		@include('layouts.user.accblock')

		<div style="margin-top: 5vh;;">
			<h4>{{ $user->name }} Frends</h4>
			@if(!$user->friends()->count())
				<p>{{ $user->name }} No Frends</p>
			@else
				@foreach ($user->friends() as $user)
					@include('layouts.user.userblock')
				@endforeach
			@endif
		</div>
	</div>

	<div class="col-6" style="margin-top: 5vh;">
		@include('layouts.comment.post')
	</div>

</div>





@endsection