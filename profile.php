<?php
session_start();

require 'koneksi.php';
$username = $_SESSION['username'];
$log = "select * from masuk where username = ? limit 1";
$stmt = $conn->stmt_init();
$stmt->prepare($log);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);
$conn = mysqli_connect("localhost","root","","darulmuhtar");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logoweb.png">
  <link rel="icon" type="image/png" href="../assets/img/logoweb.png">
  <title>
    Yayasan Darul Muhtar
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

<body class="g-sidenav-show bg-gray-100">
<div class="sidenav-header">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand " href="admin.php" target="_blank">
        <img src="../assets/img/logoweb.png" style="width:40px;" alt="main_logo">
      </a>
    <hr class="horizontal ">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link  " href="../pages/user.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-home text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Menu</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/tableuser.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Anak Yatim</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="../pages/proses.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-child text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Proses Adopsi</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active p-2" href="../pages/profile.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-user-circle text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item  ">
          <a class="nav-link " href="../pages/logout.php">
            <div class="icon icon-shape icon-sm border-radius-md col-4 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-sign-out text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
    </div>
    </div>
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->

    <!-- End Navbar -->
    <div class="card shadow-lg mx-4 ">
 
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
            </div>
            <form action="update-profile.php" method="post" enctype="multipart/form-data" >
              
              <input type="hidden" name="id" value ="<?php echo @$user["iduser"]; ?>">
              <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama</label>
                    <br>
                   <td><?php echo @$user['namauser'] ?></td>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <br>
                   <td><?php echo @$user['username'] ?></td>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Tanggal Lahir</label>
                    <br>
                    <?php echo  date('d-m-Y', strtotime(@$user ["tanggaluser"])); ?>
                  </div>
                </div>
              </div>
              
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Contact</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Address</label>
                    <br>
                    <td> <?php echo @$user ['alamatuser']; ?> </td>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">No Telepon</label>
                    <br>
                    <td> <?php echo @$user ['nouser']; ?> </td>
                  </div>
                   
          <a class="" href="../pages/editprofile.php">
            <div class="icon icon-shape icon-sm  col-4 text-center me-2">
               <span class="nav-link-text ms-1 btn btn-primary ">Edit</span>
            </div>
          </a>
                </div>
            
                </div>
              </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
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