<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <style>
  </style>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
      <!-- Navbar -->
  <nav class="header navbar navbar-expand navbar-white navbar-light border">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-sm-inline-block">
        <img src="{{('/img/logo.png')}}" style="width: 50px" alt="logo">
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar right -->
      <li class="nav-item">
        <?php
        $pesanan_keranjang = \App\Models\Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(!empty($pesanan_keranjang)){
          $keranjang = \App\Models\Pesanandetail::where('pesanan_id', $pesanan_keranjang->id)->count();
        }
        ?>
        <a href="{{ url('/checkout')}}"><i class="fa fa-shopping-cart"></i>
          @if (!empty($keranjang))
          <span class="badge badge-danger">{{ $keranjang }}</span></a>
          @endif
          
      </li>
        <li class="mr-2 ml-2">
          |
        </li>
        <li class="nav-item">
          <a href="{{url('/profile')}}">Profile</a>
        </li>
        <li class="mr-2 ml-2">
          |
        </li>
      <li class="nav-item">
        <a href="{{ route('logout')}}">Log out</a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <a href="{{url('/')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$barang->nama_barang}}</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <h4>{{$barang->nama_barang}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('img/barang')}}/{{ $barang->gambar}}" class="rounded mx-auto d-block" width="400" alt="">
                        </div>

                        <div class="col-md-6 mt-5">
                            <h3>{{$barang->nama_barang}}</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($barang->harga)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{$barang->stok}}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{$barang->keterangan}}</td>
                                    </tr>
                                    
                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{url('/pesan')}}/{{$barang->id}}" method="post">
                                                @csrf
                                                    <input type="text" name="jumlah_pesan" id="" class="form-control" required>
                                                    <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
</body>
</html>