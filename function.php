<?php
$conn = mysqli_connect("localhost","root","","darulmuhtar");


function query($query) {
    global $conn;
    $result = mysqli_query ($conn, $query);
    if(!$result){
        echo mysqli_error($conn);
    }
    $rows =[];
    while ( $row = mysqli_fetch_assoc ($result) ) {
        $rows[] = $row;
    }
    return $rows;
}
//*-----------------------------------------------------UPLOAD ADOPSI ------------------------------------------------------
function adop ($data){
    global $conn; 
    
    $user = $data ["id"];
    $idanak = $data ["idanak"];
    $proses = $data ["proses"];
    $nama = $data ["nama"];
    $query = "UPDATE masuk SET 
    anakcaa ='$nama',
    idanakcaa = '$idanak',
    proses ='$proses'
    WHERE iduser = $user
";
    
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

function idangkat ($data){
    global $conn; 
    
    $idanak = $data ["idanak"];
    $prosesanak = $data ["prosesanak"];

    $query = "UPDATE anakyatim SET 
    id_angkat ='$prosesanak'
    WHERE id = $idanak
";
    
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}
//*-----------------------------------------------------UNTUK TAMBAH DATA ---------------------------------------------------
function tambah($data){
    global $conn;
    
    $nama = htmlspecialchars($data ["nama"]);
    $tanggal = htmlspecialchars ($data ["tanggal"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars ($data ["alamat"]);
    $notelp =htmlspecialchars ($data ["notelp"]);
    $ibu = htmlspecialchars ($data ["ibu"]);
    $pendidikan = htmlspecialchars($data ["pendidikan"]);
//*umur
$umurku = new DateTime($data["tanggal"]);
$sekarang = new DateTime();
$usia =$umurku->diff($sekarang);
$umur2 = $usia->y. " Tahun";
$umur3 = $usia->m. " Bulan";

   

    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    $query= "INSERT INTO anakyatim (id, nama,jeniskelamin,tanggal,alamat,notelp,ibu,pendidikan, gambar, umur)
    VALUES 
    ('','$nama','$jeniskelamin','$tanggal','$alamat','$notelp','$ibu','$pendidikan','$gambar','$umur2 $umur3')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
   
}

function tambahkegiatan($data){
    global $conn;
    
    $judul = htmlspecialchars($data ["judul"]);
    $kegiatan = htmlspecialchars ($data ["kegiatan"]);
    $foto = uploadkegiatan();
    if(!$foto) {
        return false;
    }

    $query= "INSERT INTO kegiatan (idname, judul, kegiatan, foto)
    VALUES 
    ('','$judul','$kegiatan','$foto')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);  
}

function tambahevent($data){
    global $conn;
    
    $judulyayasan = htmlspecialchars($data ["eventyayasan"]);
    $tanggalyayasan = htmlspecialchars ($data ["tanggalkegiatan"]);
    $query= "INSERT INTO kegiatanyayasan (idevent, namaevent, tanggalevent)
    VALUES 
    ('','$judulyayasan','$tanggalyayasan')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);  
}

function tambahrutin($data){
    global $conn;
    
    $senin = htmlspecialchars($data ["senin"]);
    $selasa = htmlspecialchars ($data ["selasa"]);
    $rabu = htmlspecialchars ($data ["rabu"]);
    $kamis = htmlspecialchars ($data ["kamis"]);
    $jumat = htmlspecialchars ($data ["jumat"]);
    $sabtu = htmlspecialchars ($data ["sabtu"]);
    $minggu = htmlspecialchars ($data ["minggu"]);
    $query= "INSERT INTO rutin (id_rutin, senin, selasa, rabu, kamis, jumat, sabtu, minggu)
    VALUES 
    ('','$senin','$selasa','$rabu','$kamis','$jumat','$sabtu','$minggu')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn); 
}

function tambahprestasi($data){
    global $conn;
    
    $lomba = htmlspecialchars($data ["lomba"]);
    $prestasi = htmlspecialchars ($data ["anak"]);
    $anak = query("SELECT nama FROM anakyatim WHERE id=$prestasi");
    $anak2 = $anak[0]['nama'];

    $query = "INSERT INTO lomba (idlomba, namalomba, namaanak, idanaklomba)
    VALUES 
    ('','$lomba','$anak2','$prestasi')
    ";
   mysqli_query($conn, $query);
    return mysqli_affected_rows($conn); 
}

function updateanak($data){
    global $conn;
    
    $lomba = htmlspecialchars ($data ["lomba"]);
    $prestasi = htmlspecialchars ($data ["anak"]);
    $query ="UPDATE anakyatim SET 
    prestasi ='$lomba'
    WHERE id = $prestasi
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn); 
}

function syarat($data){
    global $conn;
    $id = $data ["id"];
    $cek1 = $data ["cek1"];
    $cek2 = $data ["cek2"];
    $cek3 = $data ["cek3"];
    $surat1 = surat1();
    if(!$surat1) {
        return false;
    }

    $surat2 = surat2();
    if(!$surat2) {
        return false;
    }

    $surat3 = surat3();
    if(!$surat3) {
        return false;
    }

    $query = "UPDATE masuk SET 
    surat1 ='$surat1',
    surat2 ='$surat2',
    surat3 = '$surat3',
    cek1 = '$cek1',
    cek2 = '$cek2',
    cek3 = '$cek3'
    WHERE iduser =$id AND cek1 = 0 AND cek2 = 0 AND cek3 = 0
";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn); 

}
//*-----------------------------------------------------UPLOAD FOTO ------------------------------------------------------

function uploadkegiatan(){

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName =$_FILES['foto']['tmp_name'];

    if ( $error === 4 ){
        echo"<script>
                alert('Masukkan Gambar!');
            </script>";
        return false;
    }
  

    $ekstensiGambarValid = array ('jpg','jpeg','png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert ('Masukkan Gambar!');
        </script>";
        return false;
    }
    

    if ($ukuranFile > 3000000){
        echo "<script>
            alert ('ukuran gambar terlalu besar!);
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .=$ekstensiGambar;

    move_uploaded_file($tmpName, '../pages/kegiatan/'. $namaFileBaru);

    return $namaFileBaru;
    

}

function surat1(){

    $namaFile = $_FILES['surat1']['name'];
    $ukuranFile = $_FILES['surat1']['size'];
    $error = $_FILES['surat1']['error'];
    $tmpName =$_FILES['surat1']['tmp_name'];

    if ( $error === 4 ){
        echo"<script>
                alert('Masukkan Gambar!');
            </script>";
        return false;
    }
  

    $ekstensiGambarValid = array ('jpg','jpeg','png','pdf');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert ('Masukkan Gambar!');
        </script>";
        return false;
    }
    

    if ($ukuranFile > 3000000){
        echo "<script>
            alert ('ukuran gambar terlalu besar!);
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .=$ekstensiGambar;

    move_uploaded_file($tmpName, '../pages/syarat/'. $namaFileBaru);

    return $namaFileBaru;
    

}
function surat2(){

    $namaFile = $_FILES['surat2']['name'];
    $ukuranFile = $_FILES['surat2']['size'];
    $error = $_FILES['surat2']['error'];
    $tmpName =$_FILES['surat2']['tmp_name'];

    if ( $error === 4 ){
        echo"<script>
                alert('Masukkan Gambar!');
            </script>";
        return false;
    }
  

    $ekstensiGambarValid = array ('jpg','jpeg','png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert ('Masukkan Gambar!');
        </script>";
        return false;
    }
    

    if ($ukuranFile > 3000000){
        echo "<script>
            alert ('ukuran gambar terlalu besar!);
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .=$ekstensiGambar;

    move_uploaded_file($tmpName, '../pages/syarat/'. $namaFileBaru);

    return $namaFileBaru;
}
function surat3(){

    $namaFile = $_FILES['surat3']['name'];
    $ukuranFile = $_FILES['surat3']['size'];
    $error = $_FILES['surat3']['error'];
    $tmpName =$_FILES['surat3']['tmp_name'];

    if ( $error === 4 ){
        echo"<script>
                alert('Masukkan Gambar!');
            </script>";
        return false;
    }
  

    $ekstensiGambarValid = array ('jpg','jpeg','png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert ('Masukkan Gambar!');
        </script>";
        return false;
    }
    

    if ($ukuranFile > 3000000){
        echo "<script>
            alert ('ukuran gambar terlalu besar!);
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .=$ekstensiGambar;

    move_uploaded_file($tmpName, '../pages/syarat/'. $namaFileBaru);

    return $namaFileBaru;
}
function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName =$_FILES['gambar']['tmp_name'];

    if ( $error === 4 ){
        echo"<script>
                alert('Masukkan Gambar!');
            </script>";
        return false;
    }
  

    $ekstensiGambarValid = array ('jpg','jpeg','png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert ('Masukkan Gambar!');
        </script>";
        return false;
    }
    

    if ($ukuranFile > 3000000){
        echo "<script>
            alert ('ukuran gambar terlalu besar!);
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .=$ekstensiGambar;

    move_uploaded_file($tmpName, '../pages/upload/'. $namaFileBaru);

    return $namaFileBaru;
    

}

//* --------------------------------------------FORM UNTUK FUNGSI CARI--------------------------------------------------
function search ($keyword){
    $query = "SELECT * FROM anakyatim WHERE nama LIKE '%$keyword%' OR 
                pendidikan LIKE'%$keyword%' OR
                jeniskelamin LIKE'%$keyword%' OR
                umur LIKE '%$keyword%'
";
return query($query);
}
function searchuser ($keyword){
    $query = "SELECT * FROM masuk WHERE namauser LIKE '%$keyword%' 
";
return query($query);
}

function keyword ($keyword){
    $query = "SELECT nama, umur, jeniskelamin FROM anakyatim
             WHERE nama LIKE '%$keyword%' OR 
                umur LIKE'%$keyword%' OR
                jeniskelamin LIKE '%$keyword%'
";
return query($query);
}

//* --------------------------------------------FORM UNTUK FUNGSI HAPUS--------------------------------------------------
function hapus ($id) {
    global $conn;
    $file = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM anakyatim WHERE id='$id'"));
    unlink('../pages/upload/'. $file["gambar"]);
    $delete = "DELETE FROM anakyatim WHERE id='$id'";
    mysqli_query($conn,$delete);
    return mysqli_affected_rows($conn);
}
function hapuskegiatan ($id) {
    global $conn;
    $file = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM kegiatan WHERE idname='$id'"));
    unlink('../pages/kegiatan/'. $file["foto"]);
    $delete = "DELETE FROM kegiatan WHERE idname='$id'";
    mysqli_query($conn,$delete);
    return mysqli_affected_rows($conn);
}

function hapusrutin ($id) {
    global $conn;
    $delete = "DELETE FROM rutin WHERE id_rutin='$id'";
    mysqli_query($conn,$delete);
    return mysqli_affected_rows($conn);
}
function hapusprestasi ($data) {
    global $conn;
    $id = $data ["idlomba"];
    $delete = "DELETE FROM lomba WHERE idlomba='$id'";
    mysqli_query($conn,$delete);
    return mysqli_affected_rows($conn);
}
//* --------------------------------------------FORM UNTUK FUNGSI EDIT--------------------------------------------------

function edit ($data){
global $conn;
$id = $data ["id"];
$nama = htmlspecialchars($data ["nama"]);
$tanggal = htmlspecialchars ($data["tanggal"]);
$jeniskelamin= htmlspecialchars($data["jeniskelamin"]);
$alamat = htmlspecialchars ($data["alamat"]);
$notelp =htmlspecialchars ($data["notelp"]);
$ibu = htmlspecialchars ($data["ibu"]);
$pendidikan = htmlspecialchars($data["pendidikan"]);
$gambarlama = htmlspecialchars($data["gambarlama"]);
//*umur
$umurku = new DateTime($data["tanggal"]);
$sekarang = new DateTime();
$usia =$umurku->diff($sekarang);
$umur2 = $usia->y. " Tahun";
$umur3 = $usia->m. " Bulan";

if ( $_FILES ['gambar']['error'] === 4 ){
    $gambar = $gambarlama;
}else {
    $gambar = upload();
}

$query = "UPDATE anakyatim SET 
    nama ='$nama',
    tanggal ='$tanggal',
    jeniskelamin ='$jeniskelamin',
    alamat ='$alamat',
    notelp ='$notelp',
    ibu ='$ibu',
    pendidikan ='$pendidikan',
    gambar ='$gambar',
    umur ='$umur2 $umur3'
    WHERE id = $id
";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}



function editkegiatan ($data){
    global $conn;
    $idname = $data ["idname"];
    $judul = htmlspecialchars($data ["judul"]);
    $kegiatan = htmlspecialchars ($data["kegiatan"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    if ( $_FILES ['foto']['error'] === 4 ){
        $foto = $gambarlama;
    }else {
        $foto = uploadkegiatan();
    }
    
    $query = "UPDATE kegiatan SET 
        judul ='$judul',
        kegiatan ='$kegiatan',
        foto ='$foto'
        WHERE idname = $idname
    ";
    
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
    }

function editproses ($data){
    global $conn;
    $iduser = $data ["iduser"];
    $surat1lama = htmlspecialchars($data["surat1lama"]);
    $surat2lama = htmlspecialchars($data["surat2lama"]);
    $surat3lama = htmlspecialchars($data["surat3lama"]);

    if ( $_FILES ['surat1']['error'] === 4 ){
        $surat1 = $surat1lama;
    }else {
        $surat1 = surat1 ();
    }
    if ( $_FILES ['surat2']['error'] === 4 ){
        $surat2 = $surat2lama;
    }else {
        $surat2 = surat2 ();
    }
    if ( $_FILES ['surat3']['error'] === 4 ){
        $surat3 = $surat3lama;
    }else {
        $surat3 = surat3 ();
    }
    
    $query = "UPDATE masuk SET 
        surat1 ='$surat1',
        surat2 ='$surat2',
        surat3 ='$surat3'
        WHERE iduser = $iduser
    ";
    
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
    }

function editrutin ($data){
    global $conn;
    $id_rutin = $data ["id_rutin"];
    $senin = htmlspecialchars($data ["senin"]);
    $selasa = htmlspecialchars ($data ["selasa"]);
    $rabu = htmlspecialchars ($data ["rabu"]);
    $kamis = htmlspecialchars ($data ["kamis"]);
    $jumat = htmlspecialchars ($data ["jumat"]);
    $sabtu = htmlspecialchars ($data ["sabtu"]);
    $minggu = htmlspecialchars ($data ["minggu"]);
    $query = "UPDATE rutin SET 
             senin ='$senin',
             selasa ='$selasa',
             rabu ='$rabu',
             kamis ='$kamis',
             jumat ='$jumat',
             sabtu ='$sabtu',
             minggu ='$minggu'
             WHERE id_rutin = $id_rutin
        ";
        
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
        }

function editevent ($data){
    global $conn;
    $idevent = $data ["idevent"];
    $namaevent = htmlspecialchars($data ["namaevent"]);
    $tanggalevent = htmlspecialchars ($data["tanggalevent"]);
    $query = "UPDATE kegiatanyayasan SET 
             namaevent ='$namaevent',
             tanggalevent ='$tanggalevent'
             WHERE idevent = $idevent
        ";
        
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
        } 
function hapusproses ($data){
    global $conn;
    $id = $data ["id"];  
    $query = "UPDATE masuk SET 
             proses ='0',
             surat1 ='',
             surat2 ='',
             surat3 ='',
             cek1 ='0',
             cek2 ='0',
             cek3 ='0',
             anakcaa ='',
             idanakcaa ='0'
             WHERE iduser = $id
        ";
        
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
} 
function hapusidangkat($data){
    global $conn;
    $idanakyatim = $data ["idanakyatim"];

    $query= "UPDATE anakyatim SET
    id_angkat = '0'
    WHERE id = $idanakyatim
     ";
      mysqli_query($conn, $query);
        
      return mysqli_affected_rows($conn);
}
function updateprestasi($data){
    global $conn;
    $idanakyatim = $data ["idanaklomba"];

    $query= "UPDATE anakyatim SET
    prestasi = ''
    WHERE id = $idanakyatim
     ";
      mysqli_query($conn, $query);
        
      return mysqli_affected_rows($conn);
}
function editprestasi ($data){
            global $conn;
            $idlomba = $data ["idlomba"];
            $namalomba = htmlspecialchars($data ["namalomba"]);
            $anakprestasi = htmlspecialchars ($data["namaanak"]);
            $anak = query("SELECT nama FROM anakyatim WHERE id=$anakprestasi");
            $anak2 = $anak[0]['nama'];
            $query = "UPDATE lomba SET 
                     namalomba ='$namalomba',
                     namaanak ='$anak2'
                     WHERE idlomba = $idlomba
                ";
                
                mysqli_query($conn, $query);
                
                return mysqli_affected_rows($conn);
                } 
function editpassword ($data){
            global $conn;
            $iduser = $data ["iduser"];
            $passwordbaru = mysqli_real_escape_string($conn, $data["passwordbaru"]);
            $password2 = mysqli_real_escape_string($conn, $data["password2"]);
            if ($passwordbaru !== $password2){
                echo"<script>
                alert('konfirmasi password berbeda');
                </script>";
                return false;
            }
        
            $passwordbaru = password_hash($passwordbaru, PASSWORD_DEFAULT);
            $query = "UPDATE masuk SET
                     password ='$passwordbaru'
                     WHERE iduser = $iduser
                ";
                
                mysqli_query($conn, $query);
                
                return mysqli_affected_rows($conn);
                }
function editprofile ($data){
    global $conn;
    $iduser = $data ["iduser"];
    $namauser = htmlspecialchars($data ["namauser"]);
    $tanggaluser = htmlspecialchars ($data["tanggaluser"]);
    $alamatuser = htmlspecialchars ($data["alamatuser"]);
    $nouser = htmlspecialchars ($data["nouser"]);
    $username = htmlspecialchars ($data["username"]);
                
    $query = "UPDATE masuk SET 
            namauser ='$namauser',
            tanggaluser ='$tanggaluser',
            alamatuser ='$alamatuser',
            nouser ='$nouser',
            username ='$username'
            WHERE iduser = $iduser
            ";
                        
    mysqli_query($conn, $query);
                        
    return mysqli_affected_rows($conn);
} 
 //* --------------------------------------------FORM UNTUK FUNGSI PERHITUNGAN--------------------------------------------------
function perhitungan($data){
    global $conn;
    $id = $data ["id"];
    $total = htmlspecialchars ($data["total"]);
    $totalspp = htmlspecialchars($data["totalspp"]);
    $bulan = htmlspecialchars($data["bulan"]);
    $daftar = htmlspecialchars($data["daftar"]);
    $baju = htmlspecialchars($data["baju"]);
    $buku = htmlspecialchars($data["buku"]);
    $query = "UPDATE anakyatim SET 
    total = '$total',
    totalspp ='$totalspp',
    bulan = '$bulan',
    daftar = '$daftar',
    baju = '$baju',
    buku ='$buku'
    WHERE id =$id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
   
}

function edit2($data){
    global $conn;
    $id = $data ["id"];
    $pendidikan = htmlspecialchars($data ["pendidikan"]);
    $spp = htmlspecialchars ($data["spp"]);
    $query = "UPDATE anakyatim SET
    pendidikan = '$pendidikan',
    spp = '$spp'
    WHERE id=$id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
//* --------------------------------------------FORM UNTUK FUNGSI REGISTASI--------------------------------------------------
function registrasi($data){
    global $conn;
   
    $namauser = htmlspecialchars ($data["namauser"]);
    $tanggaluser = htmlspecialchars ($data["tanggaluser"]);
    $alamatuser = htmlspecialchars ($data["alamatuser"]);
    $nouser = htmlspecialchars($data["nouser"]);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $level = htmlspecialchars ($data["level"]);

    $result = mysqli_query($conn, "SELECT username FROM masuk WHERE username = '$username' ");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert ('username telah ada')
        </script>";
        return false;
    }

    if ($password !== $password2){
        echo"<script>
        alert('konfirmasi password berbeda');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO masuk VALUES ('','$namauser','$tanggaluser','$alamatuser','$nouser','$username','$password','$level')");

    return mysqli_affected_rows($conn);
}


//* --------------------------------------------FORM UNTUK FUNGSI KONFIRMASI--------------------------------------------------
function terimadata ($data){
    global $conn;
    $id = $data ["id"];
    $cek1 = $data ["cek1"];
    $cek2 = $data ["cek2"];
    $cek3 = $data ["cek3"];

    $query = "UPDATE masuk SET 
        cek1 ='$cek1',
        cek2 ='$cek2',
        cek3 ='$cek3'
        WHERE iduser = $id
    ";
    
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
    }
function konfirmasidata ($data){
        global $conn;
        $id = $data ["id"];
        $proses = $data ["proses"];
        $query = "UPDATE masuk SET 
            proses ='$proses'
            WHERE iduser = $id
        ";
        
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
        }
?>