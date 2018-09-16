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
							@if(auth()->user()->is_superuser())
								<th>Aksioni</th>
							@endif
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
								@if(auth()->user()->is_superuser())
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
								@endif
								</td>
							</tr>
							@endforeach
					</table>
				</div>
				<div class="panel-footer">
					{{ $subscriptions->links() }}
				</div>
			</div>
		</div>

	</div>

	<!-- Subscribe Js -->
    <script src="{{ asset('js/subscribe.js') }}"></script>

@endsection