@extends('layouts.app')

@section('content')
	<div class="container">
		{{-- Abonimet --}}
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Abonimet e Fundit</strong>
				</div>
				<div class="panel-body">
					<table class="table table-condensed table-responsive">
						<tr>
							<th>Antari</th>
							<th>Paketa</th>
							<th>Pagesa</th>
							<th>Data e Filleses</th>
							<th>Data e Skadences</th>
							<th>Seanca te mbetura</th>
							<th>Statusi</th>
							<th>Aksioni</th>
						</tr>
							@foreach($subscriptions as $subscription)
							<tr>
								<td>
									@if($subscription->member)
										{{ $subscription->member->first_name }} 
										{{ $subscription->member->last_name }}
									@else
										Deleted	
									@endif
								</td>
								<td>
									{{ $subscription->package->service->name }}
									{{ $subscription->package->cycle->name }}
									@if($subscription->package->time == 1) 
										Paradite
									@endif

									@if($subscription->package->time == 2)
										Mbasdite
									@endif
									
									@if($subscription->package->time == 3)
										Paradite \ Mbasdite
									@endif
									{{ $subscription->package->all_sessions }} (seanca)
									{{ $subscription->package->price }} (lek)
								</td>
								<td>{{ $subscription->payed_price }}</td>
								<td>{{ $subscription->starts_at }}</td>
								<td>{{ $subscription->expires_at }}</td>
								<td>{{ $subscription->sessions_left }}</td>
								<td>
									@if($subscription->status == 1)
										Aktiv
									@else 
										Pasiv
									@endif
								</td>
								<td>
									@if($subscription->status != 1)
										<form method="POST" action="{{ route('subscriptions.destroy',$subscription->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<input type="submit" class="btn btn-sm btn-danger" value="Fshi" onclick="if(!confirm('Je i sigurt ?')) return false;">
										</form>
									@else
										<form method="POST" action="{{ route('subscriptions.update',$subscription->id) }}">
											{{ csrf_field() }}
											{{ method_field('PUT') }}

											<input type="submit" class="btn btn-sm btn-danger" value="Anulo" onclick="if(!confirm('Je i sigurt ?')) return false;">
										</form>
									@endif
								</td>
							</tr>
							@endforeach
					</table>
				</div>
				<div class="panel-footer">
					<a href="#" class="btn btn-primary">
						Shiko te gjitha
					</a>
				</div>
			</div>
		</div>

		{{-- Shto Abonim --}}
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Shto Abonim</strong>
				</div>
				<div class="panel-body">
					<form method="POST" id="add_subscription" action="{{ route('subscriptions.store') }}">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Antari</label>
									<select name="member_id" id="member_id" class="form-control">
										<option></option>
										@foreach($members as $member)
											<option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Pagesa</label> 
									<select class="form-control" name="payment_method">
										<option></option>
										<option value="0">E Plotë</option>
										<option value="1">Me Këste</option>
									</select>
								</div>
							</div><!-- ./col-md-6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Abonimi</label>
									<select class="form-control" name="package_id">
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
								<div class="form-group">
									<label>Data e Filleses</label>
									<input type="date" id="datepicker" name="starts_at" class="form-control">
								</div>
							</div>
						</div>
						<input type="submit" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>	
	</div>

	<!-- Subscribe Js -->
    <script src="{{ asset('js/subscribe.js') }}"></script>

@endsection