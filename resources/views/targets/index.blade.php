                @if(count($targets) > 0)
                    <div class="well">
                        <h6 id="targetInfo">TARGET: {{ $month_target->target }}</h6>
                    @foreach($targets as $target)
                        <?php 
                            $x = (int)$target->target;
                            $y = (int)$target->accomplished;
                            $p = $y/$x;
                            $percentage_accomplished = $p * 100;
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b><span>{{ $target->user->first_name }} {{ $percentage_accomplished }}%</span></b>
                            </div>
                            <div class="panel-body">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $percentage_accomplished }}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percentage_accomplished}}%;"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- ./well -->
                @else 
                    @if(auth()->user()->is_superuser())
                        <div class="well">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>Percakto Targetin Mujor</strong>
                                </div>
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('addTarget') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="number" name="target" class="form-control">
                                        </div>
                                        <input type="submit" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div><!-- ./well -->    
                    @endif
                @endif