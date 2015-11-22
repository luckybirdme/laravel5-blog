						<div class="form-group">
							{!! Form::label($input_name, translang($label_name), array('class' => 'col-md-4 control-label')); !!}
							<div class="col-md-6">
								@if ($input_name == 'email')

									{!! Form::email($input_name,request($input_name),array('class' => 'form-control')) !!}

								@elseif ($input_name == 'name')

									{!! Form::text($input_name,request($input_name),array('class' => 'form-control')) !!}

								@elseif ($input_name == 'password')

									{!! Form::password($input_name,array('class' => 'form-control')) !!}

								@elseif ($input_name == 'password_confirmation')

									{!! Form::password($input_name,array('class' => 'form-control')) !!}
								
								@else
									{!! Form::text($input_name,request($input_name),array('class' => 'form-control')) !!}
								@endif
							</div>
						</div>
						@if ($errors->has($input_name))
						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-6 alert-required">
								@foreach ($errors->get($input_name) as $error_content)
									<p>{{ $error_content }}</p>
								@endforeach
                   		 	</div>
                   		 </div>	
                   		 @endif	