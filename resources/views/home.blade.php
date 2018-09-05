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
                                    <th>Profili</th>
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
                                            <a href="{{ route('members.show',$activity->member->id) }}" class="btn btn-sm btn-warning">Shiko</a>
                                        </td>
                                        <td>
                                            <form method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-sm checkOutBtn"  data-id="{{ $activity->id }}">Check Out</button>
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">
                                <a href="#payed_p" aria-controls="payed_p" role="tab" data-toggle="tab">Të Paguara</a>
                            </li>
                            <li role="presentation" class="active">
						    	<a href="#unpayed_p" aria-controls="unpayed_p" role="tab" data-toggle="tab">Të Mbartura</a>
						    </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="payed_p">
                                <br>
                                <table class="table table-responsive table-condensed">
                                    <tr>
                                        <th>Konsumatori</th>
                                        <th>Produkti</th>
                                        <th>Sasia</th>
                                        <th>Cmimi</th>
                                    </tr>
                                    @foreach($payed_purchases as $purchase)
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
                                        </tr>
                                    @endforeach
                                </table>
                                <a class="btn btn-primary btn-group btn-block" href="{{ route('purchases.index') }}">Shiko te gjitha</a>
                            </div><!-- ./tab-panel  -->

                            <div role="tabpanel" class="tab-pane active" id="unpayed_p">
                                <br>
                                <table class="table table-responsive table-condensed">
                                    <tr>
                                        <th>Konsumatori</th>
                                        <th>Produkti</th>
                                        <th>Sasia</th>
                                        <th>Cmimi</th>
                                        <th>Aksioni</th>
                                    </tr>
                                    @foreach($unpayed_purchases as $purchase)
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
                                            <td>
                                                <form method="POST" action="{{ route('purchases.update',$purchase->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <input type="submit" class="btn btn-sm btn-success" value="Paguaj">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <a class="btn btn-primary btn-group btn-block" href="{{ route('purchases.index') }}">Shiko te gjitha</a>
                            </div><!-- ./tab-panel -->
                        </div><!-- ./tab-content -->
                        
                    </div>
                </div><!-- ./panel -->
            </div>

        </div><!-- ./row -->

    </div><!-- ./container-fluid -->

    <script src="{{ asset('js/activity.js') }}"></script>

@endsection
