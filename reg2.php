<?php
include "config.php";
$bertemu = $_GET['bertemu'];

$sql = mysqli_query($connect, "SELECT * FROM department WHERE kode_d='$bertemu'");
$kode = mysqli_fetch_array($sql);

$data = array(
	'kode' => $kode['kode_d'],
	'nama' => $kode['nama_d'],
);

echo json_encode($data);
?>