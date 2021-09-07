<div class="col-lg-6" style="margin-left: 62vw; margin-top: 5vh; position: fixed">
	<form method="post" action="{{ route('message.messagesPage') }}">
		@csrf
		<div class="form-group">
			<textarea name="message" class="form-control"
				style="width: 24vw;">
				
			</textarea>
			<input type="text" name="userid" value="{{ $user->id }}" style="height: 1px; width: 1px; opacity: 0;">
		</div>

		<button type="submit" class="btn btn-primary" style="margin-top: 1vh;">
			Send message
		</button>
	</form>
</div>

