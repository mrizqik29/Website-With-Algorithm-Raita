<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: halamanlogin.php");
    exit;
}
require 'functions.php';

$id = $_GET ["id"];

$peserta = query("SELECT * FROM peserta WHERE id = $id")[0];


if (isset ($_POST["submit"] ) ) {
   

     if( edit ($_POST) > 0 ){
         echo "
            <script>
                alert('data berhasil diedit!');
                document.location.href = 'index.php';
            </script>
         ";

     } else {
         echo "
         <script>
         alert('data gagal diedit!');
         document.location.href = 'index.php';
         </script>
         ";
     }
}
?>
<html>
<head>
<title> Edit Data Peserta </title>
<link rel="stylesheet" href="edit.css">
</head>
<body>

    <h1 class="judul">Edit Data</h1>
    <div class="editdata" >
    <p class="editdata2">Silahkan Edit Data</p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value ="<?= $peserta["id"]; ?>">
        <input type="hidden" name="gambarlama" value ="<?= $peserta["gambar"]; ?>">
        
                <label for="nama"> Nama : </label>
                <input type="text" name="nama" id="nama"  required value="<?= $peserta ["nama"]; ?>">
                <br> <br>
                <label for="tanggal"> Tanggal Lahir :  </label>
                <input type="text" name="tanggal" id="tanggal" required value ="<?= $peserta ["tanggal"]; ?>">
                <p class="tanggal">Tahun-Bulan-Hari</p>
                <label for="alamat"> Alamat Rumah : </label>
                <input type="text" name="alamat" id="alamat" required value="<?= $peserta ["alamat"]; ?>">
                <br> <br>
                <label for="notelp"> Nomor Telepon </label>
                <input type="text" name="notelp" id="notelp" required value="<?= $peserta["notelp"]; ?>">
                <br> <br>
                <label for="ibu"> Nama Orangtua : </label>
                <input type="text" name="ibu" id="ibu" required value="<?= $peserta ["ibu"]; ?>">
                <br> <br>
                <label for="gambar"> Masukkan Foto Anak: </label>
                <img src="img/<?= $peserta['gambar'] ?>" width="80"><br>
                <input type="file" name="gambar" id="gambar">
                <br> <br>
                <button type="submit" name="submit">Edit! </button>
                <br> <br>
    </form>
    <a href="index.php" class="kembali">kembali</a>
    </div>
</body>
</html>