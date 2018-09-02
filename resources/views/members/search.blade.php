@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h3 class="text-center">Rezultatet e Kërkimit</h3>

        <div class="row">

            @foreach($members as $member)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                    @if($member->photo == null || $member->photo == '')
                        <img class="img img-responsive avatar-img" src="{{ asset('storage/member.png') }}">
                    @else
                        <img class="img img-responsive avatar-img" src="{{ asset('storage/photos/'.$member->photo) }}" >
                    @endif
                        {{-- <img src="" alt="{{ $member->first_name }}"> --}}
                        <div class="caption">
                            <h4>{{ $member->first_name }} {{ $member->last_name }}</h4>
                            <a href="{{ route('members.show',$member->id) }}" class="btn btn-warning" role="button">Shiko Profilin</a> 
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection