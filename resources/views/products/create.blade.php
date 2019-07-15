@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-4">


            <div class="card uper">
                <div class="card-header">
                    Sukurti produktą
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                    @endif

                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">

                        <div class="form-group">
                            @csrf
                            <label for="product_name">Produkto pavadinimas :</label>
                            <input type="text" class="form-control" name="product_name"/>
                        </div>
                        <div class="form-group">
                            <label for="sku">SKU :</label>
                            <input type="text" class="form-control" name="sku"/>
                        </div>
                        <div class="form-group">
                            <label for="status">Status: 1 enabled, 0 disabled</label>
                            <input type="text" class="form-control" name="status"/>
                        </div>
                        <div class="form-group">
                            <label for="base_price">base_price :</label>
                            <input type="text" class="form-control" name="base_price"/>
                        </div>
                        <div class="form-group">
                            <label for="special_price">Individuali nuolaida :</label>
                            <input type="text" class="form-control" name="special_price"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Aprašymas :</label>
                            <input type="text" class="form-control" name="description"/>
                        </div>
                        <div class="form-group">
                            <label for="cover_image">Paveiksliukas :</label>
                            <input type="file" class="form-control" name="cover_image"/>
                        </div>
                        <button type="submit" class="btn btn-primary">PRIDĖTI</button>
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div><br/>
                        @endif
                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection