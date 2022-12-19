<?php

require 'function.php';


if (isset ($_POST["register"])) {
     if( registrasi($_POST) > 0 ){
         echo     "
          <script>
         alert('Registrasi Berhasil');
         document.location.href ='sign-in.php';
          </script>
          ";
     } else {
         echo "
         <script>
         alert('Gagal diTambahkan!');
         document.location.href ='registrasi.php';
          </script>
         ";
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logoweb.png">
  <link rel="icon" type="image/png" href="../assets/img/logoweb.png">
  <title>
    Tambah Data Anak Yatim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-92 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">

      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 btn btn-link active" aria-current="page" href="../pages/dashboard.php">
              <i class="	fa fa-reply opacity-6  me-1"></i>
              Kembali
            </a>
          </li>
        </ul>
        <ul class="navbar-nav d-lg-block d-none">
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/bg-yayasan.png'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Registrasi</h1>
            <p class="text-lead text-white">Silahkan Registrasi</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">

            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data" >
              <input type="hidden" name="level" id="level" value ="user">
              <div class="mb-3">
                <label for="username"> Nama  </label>
                  <input type="text" name="namauser" id="namauser" class="form-control" placeholder="Nama" required >
                </div>
                <div class="mb-3">
                <label for="username"> Tanggal Lahir  </label>
                  <input type="date" name="tanggaluser" id="tanggaluser" class="form-control" placeholder="Tanggal Lahir" required >
                </div>
                <div class="mb-3">
                <label for="username"> Alamat  </label>
                  <input type="text" name="alamatuser" id="alamatuser" class="form-control" placeholder="Alamat" required >
                </div>
                <div class="mb-3">
                <label for="username"> Nomor Telepon  </label>
                  <input type="text" name="nouser" id="nouser" class="form-control" placeholder="Nomor Telepon" required >
                </div>
                <div class="mb-3">
                <label for="username"> Username  </label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="username" required >
                </div>
                <div class="mb-3">
                <label for="password"> Password  </label>
                <input type="password" name="password" id="password"  class="form-control" placeholder="Password" required> 
                </div>
                <div class="mb-3">
                <label for="password2"> Konfirmasi Password  </label>
                <input type="password" name="password2" id="password2"  class="form-control" placeholder="Kondifmasi Password" required> 
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2"id="register" name="register">Submit!</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.2"></script>
</body>

</html>