<section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        

        @if(\Auth::user()->role ==1)
          <li class="menu-sidebar"><a href="{{ url('/paket-laundry') }}"><span class="fa fa-hand-grab-o"></span>Paket Laundry</span></a></li>
          <li class="menu-sidebar"><a href="{{ url('/customer') }}"><span class="fa fa-hand-paper-o
"></span>Customer</span></a></li>
          <li class="menu-sidebar"><a href="{{ url('/status-pesanan') }}"><span class="fa fa-hand-peace-o
"></span>Status Pesanan</span></a></li>
          <li class="menu-sidebar"><a href="{{ url('/status-pembayaran') }}"><span class="fa fa-hand-stop-o"></span>Status Pembayaran</span></a></li>
        @endif
        <li class="menu-sidebar"><a href="{{ url('/transaksi-pesanan') }}"><span class="fa fa-bolt
"></span>Transaksi Pesanan</span></a></li>

        @if(\Auth::user()->role ==1)
          <li class="header">Other</li>
          <li class="menu-sidebar"><a href="{{ url('/profil') }}"><span class="fa fa-camera"></span>Profil</span></a></li>
          <li class="menu-sidebar"><a href="{{ url('/karyawan') }}"><span class="fa fa-bullhorn"></span>Karyawan</span></a></li>
        @endif

        <li class="menu-sidebar"><a href="{{ url('/keluar') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</span></a></li>


      </ul>
    </section>