@extends('layouts.app')

@section('content')

    <h1 class="text-center">{{ $product->product_name }}</h1>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="/AdeoWebUzduotis/AdeoWeb/storage/app/public/cover_images/{{ $product->cover_image }}"
                     id="cover" alt="CoverImage">
            </div>
            <div class="col-md-6">
                <h4>Description</h4><br/>
                <p style="text-align:justify">{{$product->description}}</p>
                <hr/>
                <h4>SKU: {{$product->sku}}</h4>
                <hr/>
                @php
                    if ($kintamieji[0]->mokesciotagas !== 1){
                    $mokestis = 0;
                    }
                    else {
                     $mokestis = $kintamieji[0]->mokestis;
                    }
                    if ($kintamieji[0]->indnuolaidostagas !== 1) {

                        $individualinuolaida = 0;
                    }
                     else {
                    $individualinuolaida =  $product->special_price;
                    }
                     if ($kintamieji[0]->globalnuolaidostagas !== 1) {

                        $globalnuolaida = 0;
                    }
                     else {
                    $globalnuolaida =  $kintamieji[0]->nuolaida;
                    }
                    if ($individualinuolaida > 1)
                    {
                    $globalnuolaida = 0;
                    }
                            $ProduktasSuMokesciais = $product->base_price * $mokestis/100 + $product->base_price;
                            $KainaSuNuolaida = $ProduktasSuMokesciais * (100 - ($individualinuolaida + $globalnuolaida))/100 ;
                @endphp
                @if($kintamieji[0]->nuolaida != null)

                    <h4><strike>Base Price - €{{ $ProduktasSuMokesciais }}</strike></h4><br/>
                    <h4>Special Price - €{{$KainaSuNuolaida}}</h4><br/>
                @else
                    <h4>Base Price - €{{ $ProduktasSuMokesciais}}</h4><br/>
                @endif
            </div>
        </div>

        <br/>
        <hr/>
        <p>Pridėti Komentarą</p>
        <form method="post" action="{{ route('reviews.store', $product->id) }}">

            <div class="form-group">
                @csrf
                <label for="name">Jūsų vardas:</label>
                <input type="text" class="form-control" name="name"/>
            </div>
            <div class="form-group">
                <label for="comment">Komentaras :</label>
                <input type="text" class="form-control" name="comment"/>
            </div>
            <div class="form-group">
                <label for="rating">Įvertinimas:</label>
                <input type="text" class="form-control" name="rating"/>
            </div>
            <button class="btn btn-danger" type="submit">Pridėti Komentarą</button>
        </form>


        <hr/>

        <p> {{count($product->reviews) }} Komentarai</p>

        <div class="row">
            @if(count($product->reviews) > 0)
                @foreach($product->reviews as $review)
                    <div class="col-md-12">
                        <h5>{{ $review->name }}
                            <small>{{ $review->created_at }}</small>
                        </h5>
                        <p>{{ $review->comment }}</p>
                        @php $rating = $review->rating; @endphp

                        @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                    <i class="far fa-star fa-stack-1x"></i>

                                @if($rating >0)
                                    @if($rating >0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                </span>
                        @endforeach
                        <br/>
                    </div>
                @endforeach
            @else
                <p>Komentarų nera</p>
            @endif
        </div>


    </div>




@endsection