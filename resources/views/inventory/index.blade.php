@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Produktet</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-responsive">
                            <tr>
                                <th>Produkti</th>
                                <th>Cmimi</th>
                                <th>Gjendje</th>
                                <th>Redakto</th>
                                <th>Fshi</th>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->actual}}</td>
                                    <td><a href="{{ route('bar.edit',$product->id) }}" class="btn btn-info btn-sm">Redakto</a></td>
                                    <td>
                                        <form method="POST" action="{{ route('bar.destroy',$product->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" class="btn btn-danger btn-sm" value="Fshi" onclick="if(!confirm('Je i sigurt ?')) return false;">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <span>{{ $products->links() }}</span>
                    </div>
                </div><!-- ./panel -->
            </div><!-- ./col-md-4 -->

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Shto Produkt</strong>
                    </div>
                    <div class="panel-body">
                        <div class="tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#countable" aria-controls="countable" role="tab" data-toggle="tab">Të numurueshëm</a>
                                </li>
                                <li role="presentation">
                                    <a href="#uncountable" aria-controls="uncountable" role="tab" data-toggle="tab">Të panumurueshëm</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="countable">
                                <br>
                                    <form method="POST" action="{{ route('bar.store') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Produkti</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Cmimi</label>
                                            <input type="text" name="price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Sasia</label>
                                            <input type="number" name="quantity" class="form-control">
                                        </div>
                                        <input type="hidden" name="countable" value="1">
                                        <input type="submit" class="btn btn-primary">
                                    </form>
                                </div><!-- ./tabpanel -->
                                <div role="tabpanel" class="tab-pane" id="uncountable">
                                    <br>
                                    <form method="POST" action="{{ route('bar.store') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Produkti</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Cmimi</label>
                                            <input type="text" name="price" class="form-control">
                                        </div>
                                        <input type="hidden" name="countable" value="0">
                                        <input type="submit" class="btn btn-primary">
                                    </form>
                                </div><!-- ./tabpanel -->
                            </div><!-- ./tab-content -->
                        </div><!-- ./tabs -->
                    </div><!-- ./panel-body -->
                </div><!-- ./panel -->    
            </div><!-- ./col-md-4 -->

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Shto Furnizim</strong>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('addSuply') }}">
                            {{ csrf_field() }}
                            <div class="form-group">    
                                <label>Produkti</label>
                                <select class="form-control" name="product_id">
                                    <option value="0">-- ZGJID PRODUKTIN --</option>
                                    @foreach ($countable_products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sasia</label>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kosto (lek)</label>
                                <input type="number" name="waste" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div><!-- ./panel-body -->
                </div><!-- ./panel -->
            </div><!-- ./col-md-4 -->
        
        </div><!-- ./row -->

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Peshqirat</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive table-condensed">
                            <tr>
                                <th>Nr</th>
                                <th>Pronari</th>
                                <th>U Krijua</th>
                                <th>Aksioni</th>
                            </tr>
                            @foreach($towels as $towel)
                                <tr>
                                    <td>{{ $towel->nr }}</td>
                                    <td>
                                        @if($towel->member === null) 
                                            <span class="null">NULL</span>
                                        @else 
                                            <a href="{{ route('members.show',$towel->member->id) }}">
                                                {{ ucfirst($towel->member->first_name) }}
                                                {{ ucfirst($towel->member->last_name) }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $towel->created_at }}</td>
                                    <td>
                                        @if($towel->active == 1)
                                            @if($towel->member === null)
                                                <a class="btn btn-danger btn-sm">Caktivizo</a>
                                            @else 
                                                    <a class="btn btn-danger btn-sm" disabled>Caktivizo</a>
                                            @endif                                            
                                        @else 
                                            <a class="btn btn-success btn-sm">Aktivizo</a>
                                        @endif    
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div><!-- ./col-md-4 -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Shto Peshqir</strong>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('addTowel') }}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label>Nr I Peshqirit</label>
                                <input type="number" id="towelNumber" name="nr" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div><!-- ./panel-body -->
                </div><!-- ./panel -->
            </div><!-- ./col-md-4 -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Furnizimet</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-responsive">
                            <tr>
                                <th>Produkti</th>
                                <th>Sasia</th>
                                <th>Kosto (lek)</th>
                                <th>Fshi</th>
                            </tr>
                            @foreach ($supplies as $supply)
                                <tr>
                                    <td>{{ $supply->product }}</td>
                                    <td>{{ $supply->quantity }}</td>
                                    <td>{{ $supply->waste }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('deleteSupply',$supply->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" class="btn btn-sm btn-danger" value="Fshi" onclick="if(!confirm('Je i sigurt')) return false;">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div><!-- ./panel-body -->
                </div><!-- ./panel -->
            </div><!-- ./col-md-4 -->
        </div><!-- ./row -->

    </div>
@endsection