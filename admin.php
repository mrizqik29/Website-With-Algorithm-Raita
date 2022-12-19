<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: admin.php");
    exit;
}

require 'function.php';
$jumlahay = mysqli_query($conn," SELECT * FROM anakyatim");
$jumlahpeserta = mysqli_num_rows($jumlahay);
$jumlahdataperhalaman = 800;
$jumlahdata = count(query("SELECT * FROM anakyatim"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$aktifhalaman = isset ($_GET["halaman"])  ?$_GET["halaman"] : 1;
$dataawal = ($aktifhalaman >1) ? ($jumlahdataperhalaman * $aktifhalaman) - $jumlahdataperhalaman : 0;
$peserta = query ("SELECT nama, gambar, pendidikan, tanggal, umur, jeniskelamin, id FROM anakyatim LIMIT $dataawal, $jumlahdataperhalaman");
asort($peserta);

//*algo raita 
$awal = microtime(true);
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
//*$awal = microtime(true);
if (isset ($_POST ["search"])){
  //*$peserta = search($_POST["keyword"]);
 
  if($_POST["keyword"] != null ){
    $pattern = $_POST ["keyword"];
   $algoraita = new raita();
    
    foreach ($peserta as $row){ 
            $alnama = $algoraita->search(strtolower($row["nama"]),$pattern);
             if ($alnama==true){
               $peserta = search($pattern);
                }
           $alsekolah = $algoraita->search(strtolower($row["pendidikan"]),$pattern);
             if ($alsekolah==true){
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
//*$akhir = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];;
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

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active p-2 " href="../pages/admin.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-users text-white text-sm opacity-10"></i>
          </div> 
            <span class="nav-link-text ms-1 text-white">Data Anak Yatim</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="../pages/tambahdata.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa fa-user-plus text-info text-sm opacity-10"></i>
          </div>
            <span class="nav-link-text ms-1">Tambah Data</span>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa fa-cogs text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Menu Setting</span>
          </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="../pages/fotokergiatan.php">Foto Kegiatan</a>
              <a class="dropdown-item" href="../pages/rutin.php">Kegiatan Rutin</a>
              <a class="dropdown-item" href="../pages/kegiatanyayasan.php">Kegiatan Yayasan</a>
              <a class="dropdown-item" href="../pages/prestasi.php">Prestasi Anak Yatim</a>
            </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../pages/konfir.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa fa-user text-info text-sm opacity-10"></i>
          </div>
            <span class="nav-link-text ms-1">Adopsi</span>
          </a>
        </li>

        <li class="nav-item justify-content-end ">
          <a class="nav-link " href="../pages/logout.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-end">
          <i class="fas fa-sign-out-alt text-info text-sm opacity-10"></i>
          </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
        </ul>
    </nav>
  </div>
</aside>
  <main class="main-content position-relative border-radius-lg ">
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          </ol>
          <h4 class="font-weight-bolder text-white mb-0">Data Anak Yatim</h4>
          <br>
          <!--<h6 class="font-weight-bolder text-white mb-0">Pages</h6>-->
          <!--<div class="number">
        
        <?php if ($aktifhalaman > 1) : ?>
            <a href="?halaman=<?= $aktifhalaman - 1; ?>" class=" text-white">&laquo;</a>
        <?php endif; ?>
    
        <?php for ( $i = 1; $i <= $jumlahhalaman; $i++) : ?>
        <?php if ( $i == $aktifhalaman ) : ?>
            <a href="?halaman?<?= $i; ?>" class="diklik text-white"><?= $i; ?></a> 
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    
    <?php if ($aktifhalaman < $jumlahhalaman) : ?>
            <a href="?halaman=<?= $aktifhalaman + 1; ?>" class=" text-white">&raquo;</a>
        <?php endif; ?>
        </div>-->
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-ms-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-ms-3 d-flex justify-content-end">
            <div class="input-group d-flex justify-content-end">
              <div>
              <form action="" method="post"enctype="multipart/form-data">
              <input type="text" name="keyword"  class="form-control"
               autofocus placeholder="Pencarian" autocomplete="off"></div>
              <div>
               <button type="submit" name="search"class="search btn btn-primary btn btn-outline-dark d-flex justify-content-end" 
              style="border-radius: 5px;">Search</button></div>
        </form>
            </div>
          </div>
       
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4 " >
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Anak Yatim</h6>
              <h7> Waktu Pencarian : <?=$akhir ?></h7>
            </div>

            <div class="card-body px-0 pt-0 pb-2" style="height: 700px; width:100%; display:block; overflow:scroll;" >
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Umur</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sekolah</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = $dataawal + 1;?>
                <?php foreach ($peserta as $row): 
    
            
                ?>
        <tr>
        <td> <?= $i; ?></td>
        <td><?php echo "<img src='../pages/upload/$row[gambar]' width='80'/>";?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["jeniskelamin"]; ?></td>
        <td><?= $row["umur"]?> </td>
           <td><?= $row["pendidikan"]; ?> </td>
           <td>

           <a href="editt.php?id=<?= $row["id"];  ?>" class="text-secondary font-weight-bold text-xs" >
           <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
           <i class="fas fa-edit text-info text-sm opacity-10"></i>
                </div> </a>
           <a href="hapus.php?id=<?= $row["id"];  ?>"  class="text-secondary font-weight-bold text-xs"  onclick="return confirm ('Setuju?');">
           <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
           <i class="fas fa-trash text-info text-sm opacity-10" ></i>
            </div> </a>
            <a href="liat.php?id=<?= $row["id"];  ?>" class="text-secondary font-weight-bold text-xs">
           <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
           <i class="fa fa-ellipsis-h text-info text-sm opacity-10"></i>
            </div> </a>
                </td>
           </tr>
          
        <?php $i++; ?>
        <?php endforeach; ?>                          
                  </tbody>
                  </div>
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