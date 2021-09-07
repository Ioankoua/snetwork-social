@extends('layouts.default')

@section('content')
<h3 style="margin-top: 5vh; margin-left: 1vw;">Search Results: {{ Request::input('query') }}</h3>

@if (!$users->count())
	<p>Users not found</p>
@else

<div class="container">
	<div class="col-lg-6">
		@foreach($users as $user)

			@include('layouts.user.userblock')

		@endforeach
	</div>
</div>


@endif

@endsection