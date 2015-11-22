				{!! Form::open(array('route' => $route,'method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}


					<div class="control-group">
			            <div class="controls">
			              {!! Form::text('name',request('name'),array('class' => 'form-control input-xlarge'))!!}
			            </div>
			        </div>

			        @if ($errors->has('name'))
						@foreach ($errors->get('name') as $error_content)
							<p class="help-block alert-required">{{ $error_content }}</p>
						@endforeach
                   	@endif	
			   
			        <hr>
					<div class="form-actions">
			            <button type="submit" class="btn btn-primary">{{ translang("Save")}}</button>
			        </div>
			    {!! Form::close() !!}