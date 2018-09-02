@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Shërbimet</strong>
				</div>
				<div class="panel-body">
					<table class="table table-condensed">
						<tr>
							<th>ID</th>
							<th>Shërbimi</th>
							<th>Redakto</th>
							{{-- <th>Fshi</th> --}}
						</tr>
						<?php $i = 0; ?>
						@foreach($services as $service)
						<?php $i++; ?>
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $service->name }}</td>
								<td>
									<a href="{{ route('services.edit',$service->id) }}" class="btn btn-info btn-sm">Redakto</a>
								</td>
								{{-- <td>
									<form method="POST" action="{{ route('services.destroy',$service->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="submit" class="btn btn-danger btn-sm" value="Fshi">
									</form>
								</td> --}}
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Krijo Shërbim</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('services.store') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Shërbimi</label>
							<input type="text" name="name" class="form-control">
						</div>
						<input type="submit" class="btn btn-primary" value="Submit">
					</form>
				</div>
			</div>
		</div>
		
	</div>

@endsection