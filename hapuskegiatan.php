<?php
require 'function.php';

$id = $_GET ["idname"];

if ( hapuskegiatan ($id) > 0){
    echo "
    <script>
        alert('data berhasil dihapus!');
        document.location.href ='fotokergiatan.php';
    </script>
 ";
} else {
    echo "
    <script>
        alert('data gagal dihapus!');
        document.location.href ='fotokergiatan.php';
    </script>
 ";
}
?>