@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('profil/add')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Tambah</a>
                    <a href="" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Edit</a>
                </p>
            </div>
            <div class="box-body">

                <form role="form" method="post" action="{{ url('profil/add')}}">
                @csrf
                {{method_field('PUT')}}
                <div class="box-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nama Toko</label>
                    <input type="nama" class="form-control" value="{{$dt->nama}}"name="nama" id="" placeholder="Nama">
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