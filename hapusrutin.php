<?php
require 'function.php';

$id = $_GET ["id_rutin"];

if ( hapusrutin ($id) > 0){
    echo "
    <script>
        alert('data berhasil dihapus!');
        document.location.href ='rutin.php';
    </script>
 ";
} else {
    echo "
    <script>
        alert('data gagal dihapus!');
        document.location.href ='rutin.php';
    </script>
 ";
}
?>