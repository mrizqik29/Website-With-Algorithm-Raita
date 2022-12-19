<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: admin.php");
    exit;
}

require 'function.php';
$peserta = query ("SELECT idname, judul, kegiatan, foto FROM kegiatan");



//* end raita

//*pencarian menggunakan algoritma raita


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
    <ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link d-flex align-items-center text-center me-2 active" aria-current="page" href="../pages/admin.php">
              <i class="fa fa-reply   me-1"></i>
              Kembali
            </a>
</li>
</ul>
</nav>
      <div class ="container">
<div class="row">
<div class="col-md-5">

</div>
</div>
</div>
        <div id="notif"></div>
<script type="text/javascript">
	$(function() {
  	  function notif() {
  	  	$('#notif').html('');
	    $.ajax({
	      url: 'cek_notif.php',
	      success: function(data) {
	        if (data.length > 0) {
	        	$('#notif').html(data);
	        }
	      }
	    });
	  }
	  
	  // Update friends list every 5 seconds.
	  setInterval(notif, 5000);
	  
	});
</script>
</div>
            </nav>
            
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          </ol>
          <h4 class="font-weight-bolder text-white mb-0">Kegiatan Yayasan Darul Muhtar</h4>
          <br>
          <div class="number">
        


        </div>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-1 me-sm-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-ms-3 d-flex  justify-content-end">
          
          </div>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <a href="tambahkegiatan.php"  class="search btn btn-primary" style="border-radius: 5px;"> 
            Tambah Kegiatan
           </a>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i =  1;?>
                <?php foreach ($peserta as $row): 
    
            
                ?>
        <tr>
        <td> <?= $i; ?></td>
        <td><?php echo "<img src='../pages/kegiatan/$row[foto]' width='80'/>";?></td>
        <td><?= $row["judul"]; ?></td>
        <td><?= $row["kegiatan"]; ?></td>
           <td>
           <a href="editkegiatan.php?idname=<?= $row["idname"];  ?>" class="text-secondary font-weight-bold text-xs" >
           <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
           <i class="fas fa-edit text-info text-sm opacity-10"></i>
                </div> </a>
           <a href="hapuskegiatan.php?idname=<?= $row["idname"];  ?>"  class="text-secondary font-weight-bold text-xs"  onclick="return confirm ('Setuju?');">
           <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
           <i class="fas fa-trash text-info text-sm opacity-10" ></i>
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