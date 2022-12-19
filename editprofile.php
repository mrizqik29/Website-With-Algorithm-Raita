<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: profile.php");
    exit;
}
require 'function.php';

$username = $_SESSION['username'];
$log = "select * from masuk where username = ? limit 1";
$stmt = $conn->stmt_init();
$stmt->prepare($log);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);

if (isset ($_POST["submit"])) {

     if( editprofile($_POST) > 0 ){
         echo "
         <script>
         alert('Data berhasil diedit!');
         document.location.href ='editprofile.php';
          </script>
         ";

     } else {
         echo "
         <script>
         alert('Data gagal diedit!');
         document.location.href ='editprofile.php';
          </script>
         ";
     }
}
if (isset ($_POST["submit2"])) {

    if( editpassword($_POST) > 0 ){
        echo "
        <script>
        alert('Data berhasil diedit!');
        document.location.href ='profile.php';
         </script>
        ";

    } else {
        echo "
        <script>
        alert('Data gagal diedit!');
        document.location.href ='profile.php';
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/user.php">
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
            <h1 class="text-white mb-2 mt-5">Edit Profile </h1>
            <p class="text-lead text-white">Silahkan Edit Profile User</p>
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
              <input type="hidden" name="iduser" value ="<?= $user["iduser"]; ?>">
                 </div>

                <div class="mb-3">
                <label for="namauser">  Nama </label>
                <input type="text" name="namauser" id="namauser"  class="form-control"required value="<?= $user ["namauser"]; ?>">
                </div>

                <div class="mb-3">
                <label for="tanggaluser"> Tanggal </label>
                <input type="date" name="tanggaluser" id="tanggaluser"  class="form-control"required value="<?= $user ["tanggaluser"]; ?>">
                </div>

                <div class="mb-3">
                <label for="alamatuser">  Alamat </label>
                <input type="text" name="alamatuser" id="alamatuser"  class="form-control"required value="<?= $user ["alamatuser"]; ?>">
                </div>

                <div class="mb-3">
                <label for="nouser"> No HP </label>
                <input type="text" name="nouser" id="nouser"  class="form-control"required value="<?= $user ["nouser"]; ?>">
                </div>

                <div class="mb-3">
                <label for="username"> Username </label>
                <input type="text" name="username" id="username"  class="form-control"required value="<?= $user ["username"]; ?>">
                </div>

                

                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"id="submit" name="submit">Simpan Data</button>
                  </div> 
                  <button type="button" class="btn btn-link w-100 my-4 mb-2" data-bs-toggle="collapse" data-bs-target="#demo">Ganti Password</button>
                <div id="demo" class="collapse">
                <div class="mb-3">
                    <label for="passwordbaru"> Password Baru </label>
                    <input type="password" name="passwordbaru" id="passwordbaru"  class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password2"> Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2"  class="form-control">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"id="submit2" name="submit2">Simpan Password</button>
                  </div> 
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