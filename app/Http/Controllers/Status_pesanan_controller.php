<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status_pesanan;

class Status_pesanan_controller extends Controller
{
    public function index(){
        $title = 'Status Pesanan';
        $data= Status_pesanan::orderBy('nama','asc')->get();

        return view('status_pesanan.index',compact('title','data'));
    }

    public function add(){
        $title = 'Menu Tambah Customer';
        return view('status_pesanan.add',compact('title'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama'=>'required',
            'urutan'=>'required'

        ]);

        $data['id'] = \Uuid::generate(4);
        $data['nama'] = $request->nama;
        $data['urutan'] = $request->urutan;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        Status_pesanan::insert($data);

        return redirect('status-pesanan');
    }

    public function edit($id){
        $data = Status_pesanan::find($id);
        $title = 'Edit Status Pesanan';

        return view('status_pesanan.edit',compact('title','data'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'urutan'=>'required'
        ]);

        $data['nama'] = $request->nama;
        $data['urutan'] = $request->urutan;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil di Update');

        Status_pesanan::where('id',$id)->update($data);

        return redirect('status-pesanan');
    }

    public function delete($id){
        try {
            Status_pesanan::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('status-pesanan');
    }
}
