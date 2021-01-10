<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Faker;

class ProdukController extends Controller
{
	function index(){
		$id_user = request()->user()->id;
		$data['list_produk'] = Produk::where('id_user',$id_user)->get();
		return view('produk.index', $data);
	}

	function create(){
		return view('produk.create');
	}

	function store(){
		$produk = new Produk;
		$produk->id_user = request()->user()->id;
		$produk->nama_produk = request('nama_produk');
		$produk->harga = request('harga');
		$produk->berat = request('berat');
		$produk->deskripsi = request('deskripsi');
		$produk->stok = request('stok');
		$produk->save();

		return redirect('produk')->with('success','Data Berhasil Ditambahkan');
		// dd(request()->all());
	}

	function show(Produk $produk){
		$data['produk'] = $produk;
		return view('produk/show', $data);
	}

	function edit(Produk $produk){
		$data['produk'] = $produk;
		return view('produk/edit', $data);
	}

	function update(Produk $produk){
		$produk->nama_produk = request('nama_produk');
		$produk->harga = request('harga');
		$produk->berat = request('berat');
		$produk->stok = request('stok');
		$produk->deskripsi = request('deskripsi');
		$produk->save();

		return redirect('produk')->with('success','Data Berhasil Diubah');
	}

	function destroy(Produk $produk){
		$produk->delete();
		return redirect('produk')->with('danger','Data Berhasil Dihapus');
	}

	function filter(){
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
