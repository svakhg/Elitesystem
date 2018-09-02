@extends('layouts.app')
	
@section('content')

	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Redakto User</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('users.update',$user->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="form-group">
							<label>Emri</label>
							<input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
						</div>
						<div class="form-group">
							<label>Mbiemri</label>
							<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
						</div>
						<div class="form-group">
							<label>Adresa Email</label>
							<input type="email" name="email" class="form-control" value="{{ $user->email }}">
						</div>
						<div class="form-group">
							<label>Roli</label>
							<select class="form-control" name="permissions">
								<option></option>
								<option value="superuser" @if($user->permissions == 'superuser') selected @endif>Superuser</option>
								<option value="recepsion" @if($user->permissions == 'recepsion') selected @endif>Recepsion</option>
								<option value="bar" @if($user->permissions == 'bar') selected @endif>Bar</option>
							</select>
						</div>
						<input type="submit" class="btn btn-primary" value="Submit">
					</form>
				</div>
			</div>
		</div>	

	</div>	

@endsection