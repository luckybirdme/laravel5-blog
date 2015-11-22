@extends('layouts.second')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">{{ translang($page_title) }}</div>
				<div class="panel-body">


					<table class="table table-bordered table-striped table-hover">
					    <thead>
					      <tr>
					        <th>Number</th>
					        <th>Name</th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach($users as $user)
						    	<tr>
						        	<td>{{ $user->id }}</td>
						        	<td><a href="{{ route('getUserPost',$user->id) }}">{{ $user->name }}</a></td>
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
