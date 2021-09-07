@extends('layouts.default')

@section('content')
	
	<div style="margin-left: 40vw; margin-top: 4vh;"><h4>Enter</h4></div>

	<form method="post" action="{{ route('auth.enter') }}" novalidate>
		@csrf

		<div style="margin-left: 25vw; margin-right: 25vw;">
			<div class="mb-3">
				<label for="login" class="form-label">Login</label>
				<input type="text" name="login"  
				class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}"
				id="login" placeholder="lol1@gmail.com"
				value="{{ Request::old('login') ?: '' }}">

				@if ($errors->has('login'))
				<span class="help-block text-danger">
					{{ $errors->first('login') }}
				</span>
				@endif

			</div>

			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" 
				class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
				id="password" placeholder="xtry469">

				@if ($errors->has('password'))
				<span class="help-block text-danger">
					{{ $errors->first('password') }}
				</span>
				@endif

			</div>

			<div class="mb-3 form-check">
				<input type="checkbox" class="form-check-input" id="remember" name="remember">
				<label class="form-check-label" for="remember">Remember me</label>
			</div>

			<button type="submit" class="btn btn-primary" style="margin-bottom: 5vh; margin-left: 16vw;">
				Signup account
			</button>
		</div>
	</form>
@endsection