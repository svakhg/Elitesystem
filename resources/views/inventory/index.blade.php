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
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div><!-- ./panel-body -->
                </div><!-- ./panel -->
            </div><!-- ./col-md-4 -->
        
        </div><!-- ./row -->

    </div>
@endsection