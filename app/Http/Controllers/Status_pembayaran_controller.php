<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status_pembayaran;

class Status_pembayaran_controller extends Controller
{
    public function index(){
        $title = 'Status Pembayaran';
        $data= Status_pembayaran::orderBy('nama','asc')->get();

        return view('status_pembayaran.index',compact('title','data'));
    }

    public function add(){
        $title = 'Menu Status Pembayaran';
        return view('status_pembayaran.add',compact('title'));
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

        Status_pembayaran::insert($data);

        return redirect('status-pembayaran');
    }

    public function edit($id){
        $data = Status_pembayaran::find($id);
        $title = 'Edit Status Pembayaran';

        return view('status_pembayaran.edit',compact('title','data'));
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

        Status_pembayaran::where('id',$id)->update($data);

        return redirect('status-pembayaran');
    }

    public function delete($id){
        try {
            Status_pembayaran::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('status-pembayaran');
    }
}
