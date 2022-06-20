<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/view.css">
  <title>Detail Tamu</title>
  <style type="text/css">
    .x{
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        
    }
    
    input:focus, textarea:focus, select:focus{
        outline: none;
    }
  </style>
</head>
<body>

<?php
include 'config.php';


if( !isset($_GET['no']) ){
    header('Location: data-tamu.php');
}

//ambil id dari query string
$no = $_GET['no'];

// buat query untuk ambil data dari database
$sql = "SELECT * 
FROM tamu

 WHERE no=$no";
$query = mysqli_query($connect, $sql);
$user = mysqli_fetch_assoc($query);

$no = $user['no'];
$antri = $user['no_antri'];
$image = $user['image'];
$nama = $user['nama'];
$masuk = $user['tanggal_masuk'];
$keluar = $user['tanggal_keluar'];
$keperluan = $user['keperluan'];


$janji = $user['janji'];
$suhu = $user['suhu_tubuh'];

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}
?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Data Tamu </h2>
    

    <!-- Icon -->
    <div class="fadeIn first">

      <?php echo "<img src='upload/$image' width='200' height='150' />";?>
    </div>
    
    <?php
    if($user['tanggal_keluar'] == 'belum keluar'){
                $color = 'color:red;';
            }else{
                $color = 'color:;';
            }?>
            <?php
            $keluar="";
            if($user['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $keluar = "-";
            }else{
                $keluar = $user['tanggal_keluar'];
            }
            ?>

            <?php 
            if($janji == 0){
            $janji = "Ya";
            }else{
            $janji = "Tidak";
            }
            ?>
            
            <form action="home.php" id="form2">
            </form>
        <!-- Login Form -->
      <input type="hidden" name="no" value="<?php echo $no?>">
      <label style="color: #ccc8c8">Nomor Antri</label>
      <p id="login" class="fadeIn second " ><?php echo $antri?></p>

      <label style="color: #ccc8c8">Nama Tamu</label><br>
      <p id="login" class="fadeIn second " ><?php echo $nama?></p>

      <label style="color: #ccc8c8">Suhu Tubuh</label><br>
      <p id="login" class="fadeIn second " ><?php echo $suhu."&deg;"?></p>

      <label style="color: #ccc8c8">Tanggal Masuk</label><br>
      <p id="login" class="fadeIn second " ><?php echo $masuk?></p>

      <label style="color: #ccc8c8">Keperluan </label><br>
      <p id="login" class="fadeIn second " ><?php echo $keperluan?></p>

      

      <label style="color: #ccc8c8">Janji </label><br>
      <p id="login" class="fadeIn second " ><?php echo $janji?></p>

      <label style="color: #ccc8c8">Tanggal Keluar </label><br>
      <p id="login" class="fadeIn second " style="<?php echo $color?>" ><?php echo $keluar?></p>

     

      
        
      
      

      
      <button type="submit" form="form2">Back</button>
      

    
    

  </div>
</div>
</body>
</html>