@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('transaksi-pesanan/add')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Tambah Transaksi</a>
                    <a href="#" class="btn btn-sm btn-flat btn-success btn-filter "><i class="fa fa-filter"></i> Filter Tanggal</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Paket</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                                <th>Berat</th>
                                <th>Grand Total</th>
                                <th>Action Status</th>
                                <th>Cetak Invoice</th>
                                <th>Create_at</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $e=>$dt)
                            <tr>
                                <td>
                                    <div style="width:60px">
                                        <a href="{{ url('transaksi-pesanan/'.$dt->id)}}" id-supplier="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ url('transaksi-pesanan/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                                <td>{{$e+1}}</td>
                                <td> {{ $dt->customers->nama}}</td>
                                <td> {{ $dt->pakets->nama}}</td>
                                <td> 
                                    <a  class="btn btn-primary btn-xs" id="delete">
                                         {{ $dt->status_pesanans->nama}}
                                    </a>
                                </td>
                                <td> 
                                    <a  class="btn btn-success btn-xs" id="delete">
                                        {{ $dt->status_pembayarans->nama}}                                    </a>
                               </td>
                                <td> {{ $dt->berat}}</td>
                                <td>Rp. {{number_format($dt->grand_total)}}</td>
                                <td>
                                    <a href="{{url('transaksi-pesanan/naikan-status/'.$dt->id)}}" class="btn btn-success btn-xs" id="delete"><i class="fa fa-pencil-square-o"></i></a></div>
                                    <a href="{{url('transaksi-pesanan/naikan-status-pembayaran/'.$dt->id)}}" class="btn btn-danger btn-xs" id="delete"><i class="fa fa-pencil-square-o"></i></a></div>
                                </td>
                                <td>
                                    <a href="{{url('transaksi-pesanan/print/'.$dt->id)}}" class="btn btn-warning btn-xs" id="delete"><i class="fa fa-print"></i></a></div>
                                </td>
                                <td> {{ date('d F Y',strtotime($dt->created_at))}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
 
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
 
          <form role="form" method="get" action="{{ url('transaksi-pesanan/periode')}}">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Dari</label>
              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" name="dari" value="{{ date('Y-m-d')}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Sampai</label>
              <input type="text" name="sampai" class="form-control datepicker" id="exampleInputPassword1" placeholder="Sampai" autocomplete="off" value="{{ date('Y-m-d')}}">
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

        $('.btn-filter').click(function(e){
            e.preventDefault();
            $('#modal-filter').modal();
        })
 
    })
</script>
 
@endsection