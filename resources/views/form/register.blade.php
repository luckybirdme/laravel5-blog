					{!! Form::open(array('route' => 'postRegister','method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}
						
						@include('form.input', array('input_name' => 'name','label_name' => 'Name'))

						@include('form.input', array('input_name' => 'email','label_name' => 'Email'))

						@include('form.input', array('input_name' => 'password','label_name' => 'Password'))
						
						@include('form.input', array('input_name' => 'password_confirmation','label_name' => 'Confirm Password'))

						@include('form.button', array('button_name' => 'Register'))


					{!! Form::close() !!}