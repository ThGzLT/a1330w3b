<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Kintamieji;

class KintamiejiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $kintamieji = Kintamieji::all();
        return view('home1', compact( 'kintamieji'));
    }

    public function create()
    {
      //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $kintamieji = Kintamieji::find($id);
        $kintamieji->mokestis = $request->get('mokestis');
        $kintamieji->nuolaida = $request->get('nuolaida');
        $kintamieji->mokesciotagas = $request->get('mokesciotagas');
        $kintamieji->indnuolaidostagas = $request->get('indnuolaidostagas');
        $kintamieji->globalnuolaidostagas = $request->get('globalnuolaidostagas');
        $kintamieji->save();

        return redirect('/home1')->with('success', 'Stock has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //
    }
}


