@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		{{-- Produktet --}}
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Produktet</strong>
					@if(auth()->user()->is_superuser())
						<a href="#" class="pull-right btn btn-success btn-sm" style="margin-top:-3.5px;" data-toggle="modal" data-target="#add-product-modal">Shto Produkt</a>
					@endif
				</div>
				<div class="panel-body">
					<table class="table table-condensed table-resposnive">
						<tr>
							<th>Produkti</th>
							<th>Gjendje</th>
							<th>Cmimi</th>
							@if(auth()->user()->is_superuser())
								<th>Redakto</th>
								<th>Fshi</th>
							@endif
						</tr>
						@foreach($products as $product)
							<tr>
								<td>{{ ucfirst($product->name) }}</td>
								<td>{{ $product->actual }}</td>
								<td>{{ $product->price }}</td>
								@if(auth()->user()->is_superuser())
									<td>
										<a href="{{ route('bar.edit',$product->id) }}" class="btn btn-sm btn-info">Redakto</a>
									</td>
									<td>
										<form method="POST" action="{{ route('bar.destroy',$product->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<input type="submit" class="btn btn-sm btn-danger" value="Fshi">
										</form>
									</td>
								@endif
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		{{-- Shto Blerje --}}
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Shto Blerje</strong>
				</div>
				<div class="panel-body">

				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active">
				    	<a href="#member" aria-controls="member" role="tab" data-toggle="tab" onclick="resetUserBuyForm();">Antarët</a>
				    </li>
				    <li role="presentation">
				    	<a href="#staff" aria-controls="staff" role="tab" data-toggle="tab" onclick="resetMemberBuyForm();">Stafi</a>
				    </li>
				  </ul>

				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="member">
				    	<br>
				    	<form method="POST" action="{{ route('purchases.store') }}" id="member-buy-form">
				    		{{ csrf_field() }}
							<div class="form-group">
								<label>Konsumatori</label>
								<select class="form-control" name="buyer_id" id="buyer_select">
									<option></option>
									@foreach($members as $member)
										<option value="{{ $member->id }}">
											{{ ucfirst($member->first_name) }} 
											{{ ucfirst($member->last_name) }}
										</option>
									@endforeach
								</select>
							</div>
							<input type="hidden" name="buyer_type" value="member">
							<div class="form-group">
								<label>Produkti</label>
								<select class="form-control" name="product_id" id="member_product" oninput="callGetPriceByIdFunction(this,'member');">
									<option></option>
									@foreach($products as $product)
										<option value="{{ $product->id }}">{{ $product->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Sasia</label>
								<input type="number" class="form-control" name="quantity" id="member_quantity" min="1">
							</div>
							<div class="form-group">
								<label>Cmimi</label>
								<input type="text" class="form-control" name="price" id="member_price" readonly>
							</div>
							<div class="form-group">
								<label>U Pagua ?</label>
								<select class="form-control" name="status">
									<option></option>
									<option value="paguar">Po</option>
									<option value="papaguar">Jo</option>
								</select>
							</div>
							<input type="submit" class="btn btn-primary">
						</form>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="staff">
				    	<br>
				    	<form method="POST" action="{{ route('purchases.store') }}" id="user-buy-form">
				    		{{ csrf_field() }}
							<div class="form-group">
								<label>Konsumatori</label>
								<select class="form-control" name="buyer_id">
									<option></option>
									@foreach($users as $user)
										<option value="{{ $user->id }}">{{ ucfirst($user->first_name) }} {{ $user->last_name }}</option>
									@endforeach
								</select>
							</div>
							<input type="hidden" name="buyer_type" value="user">
							<div class="form-group">
								<label>Produkti</label>
								<select class="form-control" name="product_id" id="user_product" onblur="callGetPriceByIdFunction(this,'user');">
									<option></option>
									@foreach($products as $product)
										<option value="{{ $product->id }}">{{ $product->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Sasia</label>
								<input type="number" class="form-control" name="quantity" id="user_quantity" min="1">
							</div>
							<div class="form-group">
								<label>
									Cmimi <sup>-25%</sup>
								</label>
								<input type="text" class="form-control" name="price" id="user_price" readonly>
							</div>
							<div class="form-group">
								<label>U Pagua ?</label>
								<select class="form-control" name="status">
									<option></option>
									<option value="paguar">Po</option>
									<option value="papaguar">Jo</option>
								</select>
							</div>
							<input type="submit" class="btn btn-primary">
						</form>
				    </div>
				  </div>

				</div>
			</div>
		</div>

		{{-- Blerjet e fundit --}}
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Blerjet e Fundit</strong>	
				</div>
				<div class="panel-body">
					<table class="table table-resposnive table-condensed">
						<tr>
							<th>Konsumatori</th>
							<th>Produkti</th>
							<th>Sasia</th>
							<th>Cmimi</th>
							<th>Statusi</th>
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
							</tr>
						@endforeach
					</table>
				</div>	
				<div class="panel-footer">
					<a href="{{ route('purchases.index') }}" class="btn btn-block btn-primary">Shiko të gjitha</a>
				</div>
			</div>
		</div>

	</div>

	{{-- Shto Prdoukt Modal --}}
	<div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Shto Produkt</h4>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="{{ route('bar.store') }}">
	        	{{ csrf_field() }}
	        	<div class="form-group">
	        		<label>Produkti</label>
	        		<input type="text" name="name" class="form-control">
	        	</div>
	        	<div class="form-group">
	        		<label>Sasia</label>
	        		<input type="number" name="qty" class="form-control">
	        	</div>
	        	<div class="form-group">
	        		<label>Cmimi</label>
	        		<input type="number" name="price" class="form-control">
	        	</div>
	        	<div class="form-group">
	        		<label>I Numurueshem ?</label>
	        		<select name="countable" class="form-control">
	        			<option></option>
	        			<option value="1">Po</option>
	        			<option value="2">Jo</option>
	        		</select>
	        	</div>
	        	<input type="submit" class="btn btn-primary">
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Bar Js -->
    <script src="{{ asset('js/bar.js') }}"></script>

@endsection