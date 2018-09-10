@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="col-md-3">
			@if($member->photo == null || $member->photo == '')
				<img class="img img-responsive img-thumbnail avatar-img" src="{{ asset('storage/member.png') }}">
			@else
				<img class="img img-responsive img-thumbnail avatar-img" src="{{ asset('storage/photos/'.$member->photo) }}">
			@endif
		</div>
		<div class="col-md-9">
			<div class="well">
				<strong>Profili</strong><hr>
				<div class="row">
					<div class="col-md-7">

						<ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active">
						    	<a href="#payed" aria-controls="payed" role="tab" data-toggle="tab">Të Paguara</a>
						    </li>
						    <li role="presentation">
						    	<a href="#unpayed" aria-controls="unpayed" role="tab" data-toggle="tab">Të Mbartura</a>
						    </li>
					  	</ul>

					  <div class="tab-content">

					    <div role="tabpanel" class="tab-pane active" id="payed">
					    	<br>
					    	<table class="table table-responsive table-condensed">
					    		<tr>
					    			<th>Produkti</th>
					    			<th>Sasia</th>
					    			<th>Cmimi</th>
					    			<th>U Ble</th>
					    		</tr>
					    		@foreach($member->payed_purchases as $purchase)
									@if($purchase)
										<tr>
											@if($purchase->product)
												<td>{{ $purchase->product->name }}</td>
											@else 
												<td>Deleted</td>
											@endif
											<td>{{ $purchase->quantity }}</td>
											<td>{{ $purchase->price }}</td>
											<td>{{ $purchase->created_at->diffForHumans() }}</td>
										</tr>
									@endif
					    		@endforeach
					    	</table>
					    </div>	


					    <div role="tabpanel" class="tab-pane" id="unpayed">
					    	<br>
					    	<table class="table table-responsive table-condensed">
					    		<tr>
					    			<th>Produkti</th>
					    			<th>Sasia</th>
					    			<th>Cmimi</th>
					    			<th>U Ble</th>
					    		</tr>
					    		<?php $total = 0; ?>
					    		@foreach($member->unpayed_purchases as $purchase)
									@if($purchase)
										<?php $total += $purchase->price;  ?>
										<tr>
											@if($purchase->product)
												<td>{{ $purchase->product->name }}</td>
											@else 
												<td>Deleted</td>
											@endif
											<td>{{ $purchase->quantity }}</td>
											<td>{{ $purchase->price }}</td>
											<td>{{ $purchase->created_at->diffForHumans() }}</td>
										</tr>
									@endif
					    		@endforeach
					    	</table>
					    	<strong>Borxhi: {{ $total }}</strong>
							@if($total > 0)
								@if($member->unpayed_purchases)
									<button class="btn btn-success btn-sm pull-right" id="payDebtsBtn" data-user="{{ $member->id }}" data-total="{{ $total }}">
										Paguaj Borxhet
									</button>
								@endif
							@endif
					    </div>

					  </div>

					</div>
					<div class="col-md-5">

						<p>Emri Mbiemri : {{ $member->first_name }} {{ $member->last_name }}</p>
						<p>Gjinia: @if($member->gender == 'm') Mashkull @else Femër @endif</p>
						
						@if($member->email !== null)
							<p>Email:  {{ $member->email }}</p>
						@endif

						@if($member->phone !== null)
							<p>Nr.Tel: {{ $member->phone }}</p>
						@endif

						<p>Regjistrimi: {{ $member->created_at->diffForHumans() }}</p>
	
						<p>	
							@if($member->subscription)
								Abonimi:
								{{ $member->subscription->package->service->name }}
								{{ $member->subscription->package->cycle->name }}
								@if($member->subscription->package->time == 1)
									Paradite
								@endif

								@if($member->subscription->package->time == 1)
									Mbasdite
								@endif

								@if($member->subscription->package->time == 1)
									Paradite \ Mbasdite
								@endif

								{{ $member->subscription->package->all_sessions }} (seanca)

								{{ $member->subscription->package->price }} (lek)

							@endif
						</p>

						@if($member->subscription)
							<p>
								
								Pagesa: 
									@if($member->subscription->payed_price == 'payed')
										E Plote 
									@else 
										Me Keste
									@endif	
							</p>

							@if($member->subscription->installment)
								<p>
									Borxhi (lek): 
									{{ $member->subscription->installment->price - $member->subscription->installment->payed }}
								</p>
							@endif

						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$('#payDebtsBtn').on('click',function(e){
    		var user_id = $(this).data('user');
			var total = $(this).data('total');

			$.post('/payDebt/'+user_id, {
				'_token': $('input[name=_token]').val(),
				'total': total
			}, function(data) {
				location.reload();
			});
		});
	</script>
@endsection