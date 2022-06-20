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
include 'config.php';
include "akses.php";

if(isset($_POST['Submit'])){
    date_default_timezone_set('Asia/Jakarta');
    $no = $_POST['no'];
    $nama = $_POST['nama'];
    $masuk = $_POST['tanggal_masuk'];
    $keluar = $_POST['tanggal_keluar'];
    $tanggal = date("Y-m-d H:i:s");
    $total = $_POST['total'];
    
    $sql = "UPDATE tamu SET tanggal_keluar='$tanggal'
        WHERE no=$no";
    $query = mysqli_query($connect, $sql);

    if( $query ) {
        echo '<script>
        swal({
            title: "Tamu Sudah Checkout !",
            text: "",
            type: "success"
        }).then(function() {
            window.location = "data-tamu.php";
        });
    </script>';
    } 

    else {

        die("Gagal menyimpan perubahan...");
    }
}
    
    
    
    

?>
</body>
</html>