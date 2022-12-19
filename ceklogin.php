<?php 
$conn = mysqli_connect("localhost","root","","darulmuhtar");
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
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
?>