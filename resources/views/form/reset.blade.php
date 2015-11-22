					{!! Form::open(array('route' => 'postReset','method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}
						
						<input type="hidden" name="token" value="{{ $token }}">

						@include('form.input', array('input_name' => 'email','label_name' => 'Email'))

						@include('form.input', array('input_name' => 'password','label_name' => 'Password'))
						
						@include('form.input', array('input_name' => 'password_confirmation','label_name' => 'Confirm Password'))

						@include('form.button', array('button_name' => 'Reset Password'))

					{!! Form::close() !!}