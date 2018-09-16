@extends('layouts.app')

@section('content')

	<div class="container-fluid">

		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>
						Antarët
					</strong>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-condensed">
						<tr>
							<th>Emri</th>
							<th>Mbiemri</th>
							<th>Gjinia</th>
							<th>Profili</th>
							@if(auth()->user()->is_superuser())
								<th>Redakto</th>
								<th>Fshi</th>
							@endif
						</tr>
						@foreach($members as $member)
							<tr>
								<td>{{ ucfirst($member->first_name) }}</td>
								<td>{{ ucfirst($member->last_name) }}</td>
								<td>
									@if($member->gender == 'm' || $member->gender == 'M')
										Mashkull
									@else
										Femër
									@endif
								</td>
								<td>
									<a href="{{ route('members.show',$member->id) }}" class="btn btn-warning btn-sm">Shiko</a>
								</td>
								@if(auth()->user()->is_superuser())
									<th>
										<a href="{{ route('members.edit',$member->id) }}" class="btn btn-info btn-sm">Redakto</a>
									</th>
									<th>
										<form method="POST" action="{{ route('members.destroy',$member->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<input type="submit" class="btn btn-danger btn-sm" value="Fshi">
										</form>
									</th>
								@endif
							</tr>
						@endforeach
					</table>
				</div>
				@if(count($members) > 10)
					<div class="panel-footer">
						{{ $members->links() }}
					</div>
				@endif
			</div>
		</div>

		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Shto Antar</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Emri</label>
							<input type="text" name="first_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Mbiemri</label>
							<input type="text" name="last_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Gjinia</label>
							<select name="gender" class="form-control">
								<option></option>
								<option value="m">Mashkull</option>
								<option value="f">Femer</option>
							</select>
						</div>
						<div class="form-group">
							<label>Adresa Email</label>
							<input type="email" name="email" class="form-control">
						</div>
						<div class="form-group">
							<label>Nr.Tel</label>
							<input type="number" name="phone" class="form-control">
						</div>
						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="photo" class="form-control">
						</div>
						<div class="form-group">
							<label>Abonimi</label>
							<select name="package_id" class="form-control">
								<option></option>
									@foreach($packages as $package)
										<option value="{{ $package->id }}">
											{{ $package->service->name }} 
											{{ $package->cycle->name }} 

											@if($package->time == 1) 
												Paradite
											@endif

											@if($package->time == 2)
												Mbasdite
											@endif
											
											@if($package->time == 3)
												Paradite \ Mbasdite
											@endif
											{{ $package->all_sessions }} (seanca)
											{{ $package->price }} (lek)
										</option>
									@endforeach
							</select>
						</div>
						@if(auth()->user()->is_superuser())
							<div class="form-group">
								<label>Pagesa</label> 
								<select class="form-control" name="payment_method">
									<option></option>
									<option value="0">E Plotë</option>
									<option value="1">Me Këste</option>
								</select>
							</div>
						@else
							<input type="hidden" name="payment_method" value="0">
						@endif
						<div class="form-group">
							<label>Data e Filleses</label>
							<input type="date" id="datepicker" name="starts_at" class="form-control">
						</div>
						<input type="submit" class="btn btn-primary">
					</form>
				</div>
			</div>

		</div>

	</div>

@endsection