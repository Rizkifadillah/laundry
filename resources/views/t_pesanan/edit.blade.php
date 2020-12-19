@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('transaksi-pesanan')}}" class="btn btn-sm btn-flat btn-success "><i class="fa fa-back"></i> Back</a href="{{ url('paket-laundry')}}">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </p>
            </div>
            <div class="box-body">
               
            <form role="form" method="post" action="{{ url('transaksi-pesanan/'.$dt->id)}}">
                @csrf
                {{ method_field('PUT')}}

              <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Customer</label>
                    <select class="form-control select2" name="customer" id="">
                        @foreach($customer as $cs)
                        <option value="{{ $cs->id}}" {{ ($dt->customer == $cs->id ? 'selected' : '') }}>{{$cs->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Paket Laundry</label>
                    <select class="form-control select2" name="paket" id="">
                        @foreach($paket as $pk)
                        <option value="{{ $pk->id}}" {{ ($dt->paket == $pk->id ? 'selected' : '') }} >{{$pk->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Berat  (Kg)</label>
                  <input type="number" class="form-control" value="{{$dt->berat}}"name="berat" id="" placeholder="Berat">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Status Pesanan</label>
                    <select class="form-control select2" name="status_pesanan" id="">
                        @foreach($status_pesanan as $pesanan)
                        <option value="{{ $pesanan->id}}" {{ ($dt->status_pesanan == $pesanan->id ? 'selected' : '') }} >{{$pesanan->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Status Pembayaran</label>
                    <select class="form-control select2" name="status_pembayaran" id="">
                        @foreach($status_pembayaran as $pembayaran)
                        <option value="{{ $pembayaran->id}}" {{ ($dt->status_pembayaran == $pembayaran->id ? 'selected' : '') }} >{{$pembayaran->nama}}</option>
                        @endforeach
                    </select>
                </div>

                
              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection