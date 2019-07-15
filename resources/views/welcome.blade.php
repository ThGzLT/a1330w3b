@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>pavadinimas</th>
                    <th>sku</th>
                    <th>kaina</th>
                    <th>aprašymas</th>
                    <th>paveiksliukas</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($produktai as $produktas)
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
                        $individualinuolaida =  $produktas->special_price;
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
                                $ProduktasSuMokesciais = $produktas->base_price * $mokestis/100 + $produktas->base_price;
                                $KainaSuNuolaida = $ProduktasSuMokesciais * (100 - ($individualinuolaida + $globalnuolaida))/100 ;
                    @endphp

                    @if($produktas->status !== 0)
                        <tr>
                            <td>    {{  $produktas->product_name }} </td>
                            <td>    {{  $produktas->sku }} </td>
                            <td>  {{  $KainaSuNuolaida }}</td>
                            <td>    {{  $produktas->description }} </td>
                            <td>
                                <img src="/AdeoWebUzduotis/AdeoWeb/storage/app/public/cover_images/{{ $produktas->cover_image }}"
                                     id="cover" width="100" height="100"></td>
                            <td><a href="{{ route('products.show', $produktas->id) }}" class="btn btn-primary">PERŽIŪRĖTI</a>
                            </td>

                            </td>
                        </tr>
                    @endif
                @endforeach


                </tbody>

            </table>

        </div>
    </div>
@endsection

