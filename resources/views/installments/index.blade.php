@extends('layouts.app')

@section('content')

	<div class="container">
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Shto Arkëtim</strong>
				</div>
				<div class="panel-body">
					<form id="addRecievmentForm">
						<div class="form-group">
							<label>Antari</label>
							<select class="form-control" id="member_installment">
								<option></option>
								@foreach($installments as $installment)
									@if($installment->subscription->member)
										@if($installment->subscription->member->is_debtor() && $installment->subscription->payed_price == 'installment')
										<option value="{{ $installment->subscription->member->id }}">
											{{ $installment->subscription->member->first_name }} 
											{{ $installment->subscription->member->last_name }}
											{{ $installment->subscription->package->service->name }}
											{{ $installment->subscription->package->cycle->name }}
											@if($installment->subscription->status == 1) 
												(Aktiv)
											@else 
												(Pasiv)
											@endif	
										</option>
										@endif
									@endif
								@endforeach
							</select>
						</div>

						{{-- Subscription --}}
						<input type="hidden" name="subscription_id" id="subscription_id">

						<div class="form-group">
							<label>Borxhi</label>
							<input type="disabled" class="form-control" id="debt">
						</div>
						<div class="form-group">
							<label>Arkëto (lek)</label>
							<input type="number" name="installment" id="sum" class="form-control">
						</div>
						<input type="submit" class="btn btn-primary" id="submitFormBtn">
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Abonimet me keste</strong>
				</div>
				<div class="panel-body">
					<table class="table table-condensed table-responsive">
						<tr>		
							<th>Antari</th>
							<th>Abonimi</th>
							<th>Cmimi</th>
							<th>Paguar</th>
							<th>Borxhi</th>	
						</tr>	
						@foreach ($paginateInstallments as $installment)
							<tr>
								<td>
									@if($installment->subscription->member)
										{{ $installment->subscription->member->first_name }}
										{{ $installment->subscription->member->last_name }}
									@else 
										Deleted
									@endif
								</td>
								<td>
									{{ $installment->subscription->package->service->name }}
									{{ $installment->subscription->package->cycle->name }}

									@if($installment->subscription->package->time == 1)
										Paradite
									@endif

									@if($installment->subscription->package->time == 2)
										Mbasdite
									@endif

									@if($installment->subscription->package->time == 3)
										Paradite\Mbasdite
									@endif
									
								</td>
								<td>
									{{ $installment->price }}
								</td>
								<td>
									{{ $installment->payed }}
								</td>
								<td>
									{{ $installment->price - $installment->payed }}
								</td>
							</tr>
						@endforeach
					</table>
				</div>
				@if(count($paginateInstallments) > 10)
					<div class="panel-footer">
						{{ $paginateInstallments->links() }}
					</div>
				@endif
			</div>
		</div>	

	</div>

	<script src="{{ asset('js/installment.js') }}"></script>

@endsection