					{!! Form::open(array('route' => 'postLogin','method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}
						
						@include('form.input', array('input_name' => 'email','label_name' => 'Email'))

						@include('form.input', array('input_name' => 'password','label_name' => 'Password'))
					
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('remember')!!} {{ translang('Remember Me') }}
									</label>
								</div>
							</div>
						</div>

						@include('form.button', array('button_name' => 'Login'))


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a href="{{ route('getEmail') }}">{{ translang('Forgot Password') }}</a>
							</div>
						</div>



					{!! Form::close() !!}