@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Të gjitha blerjet</strong>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-condensed">
						<tr>
							<th>Konsumatori</th>
							<th>Produkti</th>
							<th>Sasia</th>
							<th>Cmimi</th>
							<th>Statusi</th>
							<th>Aksioni</th>
							<th>Blerja</th>
							<th>Anulo</th>
						</tr>
						@foreach($purchases as $purchase)
							<tr>
								<td>
									@if($purchase->buyer)
										{{ $purchase->buyer->first_name }}
										{{ $purchase->buyer->last_name }}
									@else
										Deleted
									@endif	
								</td>
								<td>{{ $purchase->product->name }}</td>
								<td>{{ $purchase->quantity }}</td>
								<td>{{ $purchase->price }}</td>
								<td>{{ $purchase->status }}</td>
								<td>
									@if($purchase->status == 'papaguar')
										<form method="POST" action="{{ route('purchases.update',$purchase->id) }}">
											{{ csrf_field() }}
											{{ method_field('PUT') }}
											<input type="submit" class="btn btn-sm btn-success" value="Paguaj">
										</form>
									@else
										<button class="btn btn-success btn-sm" disabled>Paguaj</button>
									@endif
								</td>
								<td>{{ $purchase->created_at->diffForHumans() }}</td>
								<td>
									<form method="POST" action="{{ route('purchases.destroy',$purchase->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="submit" class="btn btn-danger btn-sm" value="Anulo" onclick="if(!confirm('Je i sigurt që dëshiron ta anulosh blerjen ?')) return false;">
									</form>
								</td>
							</tr>
						@endforeach
					</table>
				</div>
				<div class="panel-footer">
					{{ $purchases->links() }}
				</div>
			</div>	
		</div>
	</div>

@endsection