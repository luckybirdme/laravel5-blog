				{!! Form::open(array('route' => $route,'method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}

					{!! Form::hidden('id',request('id')) !!}

					<div class="control-group">
			            <label class="control-label" for="title">{{ translang("Title") }}</label>
			            <div class="controls">
			              {!! Form::text('title',request('title'),array('class' => 'form-control input-xlarge'))!!}
			            </div>
			        </div>

			        @if ($errors->has('title'))
						@foreach ($errors->get('title') as $error_content)
							<p class="help-block alert-required">{{ $error_content }}</p>
						@endforeach
                   	@endif	
			        <br>



					<div class="control-group">
			            <label class="control-label" for="category_id">{{ translang("Category") }}</label>
			            <div class="controls">
			              	{!! Form::select('category_id', $categories->lists('name','id'), request('category_id'),array('class' => 'form-control')) !!}
			            </div>
			        </div>

				    @if ($errors->has('category_id'))
						@foreach ($errors->get('category_id') as $error_content)
							<p class="help-block alert-required">{{ $error_content }}</p>
						@endforeach
                   	@endif	
                   	<br>

			        <div class="control-group">
			            <label class="control-label" for="tags">{{ translang("Tags") }}</label>

			            {!! Form::hidden('tags',request('tags'),array('id' => 'tags')) !!}

			            {!! Form::hidden('hasTags',$tags->lists('name')->toJson(),array('id' => 'hasTags')) !!}

			            <div class="controls">
					        <ul id="tags-container">
							    <!-- Existing list items will be pre-added to the tags -->

							</ul>
			            </div>
			        </div>

					<div class="control-group">
			            <label class="control-label" for="content">{{ translang("Content") }}</label>
			            <div class="controls">
			          		

							<div class="editor-wrapper">
								{!! Form::textarea('content',request('content'),array('id' => 'editor','placeholder' => 'Create Something ?')) !!}

						    </div>
						     <label class="control-label" for="title">{{ translang("Preview") }}</label>
							<div id="editor-preview-container">
							
							</div>

			            </div>
			        </div>


			        @if ($errors->has('content'))
						@foreach ($errors->get('content') as $error_content)
							<p class="help-block alert-required">{{ $error_content }}</p>
						@endforeach
                   	@endif	
                   	<br>

                   	<div class="control-group">
			            <div class="controls">
			              <label class="checkbox">
			              	@if (null !== request('active') and '1' == request('active'))
			                	{!! Form::checkbox('active','1', true)!!} 
			                @else
			                	{!! Form::checkbox('active','1')!!} 
			                @endif
			                {{translang('Publish')}}
			              </label>
			            </div>
			         </div>
			        <hr>
					<div class="form-actions">
			            <button type="submit" class="btn btn-primary">{{ translang("Save")}}</button>
			            @if (null !== request('id'))
			            	<a class="btn btn-default" href="{{ route('getPostDelete',request('id')) }}">{{ translang('Delete')}}</a>
			            @endif
			        </div>



			    {!! Form::close() !!}

			    <button id="uploadImageButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#imageUploadModal" style="display:none">Open Modal</button>
			    <input  type = "file" name="imageLocalInput" id="imageLocalInput" value="" required="true" accept="image/*" style="display:none;" />
			    <input type = "text" name="imageUploadUrl" id="imageUploadUrl" value="{{ route('uploadPostImage')}}" style="display:none"/>

				<!-- Modal -->
				<div class="modal fade" id="imageUploadModal" role="dialog">
					<div class="modal-dialog">
					    
					      <!-- Modal content-->
					    <div class="modal-content">
					        <div class="modal-header">
					          	<button type="button" class="close" data-dismiss="modal">&times;</button>
					          	<h4 class="modal-title">{{ translang('Add Image')}}</h4>
					        </div>
					        <div class="modal-body image-upload-modal-body" >
					        
					        	<div class="panel-body">
					        
 					        		<button type="button" class="btn btn btn-primary pull-right" id="imageLocalButton" >{{ translang('Upload')}}</button>
 					       	 		<button type="button" class="btn btn btn-primary pull-right image-local-loading" style="display:none;" id="imageLocalLoading">
 					       	 			<img src="{{ asset('/css/images/loading.gif') }}" />
 					       	 		</button>
					        		@include('form.input', array('input_name' => 'imageUrl','label_name' => 'Image Address'))



								</div>
					        
					        </div>
					        <div class="modal-footer image-upload-modal-footer">
					        	<button type="button" id="addToPostButton" class="btn btn btn-primary " data-dismiss="modal">{{ translang('Add to Post')}}</button>
					        </div>
					    </div>
					      
					</div>
				</div>


			    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet" >
				<link href="{{ asset('/css/jquery.tagit.css') }}" rel="stylesheet">
				<script  src="{{ asset('/js/jquery-ui.min.js') }}" ></script>
				<script  src="{{ asset('/js/tag-it.js')}}" ></script>

				<link href="{{ asset('/css/editor.css') }}" rel="stylesheet">
				<script type="text/javascript" src="{{ asset('/js/marked.js')}}"></script>
				<script type="text/javascript" src="{{ asset('/js/editor.js')}}"></script>

				<script type="text/javascript" src="{{ asset('/js/ajax-upload.js')}}"></script>

				<link href="{{ asset('/css/editor-self.css') }}" rel="stylesheet">
				<script src="{{ asset('/js/editor-self.js') }}" type="text/javascript"></script>

