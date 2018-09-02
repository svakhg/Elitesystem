@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Paketat</strong>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-condensed">
						<tr>
							<th>Sherbimi</th>
							<th>Cikli</th>
							<th>Seanca Total</th>
							<th>Seanca Jave</th>
							<th>Koha</th>
							<th>Cmimi</th>
							<th>Redakto</th>
							{{-- <th>Fshi</th> --}}
						</tr>
						@foreach($packages as $package)
							<tr>
								<td>{{ ucfirst($package->service->name) }}</td>
								<td>{{ ucfirst($package->cycle->name) }}</td>
								<td>{{ $package->all_sessions }}</td>
								<td>{{ $package->week_sessions }}</td>
								<td>
									@if($package->time == 1)
										Paradite
									@endif

									@if($package->time == 2)
										Mbasdite
									@endif

									@if($package->time == 3)
										Paradite\Mbasdite
									@endif
								</td>
								<td>{{ $package->price }}</td>
								<td>
									<a href="{{ route('packages.edit',$package->id) }}" class="btn btn-sm btn-info">Redakto</a>
								</td>
								{{-- <td>
									<form method="POST" action="{{ route('packages.destroy',$package->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="submit" class="btn btn-xs btn-danger" value="Fshi">
									</form>
								</td> --}}
							</tr>
						@endforeach
					</table>
				</div>
				<div class="panel-footer">
					{{ $packages->links() }}
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Krijo Paketë</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('packages.store') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Shërbimi</label>
							<select name="service" class="form-control">
								<option></option>
								@foreach($services as $service)
									<option value="{{ $service->id }}">{{ $service->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Cikli</label>
							<select name="cycle" class="form-control">
								<option></option>
								@foreach($cycles as $cycle)
									<option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Seanca Total</label>
							<input type="number" min="1" name="all_sessions" class="form-control">
						</div>
						<div class="form-group">
							<label>Seanca në javë</label>
							<input type="number" min="1" name="week_sessions" class="form-control">
						</div>
						<div class="form-group">
							<label>Koha e stërvitjes</label>
							<select name="time" class="form-control">
								<option></option>
								<option value="1">Paradite</option>
								<option value="2">Mbasdite</option>
								<option value="3">Paradite\Mbasdite</option>
							</select>
						</div>
						<div class="form-group">
							<label>Cmimi</label>
							<input type="number" name="price" class="form-control">
						</div>
						<input type="submit" value="Submit" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>

	</div>

@endsection