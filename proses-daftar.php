<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"></link>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet"></link>
    <link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet"></link>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<?php

include "config.php";
include "akses.php";

if (isset($_GET['nama']) AND isset($_GET['keperluan']) AND isset($_GET['bertemu']))
{
   $nama=$_GET['nama'];
   $keperluan=$_GET['keperluan'];
   $bertemu=$_GET['bertemu'];
}
else
{
   $nama="";
   $keperluan="";
   $bertemu="";
}


if(isset($_POST['daftar'])){
    $janji = $_POST['janji'];
    $no2 = $_POST['no'];
    $no = $_POST['no_antri'];
    $nama = $_POST['nama'];
    $keperluan = $_POST['keperluan'];
    $bertemu = $_POST['bertemu'];
    $nama_d = $_POST['nama_d'];
    $suhu_tubuh = $_POST['suhu_tubuh'];
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $date = date("Y-m-d H:i:s");
    $day = date("Y-m-d");
    $time = date("H:i:s");

    
    

    $nama_image = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $tipe_file = $_FILES['foto']['type'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $path = "upload/".$nama_image;

     $query =mysqli_query($connect, "SELECT *, no_antri as maxKode,tanggal_masuk as tgl 
      FROM tamu 
      ORDER BY tanggal_masuk DESC 
      LIMIT 1");
    $data = mysqli_fetch_array($query);
    $noOrder = $data['maxKode'];
    $noUrut = (int) substr($noOrder, 9, 3);
    
    $noUrut++;
    $char = date("d");
    $tahun=substr($date, 0, 4);
    $bulan=substr($date, 5, 2);
    $id_antri = $tahun .$bulan .$char . sprintf("%04u", $noUrut);

    if($noUrut == 1000){
        
        $id_antri = $tahun .$bulan .$char . sprintf("%04u", 1);
    }
    
    if($data['tgl'] < $day){
      $id_antri = $tahun .$bulan .$char . sprintf("%04u", 1);
    }
    

    $cek = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tamu WHERE no='$no2'"));
    $cek2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM department WHERE nama_d='$bertemu'"));

if($cek>0){
    echo '<script>
        swal({
            title: "Gagal !",
            text: "",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
}
elseif ($cek2==0) {
    echo '<script>
        swal({
            title: "Department tidak ditemukan !",
            text: "",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
}
elseif($suhu_tubuh >= 37.2){
    

echo '<script>

        swal({
            title: "Suhu tubuh lebih dari 37,3 !",
            text: "Tidak bisa melanjutkan pendaftaran",
            type: "warning"
        }).then(function() {
            window.history.back();
        });

        
    </script>';
}
elseif($suhu_tubuh <= 33){
echo '<script>
        swal({
            title: "Suhu tubuh kurang dari 34 !",
            text: "Tidak bisa melanjutkan pendaftaran",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
}
else{
    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 

  if($ukuran_file <= 1000000){ 

    if(move_uploaded_file($tmp_file, $path)){ 

      $query = "INSERT INTO tamu (no_antri, nama, tanggal_masuk, keperluan, tanggal_keluar, bertemu, janji, suhu_tubuh, image) 

      VALUES ('$id_antri', '$nama', '$tanggal', '$keperluan', '', '$nama_d', '$janji', $suhu_tubuh, '$nama_image')";

      $sql = mysqli_query($connect, $query); 

      if($sql){
        echo '<script>
        swal({
            title: "Pendaftaran Berhasil !",
            text: "",
            type: "success"
        }).then(function() {
            window.location = "home.php";
        });
    </script>'; 
      }else{
        echo '<script>
        swal({
            title: "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.",
            text: "",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
      }
    }else{
      // Jika gambar gagal diupload, Lakukan :
      echo '<script>
        swal({
            title: "Maaf, Gambar Gagal diupload !",
            text: "",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
    }
  }else{
    // Jika ukuran file lebih dari 1MB, lakukan :
    echo '<script>
        swal({
            title: "Maaf, Ukuran Gambar Terlalu Besar",
            text: "",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
  }
}else{
  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
  echo '<script>
        swal({
            title: "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG",
            text: "",
            type: "warning"
        }).then(function() {
            window.history.back();
        });
    </script>';
}

}


}
?>
</body>
</html>