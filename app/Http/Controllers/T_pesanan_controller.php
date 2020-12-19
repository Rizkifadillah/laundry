<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Paket;
use App\Model\T_pesanan;
use App\Status_pesanan;
use App\Status_pembayaran;
use App\Model\Profil;
use PDF;


class T_pesanan_controller extends Controller
{

    public function index(){
        $title = 'Transaksi Pesanan';
        $data= T_pesanan::orderBy('created_at','asc')->get();

        return view('t_pesanan.index',compact('title','data'));
    }

    public function periode(Request $request){
       try {
           //code...
           $title = 'Transaksi Pesanan dari $dari sampai $sampai';

           $dari = $request->dari;
           $sampai = $request->sampai;

           $data = T_pesanan::whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->orderBy('created_at','desc')->get();

           \Session::flash('sukses','Transaksi berhasil diitambahkan');

           return view('t_pesanan.index',compact('title','data'));


       } catch (\Throwable $th) {
           //throw $th;
           \Session::flash('gagal','Transaksi berhasil diitambahkan');

           return redirect()->back();

       }
    }

    public function add(){
        $title = 'Transaksi Pesanan';
        $customer= Customer::orderBy('nama','asc')->get();
        $paket= Paket::orderBy('nama','asc')->get();
        $status_pesanan= Status_pesanan::orderBy('nama','asc')->get();
        $status_pembayaran= Status_pembayaran::orderBy('nama','asc')->get();

        return view('t_pesanan.add',compact(
            'title',
            'customer',
            'paket',
            'status_pesanan',
            'status_pembayaran'
        ));
    }

    public function store(Request $request){
        $this->validate($request,[
            'customer'=>'required',
            'paket'=>'required',
            'berat'=>'required',
            'status_pesanan'=>'required',
            'status_pembayaran'=>'required'

        ]);

        $data['id'] = \Uuid::generate(4);
        $data['customer'] = $request->customer;
        $data['paket'] = $request->paket;
        $data['berat'] = $request->berat;
        $data['status_pesanan'] = $request->status_pesanan;
        $data['status_pembayaran'] = $request->status_pembayaran;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $harga =Paket::find($request->paket);
        $harga_paket = $harga->harga;
        $berat = $request->berat;

        $grand_total= $harga_paket * $berat;

        $data['grand_total'] = $grand_total;

        \Session::flash('sukses','Transaksi berhasil diitambahkan');

        T_pesanan::insert($data);

        return redirect('transaksi-pesanan');
    }

    public function edit($id){
        $dt = T_pesanan::find($id);
        $title = 'Edit Transaksi Pesanan';
        $customer= Customer::orderBy('nama','asc')->get();
        $paket= Paket::orderBy('nama','asc')->get();
        $status_pesanan= Status_pesanan::orderBy('nama','asc')->get();
        $status_pembayaran= Status_pembayaran::orderBy('nama','asc')->get();

        return view('t_pesanan.edit',compact(
            'dt',
            'title',
            'customer',
            'paket',
            'status_pesanan',
            'status_pembayaran'
        ));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'customer'=>'required',
            'paket'=>'required',
            'berat'=>'required',
            'status_pesanan'=>'required',
            'status_pembayaran'=>'required'

        ]);

        $data['customer'] = $request->customer;
        $data['paket'] = $request->paket;
        $data['berat'] = $request->berat;
        $data['status_pesanan'] = $request->status_pesanan;
        $data['status_pembayaran'] = $request->status_pembayaran;
        // $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $harga =Paket::find($request->paket);
        $harga_paket = $harga->harga;
        $berat = $request->berat;

        $grand_total= $harga_paket * $berat;

        $data['grand_total'] = $grand_total;

        \Session::flash('sukses','Transaksi berhasil di edit');

        T_pesanan::where('id',$id)->update($data);

        return redirect('transaksi-pesanan');
    
    }

    public function delete($id){
        T_pesanan::where('id',$id)->delete();
        
        \Session::flash('sukses','Data berhasil di hapus');

        return redirect('transaksi-pesanan');
    }

    public function naikan_status($id){
        try {
            //code...
            $transaksi = T_pesanan::find($id);
            $urutan_status = $transaksi->status_pesanans->urutan;

            $urutan_baru = $urutan_status + 1;
            $status_baru = Status_pesanan::where('urutan',$urutan_baru)->first();

            T_pesanan::where('id',$id)->update([
                'status_pesanan'=>$status_baru->id
            ]);

            \Session::flash('sukses','Data berhasil di ubah');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal', $e->getMessage());

        }
        return redirect()->back();
        
    }

    public function naikan_status_pembayaran($id){
        try {
            //code...
            $transaksi = T_pesanan::find($id);
            $urutan_status = $transaksi->status_pembayarans->urutan;

            $urutan_baru = $urutan_status + 1;
            $status_baru = Status_pembayaran::where('urutan',$urutan_baru)->first();

            T_pesanan::where('id',$id)->update([
                'status_pembayaran'=>$status_baru->id
            ]);

            \Session::flash('sukses','Data berhasil di ubah');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal', $e->getMessage());

        }
        return redirect()->back();
        
    }

    

    public function export($id){
        try {
            //code...
            $dt= T_pesanan::find($id);
            $profil=Profil::first();

            $pdf = PDF::loadView('t_pesanan.pdf',['dt'=>$dt, 'profil'=>$profil]);
            return $pdf->download('t_pesanan.pdf');

            \Session::flash('sukses','Data berhasil di ubah');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal', $e->getMessage());

            return redirect()->back();
        }
        
    }
}
