					@if (isset($status))
						<div class="alert alert-success">
							{{ $status }}
						</div>
					@endif


					{!! Form::open(array('route' => 'postEmail','method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}
						
						@include('form.input', array('input_name' => 'email','label_name' => 'Email'))

						@include('form.button', array('button_name' => 'Send Password Reset Link'))

					{!! Form::close() !!}