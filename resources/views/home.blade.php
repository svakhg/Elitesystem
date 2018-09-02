@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-3">
                <div class="well">
                    {{-- Mbyll Turnin --}}
                    @if(auth()->user()->is_recepsion())
                        @if($active_turn)
                            <strong>Total: {{ $active_turn->total }} (lek)</strong>
                            <form method="post" action="{{ route('deactivateCurrentTurn') }}" class="pull-right">
                            {{ csrf_field() }}
                                <input type="submit" class="btn btn-success btn-sm" value="Mbyll Turnin">
                            </form>
                            <hr>
                        @endif
                    @endif

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Antarë</strong>
                        </div>
                        <div class="panel-body text-center">
                            <h5>{{ $members_nr }}</h5>
                        </div>
                    </div><!-- ./panel -->

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Abonime Aktive</strong>
                        </div>
                        <div class="panel-body text-center">
                            <h5>{{ $subscriptions_nr }}</h5>
                        </div>
                    </div><!-- ./panel -->

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Paketa</strong>
                        </div>
                        <div class="panel-body text-center">
                            <h5>{{ $packages_nr }}</h5>
                        </div>
                    </div><!-- ./panel -->

                </div><!-- ./well -->

            @include('targets.index')
            
            </div><!-- ./col-md-3 -->

            <div class="col-md-5">
                <div class="panel panel-default" id="activities-panel">
                    <div class="panel-heading">
                        <strong>Aktiviteti</strong>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline">
                            {{ csrf_field() }}
                            <div class="form-group">
                                {{-- <label>Antari</label> --}}
                                <select name="member_id" class="form-control" id="activitySearchMember"></select>
                            </div>
                            <div class="form-group pull-right">
                                <input type="submit" class="btn btn-primary" value="Check In" id="submitActivityForm">
                            </div>
                        </form>

                        <div class="well" id="checked-in-panel">
                            <table class="table table-responsive table-condensed">
                                <tr>
                                    <th>Antari</th>
                                    <th>Checked In</th>
                                    <th>Aksioni</th>
                                </tr>
                                @foreach($activities as $activity)
                                    <tr>
                                        <td>
                                            {{ $activity->member->first_name }}
                                            {{ $activity->member->last_name }}
                                        </td>
                                        <td>{{ $activity->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <form method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-warning btn-sm checkOutBtn"  data-id="{{ $activity->id }}">Check Out</button>
                                            </form>
                                        </td>
                                    </tr>   
                                @endforeach
                            </table>
                        </div><!-- ./well -->
                    </div>
                </div>
            </div><!-- ./col-md-5 -->

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Blerjet e fundit</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive table-condensed">
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
                                            {{ ucfirst($purchase->buyer->first_name) }}
                                            {{ ucfirst($purchase->buyer->last_name) }}
                                        @else
                                            Deleted
                                        @endif    
                                    </td>
                                    <td>
                                        @if($purchase->product)
                                            {{ $purchase->product->name }}
                                        @else
                                            Deleted    
                                        @endif
                                    </td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->price }}</td>
                                    <td>{{ $purchase->status }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <a class="btn btn-primary btn-group btn-block" href="{{ route('purchases.index') }}">Shiko te gjitha</a>
                    </div>
                </div><!-- ./panel -->
            </div>

        </div><!-- ./row -->

    </div><!-- ./container-fluid -->

    <script src="{{ asset('js/activity.js') }}"></script>

@endsection
