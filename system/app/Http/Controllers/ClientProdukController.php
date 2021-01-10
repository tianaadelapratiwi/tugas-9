<?php

namespace App\Http\Controllers;
use App\Models\Produk;

class ClientProdukController extends Controller
	{

	function home(){
		$data['list_produk'] = produk::all();
		return view('home', $data);
	}

	function show(Produk $produk){
		$data['produk'] = $produk;
		return view('produk_single', $data);
	}

	function Clientfilter(){
		$nama_produk = request('nama_produk');
		$stok = explode(",", request('stok'));
		$data['harga_min'] = $harga_min = request('harga_min');
		$data['harga_max'] = $harga_max = request('harga_max');
		//$data['list_produk'] = Produk::where('nama_produk','like', "%$nama_produk%")->get();
		//$data['list_produk'] = Produk::whereIn('stok', $stok)->get();
		//$data['list_produk'] = Produk::whereBetween('harga', [$harga_min, $harga_max])->get();
		//$data['list_produk'] = Produk::where('stok','<>', $stok)->get();
		//$data['list_produk'] = Produk::whereNotIn('stok', $stok)->get();
		//$data['list_produk'] = Produk::whereNotBetween('harga', [$harga_min, $harga_max])->get();
		//$data['list_produk'] = Produk::whereNotNull('stok')->get();
		//$data['list_produk'] = Produk::whereDate('created_at', ['2020-11-21','2020-11-15'])->get();
		$data['list_produk'] = Produk::whereBetween('harga', [$harga_min, $harga_max])->whereNotIn('stok', [100])->whereYear('created_at', '2020')->get();
		$data['nama_produk'] = $nama_produk;
		$data['stok'] = request('stok');


		return view('produk.index', $data);
		
	}

}
