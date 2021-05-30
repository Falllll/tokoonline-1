<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pesanandetail;
use App\Models\Barang;
use Auth;
use Alert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function pesan($id){
        $barang = Barang::where('id', $id)->first();

        return view('pesan', compact('barang'));
    }

    public function kirim(Request $request, $id){
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        // validasi apakah melebihi stok
        if($request->jumlah_pesan > $barang->stok)
        {
            return redirect('pesan/'.$id);
        }

        // cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // Simpan ke table pesanans
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }
        // Simpan ke table pesanandetails
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // Cek pesanan detail
        $cek_pesanan_detail = Pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new Pesanandetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        }else{
            $pesanan_detail = Pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;

            // harga sekarang
            $harga_pesanan_detail_baru = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }
        
        // jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesanan->update();

        alert()->success('Barang berhasil masuk ke keranjang', 'Berhasil');
        return redirect ('/');
    }

    public function checkout(){
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(!empty($pesanan)){
            $pesanan_details = Pesanandetail::where('pesanan_id', $pesanan->id)->get();
        }
        if(empty($pesanan)){
            alert()->error('Belum ada pesanan', 'Error');
            return redirect('/');
        }

        return view ('checkout', compact('pesanan', 'pesanan_details'));
    }

    public function delete($id){
        $pesanan_detail = Pesanandetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        alert()->success('Pesanan berhasil dihapus', 'Hapus');
        return redirect('/checkout');

    }

    public function konfirmasi(){

        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat)){
            alert()->error('Identitas harap dilengkapi', 'Error');
            return redirect('/profile');
        }
        if(empty($user->no_hp)){
            alert()->error('Identitas harap dilengkapi', 'Error');
            return redirect('/profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = Pesanandetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail){
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesanan_detail->jumlah;
            $barang->update();
        }
        alert()->success('Pesanan berhasil dicheck out silahkan lanjutkan proses pembayaran', 'Berhasil');
        return redirect('/history/'.$pesanan_id);
    }
}
