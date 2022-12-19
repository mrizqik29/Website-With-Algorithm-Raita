<?php
session_start();


require 'function.php';

$id = $_GET ["iduser"];
$peserta = query("SELECT * FROM masuk WHERE iduser = $id")[0];

if (isset ($_POST["submit"])) {
    if( konfirmasidata ($_POST) > 0 ){
        echo "
        <script>
        alert('Syarat Konfirmasi!');
        document.location.href ='konfir.php';
         </script>
        ";

    } else {
        echo "
        <script>
        alert('Syarat Gagal Konfirmasi!');
        document.location.href ='konfir.php';
         </script>
        ";
    }
}
if (isset ($_POST["submit1"])) {
    if( terimadata ($_POST) > 0 ){
        echo "
        <script>
        alert('Syarat Diterima!');
        document.location.href ='konfir.php';
         </script>
        ";

    } else {
        echo "
        <script>
        alert('Syarat Gagal Diterima!');
        document.location.href ='konfir.php';
         </script>
        ";
    }
}
if (isset ($_POST["submit2"])) {

  if( hapusproses ($_POST) > 0 && hapusidangkat ($_POST) > 0){
      echo "
      <script>
      alert('Data Adopsi Berhasil Dihapus !');
      document.location.href ='konfir.php';
       </script>
      ";

  } else {
      echo "
      <script>
      alert('Data Adopsi Gagal Dihapus!');
      document.location.href ='konfir.php';
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
    Data anak Yatim
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
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/konfir.php">
              <i class="	fas fa-reply opacity-6  me-1"></i>
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
            <h1 class="text-white mb-2 mt-5"> <?php echo  $peserta ["namauser"]; ?></h1>
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
              <input type="hidden" name="anakyatim" value ="<?= $peserta["anakcaa"]; ?>">
              <input type="hidden" name="idanakyatim" value ="<?= $peserta["idanakcaa"]; ?>">
              <td><?php if($peserta["proses"]== 1){?>
                        <input type="hidden" name="proses" value ="2">
                    <?php } ?> </td>

              <input type="hidden" name="id" value ="<?= $peserta["iduser"]; ?>">
              <div class="mb-3">
                <label for="surat1"> Surat Permohonan Izin Pengangkatan Anak </label><br>
                
                <td><?php if($peserta["cek1"]>= 1){?>
                        <input type="hidden" name="cek1" value ="2">
                        <?php echo "<img src='../pages/syarat/$peserta[surat1]' width='100'/>";?>
                        <br>
                        <a href="download.php?filename=<?= $peserta['surat1']?>" class="btn btn-primary">Download</a>
                    <?php } else if ($peserta["cek1"]== 0){?>
                        <p class= "text-danger"> Belum </p>
                    <?php } ?> </td>
                </div>
                
                <div class="mb-3">
                <label for="surat2"> KTP</label><br>
                <td><?php if($peserta["cek2"]>= 1){?>
                        <input type="hidden" name="cek2" value ="2">
                        <?php echo "<img src='../pages/syarat/$peserta[surat2]' width='100'/>";?>
                        <br>
                        <a href="download.php?filename=<?= $peserta['surat2']?>" class="btn btn-primary">Download</a>
                    <?php } else if ($peserta["cek2"]== 0){?>
                        <p class= "text-danger"> Belum </p>
                    <?php } ?> </td>
                </div>

                <div class="mb-3">
                <label for="surat3"> Kartu Keluarga </label><br>
                <td><?php if($peserta["cek3"]>= 1){?>
                        <input type="hidden" name="cek3" value ="2">
                        <?php echo "<img src='../pages/syarat/$peserta[surat3]' width='100'/>";?>
                        <br>
                        <a href="download.php?filename=<?= $peserta['surat3']?>" class="btn btn-primary">Download</a>
                    <?php } else if ($peserta["cek3"]== 0){?>
                        <p class= "text-danger"> Belum </p>
                    <?php } ?> </td>
                </div>
                <br>
                <button type="submit" class="btn bg-gradient-primary "id="submit" name="submit2">Hapus</button>
                <button type="submit" class="btn bg-gradient-primary "id="submit" name="submit1">Terima</button>
                <button type="submit" class="btn bg-gradient-primary "id="submit" name="submit">Konfirmasi</button>
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