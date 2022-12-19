<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: fotokergiatan.php");
    exit;
}
require 'function.php';

$id = $_GET ["idname"];

$peserta = query("SELECT * FROM kegiatan WHERE idname = $id")[0];

if (isset ($_POST["submit"])) {


     if( editkegiatan ($_POST) > 0 ){
         echo "
         <script>
         alert('Data berhasil diedit!');
         document.location.href ='fotokergiatan.php';
          </script>
         ";

     } else {
         echo "
         <script>
         alert('Data gagal diedit!');
         document.location.href ='fotokergiatan.php';
          </script>
         ";
     }
}
?>
<!DOCTYPE html>


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
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-93 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">

      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/fotokergiatan.php">
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
            <h1 class="text-white mb-2 mt-5">Edit Foto Kegiatan</h1>
            <p class="text-lead text-white">Silahkan Edit Foto Kegiatan</p>
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
              <div class="mb-3">
              <input type="hidden" name="idname" value ="<?= $peserta["idname"]; ?>">
        <input type="hidden" name="gambarlama" value ="<?= $peserta["foto"]; ?>">
        </div>
                <div class="mb-3">
                <label for="judul"> Judul  </label>
                <input type="text" name="judul" id="judul"  class="form-control"required value="<?= $peserta ["judul"]; ?>">
                </div>

                <div class="mb-3">
                <label for="kegiatan"> Deskripsi </label>
                <input type="text" name="kegiatan" id="kegiatan"  class="form-control"required value="<?= $peserta ["kegiatan"]; ?>">
                </div>

                <div class="mb-3">
                <label for="foto"> Masukkan Foto Kegiatan </label>
                <?php echo "<img src='../pages/kegiatan/$peserta[foto]' width='80'/>";?><br>
                <input type="file" name="foto" id="foto">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"id="submit" name="submit">Submit</button>
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