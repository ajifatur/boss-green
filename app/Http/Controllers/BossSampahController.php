<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BossSampah;
use App\HargaSampah;
use App\User;

class BossSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string  $taken
     * @return \Illuminate\Http\Response
     */
    public function index($taken)
    {
    	if($taken == 'belum-diambil'){
	    	$boss_sampah = BossSampah::where('sudah_diambil',0)->where('kurir',0)->get();
    	}
    	elseif($taken == 'akan-diambil'){
	    	$boss_sampah = BossSampah::where('sudah_diambil',0)->where('kurir','!=',0)->get();
    	}
    	elseif($taken == 'sudah-diambil'){
	    	$boss_sampah = BossSampah::where('sudah_diambil',1)->get();
    	}

    	$alamat = array();
    	foreach($boss_sampah as $order){
    		$alamat[$order->id_boss_sampah] = json_decode($order->alamat,true);
    		$order->member = User::find($order->member);
    		$order->kurir = User::find($order->kurir);
    	}

        return view('admin/boss-sampah.index', [
        	'alamat' => $alamat,
            'boss_sampah' => $boss_sampah,
            'taken' => $taken
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $taken
     * @return \Illuminate\Http\Response
     */
    public function indexkurir($taken)
    {
    	if($taken == 'belum-diambil'){
	    	$boss_sampah = BossSampah::where('sudah_diambil',0)->where('kurir','!=',Auth::user()->id)->get();
    	}
    	elseif($taken == 'akan-diambil'){
	    	$boss_sampah = BossSampah::where('sudah_diambil',0)->where('kurir',Auth::user()->id)->get();
    	}
    	elseif($taken == 'sudah-diambil'){
	    	$boss_sampah = BossSampah::where('sudah_diambil',1)->get();
    	}

    	$alamat = array();
    	foreach($boss_sampah as $order){
    		$alamat[$order->id_boss_sampah] = json_decode($order->alamat,true);
    		$order->member = User::find($order->member);
    		$order->kurir = User::find($order->kurir);
    	}

        return view('kurir/boss-sampah.index', [
        	'alamat' => $alamat,
            'boss_sampah' => $boss_sampah,
            'taken' => $taken
        ]);
    }

    /**
     * Display a price of the resource.
     *
     * @param  string  $taken
     * @return \Illuminate\Http\Response
     */
    public function hargasampah()
    {
    	$harga = HargaSampah::get()->first();

    	return view('admin/boss-sampah.harga-sampah', ['harga' => $harga]);
    }

    /**
     * Update the specified resource from Boss Sampah.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatehargasampah(Request $request)
    {
    	$harga = HargaSampah::get()->first();
    	$harga->harga = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
    	$harga->save();

    	return redirect()->route('admin.hargasampah')->with('message', 'Harga sampah berhasil diperbarui!');
    }


    /**
     * Update the specified resource from Harga Sampah.
     *
     * @return \Illuminate\Http\Response
     */
    public function ubahformatuang()
    {
    	$money = $_GET['money'];

		if($money == ''){
			echo '';
		}
		elseif($money == 'Rp. '){
			echo '';
		}
		elseif($money == '.'){
			echo '';
		}
		elseif($money == 'Rp. '){
			echo '';
		}
		elseif(preg_match("/^[0-9,]*$/", $money)){
			$money = filter_var($money, FILTER_SANITIZE_NUMBER_INT);
			$changeMoney = number_format($money);
			echo 'Rp. '.$changeMoney;
		}
		elseif(substr($money,0,4) == 'Rp. ' && preg_match("/^[0-9,]*$/", substr($money,4))){
			$money = filter_var($money, FILTER_SANITIZE_NUMBER_INT);
			$changeMoney = number_format($money);
			echo 'Rp. '.$changeMoney;
		}
		else{
			echo '';
		}
    }

    /**
     * Update the specified resource from Boss Sampah.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jemput($id)
    {
        $order = BossSampah::find($id);
        $order->kurir = Auth::user()->id;
        $order->save();
    }

    /**
     * Update the specified resource from Boss Sampah.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bataljemput($id)
    {
        $order = BossSampah::find($id);
        $order->kurir = 0;
        $order->save();
    }

    /**
     * Show the form for verificating.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifikasi($id)
    {	
    	$harga = HargaSampah::get()->first();

		return view('kurir/boss-sampah.verifikasi', ['id' => $id, 'harga' => $harga->harga]);
    }

    /**
     * Count total price of Boss Sampah.
     *
     * @return \Illuminate\Http\Response
     */
    public function hitung()
    {
    	$total = $_GET['berat'] * $_GET['harga'];
    	$hasil['angka'] = (int)$total;
    	$hasil['rupiah'] = 'Rp. '.number_format($hasil['angka']);
    	echo json_encode($hasil);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitverifikasi(Request $request)
    {
    	$order = BossSampah::find($request->id);

    	$order->berat = $request->berat;
    	$order->total_harga = $request->total_harga;
    	$order->tambahkan_uang_ke_saldo = $request->tambah;
    	$order->sudah_diambil = 1;

    	if($request->tambah == 1){
    		$member = User::find($order->member);
    		$member->saldo = $member->saldo + $request->total_harga;
    		$member->save();
    	}

    	$order->save();

    	return redirect('/kurir/boss-sampah/sudah-diambil');
    }
}
