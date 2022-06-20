<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" type="text/css" href="nav.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="css/clock.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Style the body */

</style>
</head>
<body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.idle.js"></script>
<script type="text/javascript" src="timeout.js"></script>
<script type="text/javascript" src="js/clock.js"></script>
<?php 
include "config.php";
include "akses.php";

?>

<div style="background-color: #56baed"class="header">
	<br>
	
  	<h1>Buku Tamu</h1>
  	<div id="MyClockDisplay" class="clock" onload="showTime()"><script type="text/javascript">showTime()</script></div>

</div>
<ul>
	<li><a href="register-tamu.php">Pendaftaran Tamu</a></li>
  	<li><a href="data-tamu.php">Data Tamu</a></li>
  	
  	<li><a href="data-tamu-keluar.php">Data Tamu keluar</a></li>
  	<li><a href="rekap-tamu.php">Rekap Laporan</a></li>
  
  <?php echo "<li style='float:right'><a class='active' onClick=\"javascript: return confirm('Yakin ingin Log out?');\" href='logout.php'. onclick=return confirm('Yakin ingin Log out?')>Log Out</a></li>"?>
  <li style="float:right"><a style="color:white"><?php echo ucfirst($_SESSION['username'])?></li>
</ul>
</div>


<h3 align="center" style="color:black">Daftar Tamu</h3><br>
<div class="container">
	<div class="table-responsive">
	<table border="1" class="table table-bordered" align="center">
		<thead class="thead-dark ">
      <div>
		<tr>
      <th>No</th>
			<th>Nomor Antri</th>
			<th>Nama Tamu</th>
			
			<th>Tanggal Masuk</th>
			<th>Tanggal Keluar</th>
			<th>Keperluan</th>
			<th>Bertemu Dengan</th>
			<th>Janji</th>
			<th>Suhu Tubuh</th>
		</tr>
	</thead>
    </div>
	<tbody>
		<?php

        $sqll = "SELECT * FROM tamu
        ORDER BY tanggal_masuk DESC";
        $query = mysqli_query($connect, $sqll);

        include 'konek.php';

        $page = (isset($_GET['page']))? $_GET['page'] : 1;
          
          $limit = 10; // Jumlah data per halamannya
          
          // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
          $limit_start = ($page - 1) * $limit;
          
          // Buat query untuk menampilkan data siswa sesuai limit yang ditentukan
          $sql = $pdo->prepare("SELECT * FROM tamu ORDER BY tanggal_masuk DESC LIMIT ".$limit_start.",".$limit);
          $sql->execute(); // Eksekusi querynya

        ?>
        <?php
        $no = $limit_start + 1;
        
        $noo = 0;

		while($data = $sql->fetch()){

			$p = $data['no_antri'];
			$a = substr_replace($p,"",0,9);
			$b = substr_replace($p, "", 8);
			if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $color = 'background-color:red;';
            }else{
                $color = 'color:;';
            }

            
            
            
            if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $keluar = "-";
            }else{
                $keluar = $data['tanggal_keluar'];
            }
            

            if($data['janji'] == 0){
            $janji = "Ya";
            }else{
            $janji = "Tidak";
            }
            
       
            $noo++;

			echo "<tr>";
      echo "<td>".$noo."</td>";
			echo "<td>".$b.$a."</td>";
			echo "<td>".$data['nama']."</td>";
			
			echo "<td style='text-align:center'>".$data['tanggal_masuk']."</td>";
			echo "<td style='text-align:center'>".$keluar."</td>";
			echo "<td>".$data['keperluan']."</td>";
			echo "<td style='text-align:center'>".$data['bertemu']."</td>";
			echo "<td>".$janji."</td>";
			echo "<td>".$data['suhu_tubuh']."&deg;"."</td>";
			
			echo "</tr>";
			$no++;
		}


	
        ?>
    </tbody>
        
	</div>
		<div align="left">
  <ul class="pagination">
    <?php
      
      if($page == 1){ 
    ?>        
      
      <li class="disabled"><a href="#">Previous</a></li>
    <?php
      }
      else{ 
        $LinkPrev = ($page > 1)? $page - 1 : 1;  

        if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li><a href="home.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
     <?php     
        }else{
      ?> 
        <li><a href="home.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a></li>
       <?php
         } 
      }
    ?>

    <?php
      
      if($kolomCari=="" && $kolomKataKunci==""){
        $SqlQuery = mysqli_query($connect, "SELECT * FROM tamu WHERE tanggal_keluar='belum keluar'");
      }else{
        
        $SqlQuery = mysqli_query($connect, "SELECT * FROM tamu WHERE $kolomCari LIKE '%$kolomKataKunci%'");
      }     
    
      
      $JumlahData = mysqli_num_rows($SqlQuery);
      
      
      $jumlahPage = ceil($JumlahData / $limit); 
      
       
      $jumlahNumber = 1; 

      
      $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
      
      
      $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
      
      for($i = $startNumber; $i <= $endNumber; $i++){
        $linkActive = ($page == $i)? ' class="active"' : '';

        if($kolomCari=="" && $kolomKataKunci==""){
    ?>
        <li<?php echo $linkActive; ?>><a href="home.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
      }else{
        ?>
        <li<?php echo $linkActive; ?>><a href="home.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php
      }
    }
    ?>
    
    
    <?php       
     if($page == $jumlahPage){ 
    ?>
      <li class="disabled"><a href="#">Next</a></li>
    <?php
    }
    else{
      $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
     if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li><a href="data-tamu.php?page=<?php echo $linkNext; ?>">Next</a></li>
     <?php     
        }else{
      ?> 
         <li><a href="data-tamu.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $linkNext; ?>">Next</a></li>
    <?php
      }
    }
    ?>
  </ul>
</div>

	</table>
</div>
</body>
</html>
