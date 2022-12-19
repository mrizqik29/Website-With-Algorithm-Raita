<?php
session_start();
$conn = mysqli_connect("localhost","root","","darulmuhtar");
if (isset($_POST["login"])){
  // menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from masuk where username='$username'");
// menghitung jumlah data yang ditemukan

 
// cek apakah username dan password di temukan pada database
if(mysqli_num_rows($login) === 1){
	
	$data = mysqli_fetch_assoc($login);
	if (password_verify($password, $data["password"])){
	  
	// cek jika user login sebagai admin
	if($data['level']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin.php");
 
	// cek jika user login sebagai pegawai
		}else if($data['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";
		// alihkan ke halaman dashboard pegawai
		header("location:user.php");
 
			}else{
		// alihkan ke halaman login kembali
		header("location:sign-in.php?pesan=gagal");
		exit;
			}
		}	
	}
	$error = true;
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
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">

      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Login</h4>
                  <p class="mb-0">Masukkan username dan password</p>
                </div>

                <div class="card-body">
                  <form action="" method="post">
                  <?php if (isset ($error)) :?>
                    <h6 style="color :red; font-style : italic;">Username atau Password salah</h6>
                   <?php endif; ?>
                    <div class="mb-3">
                      <label for="username">Username</label>
                      <input type="text" name="username" id="username"class="form-control form-control-lg" placeholder="Username" aria-label="Email">
                    </div>
                    <div class="mb-3">
                      <label for=password>Password</label>
                      <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" >
                    </div>
                    <div class="">
                      <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>

                   

                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Tidak Punya Akun ? 
                    <a href="registrasi.php" class="text-primary text-gradient font-weight-bold">Registrasi</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-light h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('../assets/img/bg-yayasan.png');;
          background-size: cover;">
                <span class="mask  opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Yayasan Darul Muhtar"</h4>
                <p class="text-white position-relative">Yayasan Darul Muhtar adalah tempat penampungan anak yatim yang diperuntukkan agar anak yatim tersebut bisa hidup dengan sejahtera</p>
              </div>
            </div>
          </div>
        </div>
      </div>
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