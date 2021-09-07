@if (Session::has('info'))
	<div class="alert alert-info" role="alert" style="margin-top: 3vh; text-align: center;">
  		{{ Session::get('info') }}
	</div>
@endif