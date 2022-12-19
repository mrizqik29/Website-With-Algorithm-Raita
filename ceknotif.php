<?php 
require 'function.php';
$conn = mysqli_connect("localhost","root","","darulmuhtar");

	$pesan = "SELECT count (ortuangkat) as jml FROM anakyatim WHERE status='tunggukonfirmasi' ";
	if($result=mysqli_query($conn,$pesan)) {
		$row = mysqli_fetch_assoc($result);
                echo $row['jml'];
	}
?>