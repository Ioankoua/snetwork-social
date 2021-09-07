<div class="col-lg-6">
	<form method="post" action="{{ route('status.post') }}">
		@csrf
		<div class="form-group">
			<h5 style="margin-bottom: 2vh;">Add new post</h5>

			@if($errors->has('status'))
				<span class="help-block text-danger">
					{{ $errors->first('status') }}
				</div>
			@endif

			<textarea name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
				style="width: 27vw; ">
			</textarea>
		</div>
		<button type="submit" class="btn btn-primary" style="margin-top: 2vh;">
			Add post
		</button>
	</form>
</div>