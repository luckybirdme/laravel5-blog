@extends('layouts.second')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="list-group post-list-group">
						@can('update-post', $post)	
							<a class="btn btn-primary pull-right reload-button" href="{{ route('getPostUpdate',$post->id) }}">{{ translang('Edit Post') }}</a>
						@endcan
						@include('posts.list',array('post' => $post))


				        <div class = "post-body">
				        	{!! $post->content !!}
				        </div>
				        <hr>

				        <div class="comment-body">
				        	<div class="comment-header">
				        		<label class="control-label" for="comment">{{translang("Comments")}}</label>
				        	</div>
				        	<div class="comment-list-container">
				        		@if($post->has('comments'))
				        			@foreach($post->comments as $comment)
				        			<div class="comment-list">
				        				<div>
				        					<a href="{{ route('getUserPost',$comment->user->id) }}"> {{ $comment->user->name }} </a>
				        				</div>
				        				<div>
				        					{!! $comment->comment !!}
				        				</div>
				        			</div>
				        			@endforeach
				        		@endif

				        	</div>

				        	{!! Form::open(array('route' => 'postPostComment','method' => 'post','role' => 'form','class' => 'form-horizontal','id' => 'form')) !!}
					        {!! Form::hidden('id',$post->id) !!}
					        <div class="control-group">
				            	
				            	<div class="controls">
				            		{!! Form::textarea('comment',request('comment'),array('placeholder' => 'Say Something ?','id' => 'comment','class' => 'form-control input-xlarge', 'rows' => '3')) !!}
				            	</div>
							    @if ($errors->has('comment'))
									@foreach ($errors->get('comment') as $error_content)
										<p class="help-block alert-required">{{ $error_content }}</p>
									@endforeach
			                   	@endif
				            	<div class="comment-button">
				            		<button type="submit" class="btn btn-primary">{{ translang("Submit")}}</button>
				            	</div>
				          	</div>
				          	{!! Form::close() !!}

				        </div>


				    </div>
          		</div>
			</div>
		</div>
	</div>
</div>
@endsection
