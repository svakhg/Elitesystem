@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Redakto Antarin</strong>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('members.update',$member->id) }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<div class="form-group">
							<label>Emri</label>
							<input type="text" name="first_name" class="form-control" value="{{ $member->first_name }}">
						</div>
						<div class="form-group">
							<label>Mbiemri</label>
							<input type="text" name="last_name" class="form-control" value="{{ $member->last_name }}">
						</div>
						<div class="form-group">
							<label>Gjinia</label>
							<select name="gender" class="form-control">
								<option></option>
								<option value="m" @if($member->gender == 'm') selected @endif>Mashkull</option>
								<option value="f" @if($member->gender == 'f') selected @endif>Femer</option>
							</select>
						</div>
						<div class="form-group">
							<label>Adresa Email</label>
							<input type="email" name="email" class="form-control" value="{{ $member->email }}">
						</div>
						<div class="form-group">
							<label>Nr.Tel</label>
							<input type="number" name="phone" class="form-control" value="{{ $member->phone }}">
						</div>
						<input type="submit" class="btn btn-primary">
					</form>
				</div>
			</div>

		</div>

	</div>

@endsection