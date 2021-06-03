<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Produk::all();

        return view('admin/boss-green-store.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/boss-green-store.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$produk = Produk::find($id);

        return view('member.index', [
            'produk' => $produk,
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new Produk;

        $produk->produk = $request->produk;
        $produk->harga = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->kategori = $request->kategori;
        $produk->tags = $request->tag;

        $images = $request->get('image');
        $images_name = array();

        foreach($images as $key=>$value){
            list($type, $value) = explode(';', $value);
            list(, $value)      = explode(',', $value);
            $value = base64_decode($value);
            $image_name = time().'_'.$key.'.jpg';
            file_put_contents('img/product/'.$image_name, $value);
            array_push($images_name, $image_name);
        }

        $produk->gambar = json_encode($images_name);

        $produk->save();

        return redirect('/admin/dashboard');
    }
}
