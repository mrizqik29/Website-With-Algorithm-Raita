<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: user.php");
    exit;
}
require 'function.php';

$username = $_SESSION['username'];
$log = "select * from masuk where username = ? and cek1 >=0 and cek2 >=0 and cek3 >=0 limit 1";
$stmt = $conn->stmt_init();
$stmt->prepare($log);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);
$conn = mysqli_connect("localhost","root","","darulmuhtar");

if (isset ($_POST["submit"])) {
     if( syarat($_POST) > 0 ){
         echo     "
          <script>
         alert('Berhasil ditambahkan!');
         document.location.href ='proses.php';
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
    Tambah Kegiatan
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
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/proses.php">
              <i class="fa fa-reply opacity-6  me-1"></i>
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
            <h2 class="text-white mb-2 mt-5">Masukkan Syarat yang diperlukan</h2>
            <p class="text-lead text-white">Masukkan Syarat dokumen untuk mengadopsi anak dengan format gambar atau PDF</p>
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
                <input type="hidden" name="id" value ="<?php echo @$user['iduser']; ?>">
                <label for="eventyayasan"> Surat Permohonan Izin Pengangkatan Anak</label>
                
                <td><?php if($user["cek1"]== 0){?>
                        <input type="hidden" name="cek1" value ="1">
                        <input type="file" name="surat1" class="form-control" id="surat1" value="<?php echo @$user['surat1']?>">
                    <?php } else if ($user["cek1"]== 1){?>
                        <p class= "text-success"> sudah </p>
                    <?php } ?> </td>
                    <br>

                    <label for="eventyayasan"> KTP</label>
                    <td><?php if($user["cek2"]== 0){?>
                            <input type="hidden" name="cek2" value ="1">
                            <input type="file" name="surat2" class="form-control" id="surat2" value="<?php echo @$user['surat2']?>">
                        <?php } else if ($user["cek2"]== 1){?>
                            <p class= "text-success"> sudah </p>
                        <?php } ?> 
                    </td>
                        <br>

                    <label for="eventyayasan"> Kartu Keluarga</label>
                        <td><?php if($user["cek3"]== 0){?>
                                <input type="hidden" name="cek3" value ="1">
                                <input type="file" name="surat3" class="form-control" id="surat3" value="<?php echo @$user['surat3']?>">
                                <?php } else if ($user["cek3"]== 1){?>
                                <p class= "text-success"> sudah </p>
                            <?php } ?> 
                        </td>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"id="submit" name="submit">Submit!</button>
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