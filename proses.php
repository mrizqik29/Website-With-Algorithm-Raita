<?php
session_start();


require 'function.php';
$username = $_SESSION['username'];
$log = "select * from masuk where username = ? and cek1 >=0 and cek2 >=0 and cek3>=0 and proses >=0 limit 1";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="icon" type="image/png" href="../assets/img/logoweb.png">
  <title>
  Yayaysan Darul Muhtar
  </title>
  <!-- CSS FOOTER -->
  <style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #344767;
   color: white;
   text-align: center;
}
</style>
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

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
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
            <span class="nav-link-text ms-1 ">Menu</span>
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
          <a class="nav-link active p-2 " href="../pages/proses.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-child text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Proses Adopsi</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="../pages/profile.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-user-circle text-info text-sm opacity-10"></i>
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
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
         
          <h2 class="font-weight-bolder text-white mb-0">Proses Adopsi Anak</h2>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
    <div class="row">

  
  <!--Kegiatan Rutin -->
  <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Dokumen Adopsi Anak</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>  
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Anak</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Surat Permohonan Izin Pengangkatan Anak</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">KTP</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Kartu Keluarga</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Proses</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Dokumen</th>
                    </tr>
                  </thead>
                  <tbody>
                
        <tr>
        <td><?php echo @$user ['anakcaa']; ?></td>
        
        <td><?php if($user["cek1"]== 0){?>
            <p class= "text-danger"> Belum </p>
                <?php } else if ($user["cek1"]>= 1){?>
            <p class= "text-success"> Sudah </p>

                <?php } ?> 
        </td>

        <td><?php if($user["cek2"]== 0){?>
            <p class= "text-danger"> Belum </p>
                <?php } else if ($user["cek2"]>= 1){?>
            <p class= "text-success"> Sudah </p>

                <?php } ?> 
        </td>

        <td><?php if($user["cek3"]== 0){?>
            <p class= "text-danger"> Belum </p>
                <?php } else if ($user["cek3"]>= 1){?>
            <p class= "text-success"> Sudah </p>

                <?php } ?> 
        </td>
        
        <td><?php if($user["proses"]== 1){?>
            <p class= "text-danger"> Menunggu </p>
                <?php } else if ($user["proses"]== 2){?>
            <p class= "text-success"> Konfirmasi </p>
                <?php } ?> 
        </td>

        <td>
            <!-- Button to Open the Modal -->
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Lihat
                </button>

            <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
      
             <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Dokumen untuk persyaratan adopsi anak angkat </h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
             <!-- Modal body -->
                    <div class="modal-body">
                    Surat Permohonan Izin Pengangkatan Anak
                            <br>
                            <?php if($user["cek1"]== 0){?>
                                <p class= "text-danger"> Belum </p>
                            <?php } else if ($user["cek1"]>= 1){?>
                                <p class= "text-success"> <?php echo "<img src='../pages/syarat/$user[surat1]' width='80'/>";?> </p>
                            <?php } ?>
                    
                            <br>
                     KTP
                            <br>
                            <?php if($user["cek2"]== 0){?>
                                <p class= "text-danger"> Belum </p>
                            <?php } else if ($user["cek2"]>= 1){?>
                                <p class= "text-success"> <?php echo "<img src='../pages/syarat/$user[surat2]' width='80'/>";?> </p>
                            <?php } ?>
                            
                            <br>
                     Kartu Keluarga
                            <br>
                            <?php if($user["cek3"]== 0){?>
                                <p class= "text-danger"> Belum </p>
                            <?php } else if ($user["cek3"]>= 1){?>
                                <p class= "text-success"> <?php echo "<img src='../pages/syarat/$user[surat3]' width='80'/>";?> </p>
                            <?php } ?>
                     </div>
            <!-- Donasi footer -->
                            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a class="nav-link btn btn-primary  text-white me-2 active" href="../pages/editproses.php?iduser=<?= $user["iduser"];  ?>">
              Edit Data
                </a>
            <a class="nav-link btn btn-primary  text-white me-2 active" href="../pages/tambahsyarat.php?id=<?= $user["iduser"];  ?>">
              Masukkan Data
                </a>

                            </div>
                        

        
                            </div>
                        </div>
                    </div>     
        </td>
            </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-- END Kegiatan Rutin -->
</div>
</main>
<!--   Footer  -->
<div class="footer fixed">
  <h3 class="text-white">Alamat</h3>
  <p> Jl. Pengadegan Timur II No.5, RT.7/RW.2, Pengadegan, Kec. Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12770</p>
  <h3 class="text-white">No Telp</h3>
  <p>0857-5486-254</p>
</div>
<!--   END FOOTER  --> 

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.2"></script>
</body>

</html>