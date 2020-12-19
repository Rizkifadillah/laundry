<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Paket;

class Paket_controller extends Controller
{
    public function index(){
        $title = 'Paket Laundry';
        $data = Paket::get();

        return view('paket.index',compact('title','data'));
    }

    public function add(){
        $title = 'Tambah Paket Laundry';

        return view('paket.add',compact('title'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama'=>'required',
            'harga'=>'required'
        ]);

        $data['id'] = \Uuid::generate(4);
        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        Paket::insert($data);

        return redirect('paket-laundry');
    }

    public function edit($id){
        $dt = Paket::find($id);
        $title = 'Edit Paket Laundry';

        return view('paket.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'harga'=>'required'
        ]);

        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil di Update');

        Paket::where('id',$id)->update($data);

        return redirect('paket-laundry');
    }

    public function delete($id){
        try {
            Paket::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('paket-laundry');
    }
}
