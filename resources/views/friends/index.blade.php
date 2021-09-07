@extends('layouts.default')

@section('content')
<div class="row align-items-start">
	<div class="col" style="margin-top: 5vh">
	<h3>Your Friends</h3>
	@if(!$friends->count())
			<p>You have not friends</p>
		@else
			@foreach ($friends as $user)
				@include('layouts.user.userblock')
			@endforeach
	@endif
	</div>
	<div class="col" style="margin-top: 5vh">
	<h3>Require Frends</h3>
	@if(!$requests->count())
			<p style="font-size: 18px;">You have not requests</p>
		@else
			@foreach ($requests as $user)
				@include('layouts.user.userblock')
			@endforeach
	@endif
	</div>
</div>



@endsection