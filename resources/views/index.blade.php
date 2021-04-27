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

      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 mb-5">
        <img src="{{('/img/logo.png')}}" class="rounded mx-auto d-block" style="width: 200px" alt="">
      </div>
      @foreach ($barangs as $barang)
        <div class="col-md-4">
          <div class="card">
            <img src="{{ url ('img/barang')}}/{{$barang->gambar}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$barang->nama_barang}}</h5>
              <p class="card-text">
                <strong>Harga : </strong>
                Rp. {{ number_format($barang->harga)}} <br>
                <Strong>Stok : </Strong>
                {{$barang->stok}} <br>
                <hr>
                <Strong>Keterangan : </Strong>
                {{$barang->keterangan}}
              </p>
              <a href="{{url('pesan')}}/{{$barang->id}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Pesan</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

</body>
</html>