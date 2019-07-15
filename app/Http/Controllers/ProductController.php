<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Kintamieji;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('frontend', 'show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function frontend()
    {
        $produktai = Product::all();
        $kintamieji = Kintamieji::all();
        return view('home', compact('produktai', 'kintamieji'));
    }

    public function index()
    {

        $produktai = Product::all();
         $kintamieji = Kintamieji::all();
        return view('home1', compact('produktai', 'kintamieji'));
    }

    public function create()
    {
        return view('products.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'sku' => 'required',
            'status' => 'required|boolean',
            'base_price' => 'required',
            'special_price' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:2048',
        ]);

        if($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = "noImage.jpg";
        }

        $NaujasProduktas = new Product([
            'product_name' => $request->get('product_name'),
            'sku' => $request->get('sku'),
            'status' => $request->get('status'),
            'base_price' => $request->get('base_price'),
            'special_price' => $request->get('special_price'),
            'description' => $request->get('description'),
             'cover_image' => $fileNameToStore,
        ]);
        $NaujasProduktas->save();
        return redirect('/home1')->with('success', 'Stock has been updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kintamieji = Kintamieji::all();
        $product = Product::find($id);
        return view('products.show', compact('product',  'kintamieji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produktas = Product::find($id);

        return view('products.edit', compact('produktas'));
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
        $request->validate([
            'product_name' => 'required',
            'sku' => 'required',
            'status' => 'required|boolean',
            'base_price' => 'required',
            'special_price' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:2048',
        ]);

        if($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $produktas = Product::find($id);
        $produktas->product_name = $request->get('product_name');
        $produktas->sku = $request->get('sku');
        $produktas->status = $request->get('status');
        $produktas->base_price = $request->get('base_price');
        $produktas->special_price = $request->get('special_price');
        $produktas->description = $request->get('description');
        if($request->hasFile('cover_image')) {
            $produktas->cover_image = $fileNameToStore;
        }
        $produktas->save();

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

        $produktas = Product::find($id);
        unlink(storage_path('app/public/cover_images/'.$produktas->cover_image));
        $produktas->delete();
        return redirect('/home1')->with('success', 'Product Removed');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("products")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }

}
