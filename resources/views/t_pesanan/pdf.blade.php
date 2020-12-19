<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>{{$profil->nama}}</h2>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Customer</th>
                        <td>:</td>
                        <td>{{ $dt->customers->nama}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td>{{ date('d F Y H:i:s',strtotime($dt->created_at))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Status Pesanan</th>
                        <th>Status Pembayaran</th>
                        <th>Berat</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {{ $dt->pakets->nama}}</td>
                        <td> {{ $dt->status_pesanans->nama}}</td>
                        <td> {{ $dt->status_pembayarans->nama}}</td>
                        <td> {{ $dt->berat}}</td>
                        <td>Rp. {{number_format($dt->grand_total)}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"> Total</th>
                        <td><b><i><u>Rp. {{number_format($dt->grand_total)}}</u></i></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>