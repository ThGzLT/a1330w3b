@extends('layouts.app')

@section('content')

    <div class="card uper">
        <div class="card-header">
            Redaguoti produktą
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
            <form method="post" action="{{ route('products.update', $produktas->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="product_name">Produkto pavadinimas:</label>
                    <input type="text" class="form-control" name="product_name" value={{ $produktas->product_name }} />
                </div>
                <div class="form-group">
                    <label for="sku">Sku :</label>
                    <input type="text" class="form-control" name="sku" value={{ $produktas->sku }} />
                </div>
                <div class="form-group">
                    <label for="status">Status: 1 enabled, 0 disabled:</label>
                    <input type="text" class="form-control" name="status" value={{ $produktas->status }} />
                </div>
                <div class="form-group">
                    <label for="base_price">Base_price:</label>
                    <input type="text" class="form-control" name="base_price" value={{ $produktas->base_price }} />
                </div>
                <div class="form-group">
                    <label for="special_price">Individuali nuolaida :</label>
                    <input type="text" class="form-control" name="special_price"
                           value={{ $produktas->special_price }} />
                </div>
                <div class="form-group">
                    <label for="description">Aprašymas:</label>
                    <input type="text" class="form-control" name="description" value={{ $produktas->description }} />
                </div>

                <div class="form-group">
                    <label for="cover_image">Paveiksliukas:</label>
                    <input type="file" class="form-control" name="cover_image"
                           value="/AdeoWebUzduotis/AdeoWeb/storage/app/public/cover_images/"{{ $produktas->cover_image }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@endsection