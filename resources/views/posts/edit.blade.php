@extends('layouts.second')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">{{ translang('Edit Post') }}</div>
				<div class="panel-body">

					@include('form.post',array('route' => 'postPostUpdate'))

          		</div>
			</div>
		</div>
	</div>
</div>
@endsection
