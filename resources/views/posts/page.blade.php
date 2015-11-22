@extends('layouts.second')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $page_title }}</div>
				<div class="panel-body">
					<div class="list-group post-list-group">
					@forelse ($posts as $post)
						@include('posts.list',array('post' => $post))

				    @empty
				        {{ translang('There are nothing here!') }}
				    @endforelse
				    </div>
				   
				    {!! $posts->render() !!}
          		</div>
			</div>
		</div>
	</div>
</div>
@endsection
