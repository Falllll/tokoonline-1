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
          @endif</a>
      </li>
        <li class="mr-2 ml-2">
          |
        </li>
        <li class="nav-item">
          <a href="{{ url ('/profile')}}">Profile</a>
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
<br>
  <div class="container">
    <div class="row justify-content-center"><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url ('/')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
            </div>
            <div class="col-md-12 mt-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="fa fa-user"></i>My Profile</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>No Handphone</td>
                                    <td>:</td>
                                    <td>{{$user->no_hp}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{$user->alamat}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="fa fa-pencil-alt"></i>Edit Profile</h4>
                        <form action="{{ url('/profile')}}" method="post">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{$user->name}}" required>
                            </div>
                            <div class="input-group mb-3">
                              <input type="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}" required> 
                            </div>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" name="no_hp" placeholder="No Handphone" value="{{$user->no_hp}}" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{$user->alamat}}" required>
                              </div>
                            <div class="row">
                              <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                              </div>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
  @include('sweet::alert')
</body>
</html>