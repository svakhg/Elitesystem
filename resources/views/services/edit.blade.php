@extends('layouts.app')

@section('content')

  <div class="container">

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Shërbimet</strong>
        </div>
        <div class="panel-body">
          <table class="table table-condensed">
            <tr>
              <th>ID</th>
              <th>Shërbimi</th>
              <th>Redakto</th>
            </tr>
            <?php $i = 0; ?>
            @foreach($services as $service)
            <?php $i++; ?>
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $service->name }}</td>
                <td>
                  <a href="{{ route('services.edit',$service->id) }}" class="btn btn-info btn-sm">Redakto</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Redakto Shërbim</strong>
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ route('services.update',$current->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
              <label>Shërbimi</label>
              <input type="text" name="name" class="form-control" value="{{ $current->name }}">
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>
        </div>
      </div>
    </div>
    
  </div>

@endsection