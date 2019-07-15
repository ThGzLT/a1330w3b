@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lentelė</div>
                <div class="card-body" id="margins">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route('products.create') }}">Create Product</a>

                </div>
                @php
                    $ats = "a";
                    $ats1 = "a";
                    $ats2 = "a";
                    if ($kintamieji[0]->mokesciotagas === 1)
                    {
                    $ats = "Taip";
                    }
                    else {
                    $ats = "Ne";
                    }
                     if ($kintamieji[0]->indnuolaidostagas === 1)
                    {
                    $ats1 = "Taip";
                    }
                    else {
                    $ats1 = "Ne";
                    }
                     if ($kintamieji[0]->globalnuolaidostagas === 1)
                    {
                    $ats2 = "Taip";
                    }
                    else {
                    $ats2 = "Ne";
                    }
                @endphp
                <div class="col-md-4">
                    <form method="post" action={{route('kintamieji.update', $kintamieji[0]->id)}}>
                        @method('PATCH')
                        @csrf
                        <div class="form-group">

                            <label for="mokestis">Mokestis %:</label>
                            <input type="text" class="form-control" name="mokestis"
                                   value={{$kintamieji[0]->mokestis}} />
                        </div>
                        <div class="form-group">
                            <label for="nuolaida">Nuolaida %:</label>
                            <input type="text" class="form-control" name="nuolaida"
                                   value={{$kintamieji[0]->nuolaida}} />
                        </div>


                        <div class="form-group">
                            <label for="mokesciotagas">Įgalinti mokestį:</label>
                            <select class="form-control" name="mokesciotagas">
                                <option value="{{$kintamieji[0]->mokesciotagas}}">{{$ats}}</option>
                                <option value="1">Taip</option>
                                <option value="0">Ne</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="indnuolaidostagas">Įgalinti individulias nuolaidas:</label>
                            <select class="form-control" name="indnuolaidostagas">
                                <option value="{{$kintamieji[0]->indnuolaidostagas}}">{{$ats1}}</option>
                                <option value="1">Taip</option>
                                <option value="0">Ne</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="globalnuolaidostagas">Įgalinti globalias nuolaidas:</label>
                            <select class="form-control" name="globalnuolaidostagas">
                                <option value="{{$kintamieji[0]->globalnuolaidostagas}}">{{$ats2}}</option>
                                <option value="1">Taip</option>
                                <option value="0">Ne</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Atnaujinti</button>
                    </form>

                </div>


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <button style="margin-bottom: 10px" class="btn btn-primary delete_all"
                                    data-url="{{ url('myproductsDeleteAll') }}">Ištrinti pasirinktus
                            </button>


                        </th>
                        <th>id</th>
                        <th>pavadinimas</th>

                        <th>sku</th>
                        <th>status</th>
                        <th>kaina</th>
                        <th>individuali nuolaida %</th>
                        <th>aprašymas</th>
                        <th>paveiksliukas</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($produktai as $produktas)

                        {{--      @php
                                   $mokestis = $kintamieji[0]->mokestis;
                                       $ProduktasSuMokesciais = $produktas->base_price * $mokestis/100 + $produktas->base_price;
                                       $KainaSuNuolaida = $ProduktasSuMokesciais * (100 - $kintamieji[0]->nuolaida)/100 ;
                               @endphp
                                <td>   {{  $ProduktasSuMokesciais}} </td>
                                   <td>  {{  $KainaSuNuolaida }}</td>

       --}}
                        <tr>

                            <td><input type="checkbox" class="sub_chk" data-id="{{$produktas->id}}"></td>
                            <td>    {{  $produktas->id }} </td>
                            <td>    {{  $produktas->product_name }} </td>
                            <td>    {{  $produktas->sku }} </td>
                            <td>    {{  $produktas->status }} </td>
                            <td>{{  $produktas->base_price}}</td>
                            <td>{{  $produktas->special_price}}</td>
                            <td>    {{  $produktas->description }} </td>
                            <td>
                                <img src="/AdeoWebUzduotis/AdeoWeb/storage/app/public/cover_images/{{ $produktas->cover_image }}"
                                     id="cover" width="100" height="100"></td>
                            <td><a href="{{ route('products.edit', $produktas->id) }}"
                                   class="btn btn-primary">REDAGUOTI</a>
                            </td>
                            <td>
                                <form class="delete" action="{{route( 'products.destroy', $produktas->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">PANAIKINTI</button>
                                </form>
                            </td>
                            <td><a href="{{ route('products.show', $produktas->id) }}" class="btn btn-primary">PERŽIŪRĖTI</a>

                            </td>


                        </tr>


                    @endforeach


                    </tbody>

                </table>


            </div>


        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {


            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function (e) {


                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {


                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function (index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });


            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });


            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });
        });
    </script>

@endsection
