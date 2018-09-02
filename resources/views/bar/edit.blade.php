@extends('layouts.app')

@section('content')

	<div class="container">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Redakto Produktin</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('bar.update',$product->id) }}">
			        	{{ csrf_field() }}
			        	{{ method_field('PUT') }}
			        	<div class="form-group">
			        		<label>Produkti</label>
			        		<input type="text" name="name" class="form-control" value="{{ $product->name }}">
			        	</div>
			        	<div class="form-group">
			        		<label>Sasia</label>
			        		<input type="number" name="qty" class="form-control" value="{{ $product->init }}">
			        	</div>
			        	<div class="form-group">
			        		<label>Cmimi</label>
			        		<input type="number" name="price" class="form-control" value="{{ $product->price }}">
			        	</div>
			        	<div class="form-group">
			        		<label>I Numurueshem ?</label>
			        		<select name="countable" class="form-control">
			        			<option></option>
			        			<option value="1" @if($product->countable == '1') selected @endif>Po</option>
			        			<option value="2" @if($product->countable == '1') selected @endif>Jo</option>
			        		</select>
			        	</div>
			        	<input type="submit" class="btn btn-primary">
	        		</form>
				</div>
			</div>
		</div>

	</div>

@endsection