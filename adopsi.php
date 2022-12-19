<?php
session_start();
if (!isset($_SESSION["username"])){
  header("Location: user.php");
  exit;
}
require 'function.php';
$username = $_SESSION["username"];
$id =$_GET ["id"];
$query = "SELECT * FROM masuk INNER JOIN anakyatim WHERE id = $id , username = ? 
          limit 1"[0];
$log = "select * from masuk where username = ? limit 1";
$stmt = $conn->stmt_init();
$stmt->prepare($log);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);
$conn = mysqli_connect("localhost","root","","darulmuhtar");
$peserta = query("SELECT nama, id FROM anakyatim WHERE id = $id")[0];

if (isset ($_POST["submit"])) {
  if( adop($_POST) > 0 && idangkat($_POST) > 0){
  echo     "
          <script>
         alert('Berhasil Memilih Anak diadopsi');
         document.location.href ='user.php';
          </script>
          ";
     } 
     else {
      echo "
      <script>
      alert('Gagal diTambahkan!');
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
    Yayasan Darul Muhtar
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
  <!-- Boostrap -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="">
<div class="min-height-300 bg-primary position-absolute w-100 "></div>
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">

      </div>
    </div>
  </div>
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
        <a class="nav-link d-flex align-items-center text-white btn btn-link me-2 active" aria-current="page" href="../pages/tableuser.php">
              <i class="fa fa-reply opacity-6 text-white me-1"></i>
              Kembali
            </a>
          <h2 class="font-weight-bolder text-white mb-0">Syarat Adopsi</h2>
        </nav>
      </div>
    </nav>
  <main class="main-content  mt-0">
    <section>
    <div class="container-fluid py-4">
            <div class="row">
            <div class=" col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3 border border-primary">
              <div class="row">
                  <div class="numbers">
    <h3>Syarat Calon Orang Tua Angkat</h3>
    <p>Pada Undang-Undang Nomor 54 Tahun 2007, dalam Pasal 13. Syarat untuk calon orang tua angkat, seperti :
    <dd>- sehat jasmani dan rohani </dd>
    <dd>- berumur paling rendah 30 tahun dan paling tinggi 55 tahun </dd>
    <dd>- beragama sama dengan agama calon anak angkat </dd>
    <dd>- berkelakuan baik dan tidak pernah dihukum karena melakukan tindak kejahatan </dd>
    <dd>- berstatus menikah paling singkat 5 tahun </dd>
    <dd>- tidak merupakan pasangan sejenis </dd>
    <dd>- tidak atau belum mempunyai anak atau hanya memiliki satu orang anak </dd>
    <dd>- dalam keadaan mampu ekonomi dan sosial </dd>
    <dd>- memperoleh persetujuan anak dan izin tertulis orang tua atau wali anak </dd>
    <dd>- membuat pernyataan tertulis bahwa pengangkatan anak adalah demi kepentingan terbaik bagi anak, kesejahteraan dan perlindungan anak </dd>
    <dd>- adanya laporan sosial dari pekerja sosial setempat </dd>
    <dd>- telah mengasuh calon anak angkat paling singkat 6 bulan, sejak izin pengasuhan diberikan </dd>
    <dd>- memperoleh izin Menteri dan/atau kepala instansi sosial </dd>
    </p>  
            </div> 
            </div>
            </div>
            </div>
            </div>
            <div class=" col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3 border border-primary">
              <div class="row">
                
                  <div class="numbers">
    <h3>Cara Pengadopsian Anak Yatim</h3>
 
    <br>
    Pertama, ajukan surat permohonan ke pengadilan di wilayah tempat tinggal calon anak angkat.
    <br>Kedua, petugas dari dinas sosial akan mengecek. Mulai dari kondisi ekonomi, tempat tinggal, penerimaan dari calon saudara angkat (bila sudah punya anak), pergaulan sosial, kondisi Kejiwaan, dan lain-lain. Pengecekan keuangan dilakukan untuk mengetahui pekerjaan tetap dan penghasilan memadai. Bagi WNA harus ada persetujuan/izin untuk mengadopsi bayi Indonesia dari instansi yang berwenang dari negara asal.
    <br>Ketiga, calon orangtua dan anak angkat diberi waktu untuk saling mengenal dan berinteraksi. Pengadilan akan mengizinkan membawa si anak untuk tinggal selama 6-12 bulan, di bawah pantauan dinas sosial.   
    <br>Keempat, menjalani persidangan dengan menghadirkan minimal dua saksi.
    <br>Kelima, permohonan disetujui atau ditolak. Bila disetujui, akan dikeluarkan surat ketetapan dari pengadilan yang berkekuatan hukum. 
    </p>  
            
            </div>
            </div>
            </div>
            </div>
            </div>
</div>
</div>
<form action="" method="post" enctype="multipart/form-data" >


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#donasis" >Setuju</button>
  <!-- Donasi -->
<div class="modal fade" id="donasis">
  <div class="modal-dialog">
    <div class="modal-content">
							<div class="form-group">
              <input type="hidden" name="idanak" value ="<?= $peserta["id"]; ?>">
              <input type="hidden" name="proses" value ="1">
              <input type="hidden" name="prosesanak" value ="1">
              <input type="hidden" name="id" value ="<?= $user["iduser"]; ?>">
                <input type="hidden" name="nama" class="form-control" id="nama" value="<?= $peserta["nama"]?>" aria-describedby="name" placeholder="Nama lengkap" autocomplete="off">
							</div>
      <!-- Donasi Header -->
      <div class="modal-header">
      
        <h4 class="modal-title">Persyaratan Dipersetujui</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Donasi body -->
      
      <div class="modal-body ">
      <td>Silahkan datang ke Alamat dibawah, dan apabila ada pertanyaan silahkan hubungi nomor yang tertera. 
      <h6>Jl. Pengadegan Timur II No.5, RT.7/RW.2, Pengadegan, Kec. Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12770</h6>
      </td>
      <h6> No.Telp 08xxxxxxxxxx </h6>
      
      </div>
      
      <!-- Donasi footer -->
      <div class="modal-footer">
      
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button class= "btn btn-primary  text-white " type="submit" id="submit" name="submit" href="../pages/user.php?id=<?= $user["iduser"]; ?>">
              Konfirmasi
        </button>
      </div>

    </div>
  </div>

<!-- Donasi End -->
  </div>
</form>
    </section>
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