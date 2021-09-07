@extends('layouts.default')

@section('content')

@if(!$statuses->count())
	<div class="wall" 
		 style="margin-top: 10vh; position: absolute; margin-left: 15vw">
	@include('layouts.block.addpost')
	</div>
@elseif($statuses->count())
	<div class="wall" 
		 style="margin-top: 10vh; position: absolute; margin-left: 60vw">
	@include('layouts.block.addpost')
	</div>
@endif
	<div style="margin-top: 5vh; margin-left: 10vw;">
		@include('layouts.comment.post')
	</div>

@endsection