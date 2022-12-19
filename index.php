<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location: halamanlogin.php");
    exit;
}

require 'functions.php';
$jumlahay = mysqli_query($conn," SELECT * FROM peserta");
$jumlahpeserta = mysqli_num_rows($jumlahay);
$jumlahdataperhalaman = 10;
$jumlahdata = count(query("SELECT * FROM peserta"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$aktifhalaman = (isset ($_GET["halaman"]) ) ?$_GET["halaman"] : 1;
$dataawal = ($jumlahdataperhalaman * $aktifhalaman) - $jumlahdataperhalaman;

$peserta = query ("SELECT * FROM peserta LIMIT $dataawal, $jumlahdataperhalaman");

if (isset ($_POST ["search"])){
    $peserta = search ($_POST ["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yayasan Yatim Piatu</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="container">
    <div class="header">
<h1 class="judul"> Yayasan Yatim Darul Muhtar</h1>

    
    <ul>    
    <li><a href="export.php" class="export">Export</a></li>
    <li><a href="tambah.php" class="tambah">Tambah data peserta </a></li>
    <li><a href="pendidikan.php" class="pendidikan" >Pendidikan</a></li>
    <li><a href="logout.php" class="logout">LOGOUT</a></li>
    
    
    <form action="" method="post"enctype="multipart/form-data">

        <li><input type="text" name="keyword" size ="40" class="cari" autofocus 
        placeholder="Masukkan Nama atau No Telp" autocomplete="off"></li>
        <li><button type="submit" name="search"class="search">Search</button></li>
            
    </form>
   
    </ul>
    </div>

    <div class="number">
        
    <?php if ($aktifhalaman > 1) : ?>
        <a href="?halaman=<?= $aktifhalaman - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ( $i = 1; $i <= $jumlahhalaman; $i++) : ?>
    <?php if ( $i == $aktifhalaman ) : ?>
        <a href="?halaman?<?= $i; ?>" class="diklik"><?= $i; ?></a> 
    <?php else : ?>
        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if ($aktifhalaman < $jumlahhalaman) : ?>
        <a href="?halaman=<?= $aktifhalaman + 1; ?>">&raquo;</a>
    <?php endif; ?>
   <p class="jumlahay">Jumlah Anak Yatim : <b><?php echo $jumlahpeserta; ?> </b></p>
    </div>  
    </div>

    <div>
    <table class="table">
    
    <tr>
        <th>No.</th>
        <th>Foto Anak</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Umur</th>
        <th>Alamat</th>
        <th>No telp</th>
        <th>Ibu</th>
        <th>Ket</th>
    </tr>
    <?php $i = $dataawal + 1;?>
    <?php foreach ($peserta as $row): 
    
    $tanggal = $row ['tanggal'];
    $umur = new DateTime($tanggal);
    $sekarang = new DateTime();

    $usia = $sekarang->diff($umur);

    ?>
    <tr>
        <td> <?= $i; ?></td>
        
        <td> <img src="img/<?= $row['gambar'] ?>" width="80"></td>
        <td><?= $row["nama"] ; ?></td>
        <td><?php echo date('d M Y ', strtotime($row ['tanggal'])) ?></td>
        <td><?php echo $usia->y."&nbsp"."Tahun"."&nbsp"?> 
           <br> <br>  <?php echo $usia->m."&nbsp"."Bulan" ?></td>
        <td><?= $row["alamat"] ; ?></td>
        <td><?= $row["notelp"] ; ?></td>
        <td><?= $row["ibu"] ; ?></td>
        <td>
        <a href ="edit.php?id=<?= $row["id"]; ?>" class="edit">Edit</a> 
        <br>
        <br>
        <a href ="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm ('Setuju?');" class="edit">Delete</a>
        <br>
        <br> 
        
        </td>
        
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>
    </div>

</body>
</html>