@extends('layouts.default')

@section('content')

<div style="margin-left: 37vw; margin-top: 4vh;"><h4>Editing a profile</h4></div>

<form action="{{ route('upAvatar', ['name' => Auth::user()->name]) }}" enctype="multipart/form-data" method="post" style=" margin-left: 45vw; margin-top: 10vh;">
	@csrf

	<label for="avatar">Download avatar</label>
	<input type="file" name="avatar" id="avatar">
	<input type="submit" class="btn btn-primary" name="download" value="download">

</form>

<form method="post" action="{{ route('profile.edit') }}" novalidate style="margin-left: -20vw; margin-top: -10vh;">
	@csrf
	<div style="margin-left: 25vw; margin-right: 50vw;">
		<div class="mb-3">
			<label for="name" class="form-label">Name or Nikname</label>
			<input type="text" name="name" id="name" placeholder="Steve"
			class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
			value="{{ Request::old('name') ?: '' }}">
		</div>

		@if ($errors->has('name'))
		<span class="help-block text-danger">
			{{ $errors->first('name') }}
		</span>
		@endif

		<div class="mb-3">
			<label for="surname" class="form-label">Surname</label>
			<input type="text" name="surname" id="surname" placeholder="White"
			class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}"
			value="{{ Request::old('surname') ?: '' }}">
			<div id="emailHelp" class="form-text">* This data is optional</div>
		</div>

		@if ($errors->has('surname'))
		<span class="help-block text-danger">
			{{ $errors->first('surname') }}
		</span>
		@endif

		<div class="mb-3">
			<label for="city" class="form-label">City</label>
			<input type="text" name="city" id="city" placeholder="Kiev"
			class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" 
			value="{{ Request::old('city') ?: '' }}">
			<div id="emailHelp" class="form-text">* This data is optional</div>
		</div>

		@if ($errors->has('city'))
		<span class="help-block text-danger">
			{{ $errors->first('city') }}
		</span>
		@endif

		<div class="mb-3">
			<label for="birth" class="form-label">Date of Birth</label>
			<input type="text" name="birth" id="birth" placeholder="2000-02-06"
			class="form-control{{ $errors->has('birth') ? ' is-invalid' : '' }}" 
			value="{{ Request::old('birth') ?: '' }}">
			<div id="emailHelp" class="form-text">* This data is optional</div>
		</div>

		@if ($errors->has('birth'))
		<span class="help-block text-danger">
			{{ $errors->first('birth') }}
		</span>
		@endif

		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" name="email" id="email" placeholder="email@gmeil.com"
			class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
			value="{{ Request::old('email') ?: '' }}">
		</div>

		@if ($errors->has('email'))
		<span class="help-block text-danger">
			{{ $errors->first('email') }}
		</span>
		@endif

		<div class="mb-3">
			<label for="login" class="form-label">Login</label>
			<input type="text" name="login" id="login" placeholder="t67rnfj"
			class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" 
			value="{{ Request::old('login') ?: '' }}">
		</div>

		@if ($errors->has('login'))
		<span class="help-block text-danger">
			{{ $errors->first('login') }}
		</span>
		@endif

		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" name="password" id="password" placeholder="&5dfadf!"
			class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
			value="">
		</div>

		@if ($errors->has('password'))
		<span class="help-block text-danger">
			{{ $errors->first('password') }}
		</span>
		@endif

		<button type="submit" class="btn btn-primary" style="margin-bottom: 5vh; margin-left: 15vw;">
			Refresh
		</button>

	</div>
</form>

@endsection