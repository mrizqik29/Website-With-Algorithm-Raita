<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: user.php");
    exit;
}

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

//*data
$jumlahay = mysqli_query($conn," SELECT * FROM anakyatim WHERE id_angkat = 0");
$jumlahpeserta = mysqli_num_rows($jumlahay);
$jumlahdataperhalaman = 300;
$jumlahdata = count(query("SELECT * FROM anakyatim WHERE id_angkat = 0"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$aktifhalaman = (isset ($_GET["halaman"]) ) ?$_GET["halaman"] : 1;
$dataawal = ($jumlahdataperhalaman * $aktifhalaman) - $jumlahdataperhalaman;
$peserta = query ("SELECT nama, gambar, umur, jeniskelamin, id FROM anakyatim WHERE id_angkat = 0 LIMIT $dataawal, $jumlahdataperhalaman ");


//* algo raita 
class raita{ 
  
  private $n, $y, $m,$x,$BmBc,$matches=false;
  private $firstCh, $secondCh, $middleCh,
  $lastCh, $temukan;
  public function search($yy, $xx) {
      $this->setText($yy);
      $this->setPattern($xx); 
      $this->raitasearch();
      return $this->report();
  }

  private function setText($yy){
      $this->n=strlen($yy);
      $this->y=str_split($yy); 
  }

  private function setPattern($xx){
      $this->m=strlen($xx);
      $this->x=str_split($xx);
      $this->raitaPreprocess();
      $this->firstCh=$this->x[0];
      $this->middleCh=$this->x[$this->m/2];
      $this->lastCh=$this->x[$this->m-1];
  }

  private function raitaPreprocess(){

      for ($i=0; $i<256; $i++)
          $this->BmBc[$i] = $this->m;
      for ($i=0; $i<$this->m - 1; $i++)
          $this->BmBc[ord($this->x[$i])] = $this->m-1-$i;
         
  }

  private function raitasearch() {

      $k = 0; 
      while ($k <= $this->n-$this->m) {
          $c = $this->y[$k+$this->m-1];
          if ($this->lastCh == $c && $this->firstCh == $this->y[$k] && $this->middleCh == $this->y[$k+$this->m/2]  ) {
            $this->matches = true; 
              break;
          } else {
              $k += $this->BmBc[ord($c)];
          }

      }
  }

  public function report(){
      return $this->matches;
  }

}
$akhir = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];;


//* end raita

//*pencarian menggunakan algoritma raita
if (isset ($_POST ["cari"])){
  
  
  if($_POST["keyword"] != null ){
    $pattern = $_POST ["keyword"];
    $algoraita = new raita();
    
    foreach ($peserta as $row){ 
            $alnama = $algoraita->search(strtolower($row["nama"]),$pattern);
              if ($alnama==true){
                  $peserta = search($pattern);
                  }
            $alkelamin = $algoraita->search(strtolower($row["jeniskelamin"]),$pattern);
                     if ($alkelamin==true){
                           $peserta = search($pattern);
                            }
            $alumur = $algoraita->search(strtolower($row["umur"]),$pattern);
                            if ($alumur==true){
                                  $peserta = search($pattern);
                                   }
    }
    
  }
 
}
//*END
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logoweb.png">
  <link rel="icon" type="image/png" href="../assets/img/logoweb.png">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <title>
    Yayasan Darul Muhtar
  </title>
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
      
      <div class="" style="width:400px">
        <form action="" method="post"enctype="multipart/form-data">
          <input type="text submit" name="keyword"  class="form-control"autofocus placeholder="Pencarian" autocomplete="off"></div>
          <button type="submit" name="cari"class="search btn btn-primary-100 disabled  d-flex "></button>
        </form>

        
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

        <div class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#">
          <span class="nav-link-text ms-1 text-white">Hallo, <?php echo @$user["username"]; ?></span>
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
      
    </nav>
    </div>  
  </aside>

  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body pb-0">
              <h6>Data Anak Yatim</h6>
              <!-- <h7> Waktu Pencarian : <?=$akhir ?></h7> -->
            </div>
            <div class="card-body px-0 pt-0 pb-2" style="height: 700px; width:100%; display:block; overflow:scroll;" >
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table table-striped">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Umur</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = $dataawal + 1;?>
                <?php foreach ($peserta as $row): 
  
                ?>
        <tr>
        <td>
              <?= $i; ?>
        </td>
        <td><?php echo "<img src='../pages/upload/$row[gambar]' width='80'/>";?></td>
        <td>
              <?= $row["nama"] ; ?>
        </td>
        <td><?= $row["jeniskelamin"] ; ?></td>
           <td><?=$row["umur"];?></td>
           <td>
            <a href="liatuser.php?id=<?= $row["id"];  ?>" class="text-secondary font-weight-bold text-xs">
           <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
           <p class="btn  btn-primary text-sm opacity-10">Lihat</p>
            </div> </a>
                </td>
           </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
                            


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">

        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">

            </div>

          </div>
        </div>
      </footer>
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