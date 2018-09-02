@extends('layouts.app')

@section('content')
	<div class="container">
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Ciklet</strong>
				</div>
				<div class="panel-body">
					<table class="table table-condensed table-responsive">
						<tr>
							<th>ID</th>
							<th>Cikli</th>
							<th>Muaj</th>
							<th>Redakto</th>
						</tr>
						<?php $i = 0; ?>
						@foreach($cycles as $cycle)
						<?php $i++; ?>
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $cycle->name }}</td>
								<td>{{ $cycle->months }}</td>
								<td>
									<a href="{{ route('cycles.edit',$cycle->id) }}" class="btn btn-sm btn-info">Redakto</a>
								</td>
								{{-- <td>
									<form method="POST" action="{{ route('cycles.destroy',$cycle->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="submit" class="btn btn-xs btn-danger" value="Fshi">
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
					<strong>Redakto Ciklin</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('cycles.update',$cycle->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="form-group">
							<label>Cikli</label>
							<input type="text" name="name" class="form-control" value="{{ $current->name }}">
						</div>
						<div class="form-group">
							<label>Muaj</label>
							<input type="number" name="months" class="form-control" value="{{ $current->months }}">
						</div>
						<input type="submit" class="btn btn-primary" value="Submit">
					</form>
				</div>
			</div>
		</div>

	</div>
@endsection