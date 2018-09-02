@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Users</strong>
				</div>
				<div class="panel-body">
					<table class="table table-responsive">
						<tr>
							<th>Emri</th>
							<th>Email</th>
							<th>Roli</th>
							<th>Logini i fundit</th>
							<th>Redakto</th>
							<th>Fshi</th>
						</tr>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->first_name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->permissions }}</td>
								<td>{{ $user->last_login }}</td>
								<td><a href="{{ route('users.edit',$user->id) }}" class="btn btn-info btn-sm">Redakto</a></td>
								<td>
									<form method="POST" action="{{ route('users.destroy',$user->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="submit" class="btn btn-danger btn-sm" value="Fshi">
									</form>
								</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Krijo User</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('users.store') }}">
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
							<label>Adresa Email</label>
							<input type="email" name="email" class="form-control">
						</div>
						<div class="form-group">
							<label>Roli</label>
							<select class="form-control" name="permissions">
								<option></option>
								<option value="superuser">Superuser</option>
								<option value="recepsion">Recepsion</option>
								<option value="bar">Bar</option>
							</select>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label>Konfirmo Password</label>
							<input type="password" name="konfirmo_password" class="form-control">
						</div>
						<input type="submit" class="btn btn-primary" value="Submit">
					</form>
				</div>
			</div>
		</div>

	</div>

@endsection