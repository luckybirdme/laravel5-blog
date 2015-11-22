@extends('layouts.second')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">{{ translang('Add Category') }}</div>
				<div class="panel-body">

					@include('form.category',array('route' => 'postCategoryCreate'))

					<br>
					<table class="table table-bordered table-striped table-hover">
					    <thead>
					      <tr>
					        <th>#</th>
					        <th>Name</th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach($categories as $category)
						    	<tr>
						        	<td>{{ $category->id }}</td>
						        	<td>{{ $category->name }}</td>
						     	</tr>
					    	@endforeach

					    </tbody>
				  	</table>

          		</div>
			</div>
		</div>
	</div>
</div>
@endsection
