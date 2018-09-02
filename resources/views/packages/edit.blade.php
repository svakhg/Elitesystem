@extends('layouts.app')

@section('content')

	<div class="container">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Redakto Paketën</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('packages.update',$package->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="form-group">
							<label>Shërbimi</label>
							<select name="service" class="form-control">
								<option></option>
								@foreach($services as $service)
									<option @if($package->service_id == $service->id) selected @endif value="{{ $service->id }}">{{ $service->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Cikli</label>
							<select name="cycle" class="form-control">
								<option></option>
								@foreach($cycles as $cycle)
									<option value="{{ $cycle->id }}" @if($package->cycle_id == $cycle->id) selected @endif>{{ $cycle->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Seanca Total</label>
							<input type="number" min="1" name="all_sessions" class="form-control" value="{{ $package->all_sessions }}">
						</div>
						<div class="form-group">
							<label>Seanca në javë</label>
							<input type="number" min="1" name="week_sessions" class="form-control" value="{{$package->week_sessions}}">
						</div>
						<div class="form-group">
							<label>Koha e stërvitjes</label>
							<select name="time" class="form-control">
								<option></option>
								<option @if($package->time == 1) selected @endif value="1">Paradite</option>
								<option @if($package->time == 2) selected @endif value="2">Mbasdite</option>
								<option @if($package->time == 3) selected @endif value="3">Paradite\Mbasdite</option>
							</select>
						</div>
						<div class="form-group">
							<label>Cmimi</label>
							<input type="number" name="price" class="form-control" value="{{ $package->price }}">
						</div>
						<input type="submit" value="Submit" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>

	</div>

@endsection