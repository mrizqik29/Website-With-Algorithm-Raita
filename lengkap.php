<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: halamanlogin.php");
    exit;
}
require 'functions.php';

$id = $_GET ["id"];

$peserta = query("SELECT * FROM peserta WHERE id = $id")[0];

?>
<html>
<head>
<title> Edit Data </title>
<link rel="stylesheet" href="edit2.css">
</head>
<body>

    <h1>Edit Data</h1>
    <div class="editdata" >
    <p class="editdata2">Data Lengkap Biaya</p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value ="<?= $peserta["id"]; ?>">

                <label for="nama"> Nama : </label>
                <td> <?php echo  $peserta ["nama"]; ?> </td>
                <br><br>
                <label for="pendidikan"> Pendidikan : </label>
                <td> <?php echo  $peserta ["pendidikan"]; ?> </td>
                <br><br>
                <label for="spp"> Biaya Pendidikan : </label>
                <td> Rp <?php echo  $peserta ["spp"]; ?> </td>
                <br><Br>
                <label for="Bulan"> Bulan ke </label>
                <td> <?php echo  $peserta ["bulan"]; ?> </td>
                <br><br>
                <label for="totalspp"> Total SPP : </label>
                <td> Rp <?php echo  $peserta ["totalspp"]; ?> </td>
                <br><br>
                <label for="daftar"> Biaya Daftar Ulang : </label>
                <td> Rp <?php echo  $peserta ["daftar"]; ?> </td>
                <br><br>
                <label for="baju"> Biaya Seragam : </label>
                <td> Rp <?php echo  $peserta ["baju"]; ?> </td>
                <br><br>
                <label for="buku"> Biaya Buku : </label>
                <td> Rp <?php echo  $peserta ["buku"]; ?> </td>
                <br><br>
                <label for="totalspp"> Total Biaya : </label>
                <td> Rp <?php echo  $peserta ["totalspp"]; ?> </td>
                <br><br>
            
        
        <a href="pendidikan.php" class="kembali">kembali</a>
    </form>
    </div>
</body>
</html>