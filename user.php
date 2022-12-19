<?php
session_start();


require 'function.php';
//* profile user
$username = $_SESSION['username'];
$log = "select * from masuk where username = ? limit 1";
$stmt = $conn->stmt_init();
$stmt->prepare($log);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);

$jumlahay = mysqli_query($conn," SELECT * FROM anakyatim");
$gambar= 1;
$jumlahpeserta = mysqli_num_rows($jumlahay);
$kegiatan = query ("SELECT idname, judul, kegiatan, foto FROM kegiatan LIMIT $gambar");
$rutin = query("SELECT * FROM rutin");
$event = query("SELECT * FROM kegiatanyayasan");
$prestasi = query("SELECT * FROM lomba");
$kegiatan1 = "SELECT * FROM kegiatan";
$result = $conn-> query($kegiatan1); 
 
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
   position: bottom;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #344767;
   color: white;
   text-align: center;
}
</style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
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
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top navbar-inverse">
      <a class="navbar-brand " href="admin.php" target="_blank">
        <img src="../assets/img/logotampilan.png" style="width:300px;" alt="main_logo">
      </a>
      <hr class="horizontal ">
      
      <div class="">
      
        <ul class="navbar-nav float-end">
        <li class="nav-item ">
          <a class="nav-link active p-2 " href="../pages/user.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-home text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-info">Menu</span>
          </a>
        </li>

        <li class="nav-item ">
        <a class="nav-link active p-2" href="../pages/tableuser.php">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-white text-sm "></i>
        </div>
            <span class="nav-link-text text-white">Data Anak Yatim</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link " href="../pages/proses.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-child text-info text-sm "></i>
          </div>
            <span class="nav-link-text text-info">Proses Adopsi</span>
          </a>
        </li>
        </ul>
        </div>

        <!-- Profile -->
        <div class="nav-item dropdown text-end">
          <a class="nav-link dropdown-toggle text-white " data-toggle="dropdown" href="#">
          <span class="nav-link-text ms-1 text-white ">Hallo, <?php echo @$user["username"]; ?></span>
          </a>
            <div class="dropdown-menu">
              <dl>
              <dt class= "text-center">Nama</dt>
              <dd class="dropdown-header text-center"><?php echo @$user["namauser"]; ?></dd>
              <dt class= "text-center"> No.Hp</dt>
              <dd class="dropdown-header text-center"><?php echo @$user["nouser"]; ?></dd>
              <dt class= "text-center">Alamat </dt>
              <dd class="dropdown-header text-center"><?php echo @$user["alamatuser"]; ?></dd>
              </dl>
          <div class="container">
            <a href="../pages/editprofile.php" class=" nav-link btn btn-primary" >
            <i class="fas fa-user-edit text-info text-sm "></i>
            <span class="nav-link-text text-white">Edit Profile</span>
            </a>
          </div>
          
          <div class="container">
          <a class="nav-link btn btn-primary" href="../pages/logout.php">
              <i class="fa fa-sign-out text-info text-sm "></i>
            <span class="nav-link-text text-white">Logout</span>
          </a>
          </div>
            </div>
        </div>
        <!-- Profile -->
        
    </nav>
    </div> 
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->

    <!-- End Navbar -->
<!-- Gambar Kegiatan -->
    <div class="row">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="card bg-primary">
        <ol class="carousel-indicators">
          <?php
          for($i=0; $i< $result->num_rows; $i++){
          echo'<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
          if($i==0){echo'class="active"';}echo'></li>';
          }
          ?>
        </ol>
      <div class="carousel-inner">
        <?php
          if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
            if($row['idname'] == 1){echo'<div class="carousel-item active">';}
              else{echo'<div class="carousel-item">';}
              echo'
                <img src="../pages/kegiatan/'.$row['foto'].'" class= "rounded" width ="100%" height="auto" alt="'.$row['judul'].'">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-white">'.$row['judul'].'</h5>
                    <p>'.$row['kegiatan'].'</p>
                </div>  
              </div>';
          }}?>
      </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>
    </div>
    <!-- END Gambar Kegiatan -->
    <div class="container-fluid py-4">
    <div class="row">
<!-- Kolom Donasi -->
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card" >
            <div class="card-body p-3">
              <div class="row">
                <div class="col">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Donasi untuk Anak Yatim </p>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#donasis">
                     Donasi 
                    </button>

                      <!-- Donasi -->
                      <div class="modal fade" id="donasis">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Donasi Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">QR Code Donasi</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Donasi body -->
                            <div class="modal-body text-center">
                            <td><?php echo "<img src='../assets/img/qrcode.jpeg' width='200'/>";?></td>
                            <br>
                            Pembayaran Digital via OVO
                            </div>

                            <!-- Donasi footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                          </div>
                        </div>
                      </div>
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
    <!-- Donasi End -->
<!-- jumlah anak yatim -->
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Anak Yatim </p>
                    <h5 class="font-weight-bolder">
                    <p class="jumlahay"><b><?php echo $jumlahpeserta; ?> </b></p>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow-danger text-center rounded-circle">
                    <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- END jumlah anak yatim -->
<!-- Kolom Adopsi -->
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col">
                  <div class="numbers">
                    <p class="text-sm mb-0  font-weight-bold">Google Maps Alamat</p>
                    <a type="button"class="nav-link btn btn-primary   text-white me-2 active" target="_blank" href="https://www.google.com/maps/place/Jl.+Pengadegan+Timur+II+No.5,+RT.7%2FRW.1,+Pengadegan,+Kec.+Pancoran,+Kota+Jakarta+Selatan,+Daerah+Khusus+Ibukota+Jakarta+12770/@-6.2485357,106.8616972,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69f3a8f0c9f5ad:0xf6f92add34af5ee!8m2!3d-6.2485357!4d106.8616972">
              Google Maps
                </a>
              
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
<!-- Adopsi End -->
</div>
<br>
  
  <!--Kegiatan Rutin -->
  <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Kegiatan Rutin</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>  
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Senin</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selasa</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Rabu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Kamis</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Jum'at</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sabtu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Minggu</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                
                <?php foreach ($rutin as $row): 
    
            
                ?>
        <tr>
        <td><?= $row["senin"]; ?></td>
        <td><?= $row["selasa"]; ?></td>
        <td><?= $row["rabu"]?> </td>
        <td><?= $row["kamis"]; ?> </td>
        <td><?= $row["jumat"]; ?> </td>
        <td><?= $row["sabtu"]; ?> </td>
        <td><?= $row["minggu"]; ?> </td>
            </tr>
           <?php endforeach; ?>
                            


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-- END Kegiatan Rutin -->
  
   <!--Kegiatan Yayasan -->
   <div class="row">
        <div class="col-6">
          <div class="card mb-4" style="height:500px">
            <div class="card-header pb-0">
              <h6>Kegiatan Yayasan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>  
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                
                <?php foreach ($event as $row): 
    
            
                ?>
        <tr>
        <td><?= $row["namaevent"]; ?></td>
        <td><?php echo  date('d-m-Y', strtotime($row ["tanggalevent"])); ?></td>
            </tr>
           <?php endforeach; ?>
                            


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
     
  <!-- END Kegiatan Rutin -->
  <!--Prestasi -->
  <div class="col-6">
          <div class="card mb-4" style="height:500px">
            <div class="card-header pb-0">
              <h6>Prestasi</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>  
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Anak</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prestasi</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                
                <?php foreach ($prestasi as $row): 
    
            
                ?>
        <tr>
        <td><?= $row["namaanak"]; ?></td>
        <td><?= $row ["namalomba"]?></td>
            </tr>
           <?php endforeach; ?>
                            


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
  <!-- END Prestasi -->
</div>
</main>
<!--   Footer  -->
<div class="footer">
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