<?php 
include "config.php";
include "akses.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.idle.js"></script>
<script type="text/javascript" src="timeout.js"></script>
	<div align="center" class="">		
		<h1>Data Tamu Keluar </h1>
	</div>
	<br/>
	<br/>
    <script type="text/javascript">
$(document).ready(function(){

$('.input-daterange').datepicker({

todayBtn:'linked',

format:"yyyy-mm-dd",

autoclose:true

});

});

</script>
<div class="container" style="justify-content: center;">
    <form action="export-datatamu-keluar-excel.php" method="post">

        <div class="col-md-4">
            <input type="date" name="start_date" class="form-control" />
        </div>

        <div class="col-md-4">
            <input type="date" name="end_date" class="form-control" />
        </div>

        <div class="col-md-2">
            <input type="submit" name="export" value="Export" class="btn btn-success"/>
        </div>

    </form>
</div>

	<?php
    $sql = "SELECT * FROM tamu WHERE tanggal_keluar='belum keluar' ORDER BY tanggal_masuk DESC";
    $query = mysqli_query($connect, $sql);
    $user = mysqli_fetch_array($query);
    ?>
    <br>
    <br>
    <br>
    <div align="center">
            <form action="home.php"id="form1">
                <input type="submit"class="btn btn-primary" value="Home">
            </form>
        </div>
        <br>
       
	<h3 align="center"></h3>
    
        <?php
        
        if (isset($_POST['submit'])) {
   $search = $_POST['txtsearch'];
   $kategori = $_POST['kategori'];
   
   $sql = $pdo->prepare("SELECT *, timediff(tanggal_keluar,tanggal_masuk) as total FROM tamu 
                WHERE {$kategori} LIKE '%{$search}%' AND tanggal_keluar != '-' 
                ORDER BY no_antri DESC");
   $sql->execute();
        
   }

        ?>
        <div class="container">
   <form class="form-inline" method="post">
  <div class="form-group">

    <select class="form-control" id="Kolom" name="Kolom" required="">
      <?php
        $kolom=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
      ?>
      <option value="no_antri">Nomor Antri</option>
 <option value="nama">Nama Tamu</option>
    </select>

  </div>
  <div class="form-group">

    <input type="text" class="form-control" id="KataKunci" name="KataKunci" placeholder="Cari Tamu .." required="" >

  </div>
  <button type="submit" class="btn btn-primary">Cari</button>
  <a href="data-tamu.php" class="btn btn-danger">Reset</a>
</form> <br>
    <div class="container">
	<table id="myTable" border="1" class="table table-bordered" align="center">

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
            <th>Lama Kunjungan</th>
            <th>Action</th>
        </tr>
        <?php 
        
        

        include 'konek.php';

       $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
   
    $kolomCari= $_POST['Kolom'];
    
    $kolomKataKunci=$_POST['KataKunci'];

    // Jumlah data per halaman
    $limit = 10;

    $limitStart = ($page - 1) * $limit;
    
    //kondisi jika parameter pencarian kosong
    if($kolomCari=="" && $kolomKataKunci==""){
      $SqlQuery = mysqli_query($connect, "SELECT *, timediff(tanggal_keluar,tanggal_masuk) as total FROM tamu WHERE tanggal_keluar!='0000-00-00 00:00:00' ORDER BY no_antri DESC LIMIT ".$limitStart.",".$limit);
    }else{
      //kondisi jika parameter kolom pencarian diisi
      $SqlQuery = mysqli_query($connect, "SELECT *, timediff(tanggal_keluar,tanggal_masuk) as total FROM tamu WHERE tanggal_keluar!='0000-00-00 00:00:00' AND {$kolomCari} LIKE '%{$kolomKataKunci}%' ORDER BY no_antri DESC LIMIT ".$limitStart.",".$limit);
    }
    
    $no = $limitStart + 1;
    $noo = 1;
		while($data = mysqli_fetch_array($SqlQuery)){
            $p = $data['no_antri'];
            $a = substr_replace($p,"",0,9);
            $b = substr_replace($p, "", 8);

            if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                
                $hidden = 'submit';
            }else{
                $hidden = 'hidden';
            }

            if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $hapus = "<a onClick=\"javascript: return confirm('Yakin Hapus ?');\" href='delete-tamu.php?no=".$data['no']."'. onclick=return confirm('Yakin Hapus ?')>Hapus</a>";
                
            }else{
                $hapus = '';
            }
            
            if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $color = 'background-color:red;';
            }else{
                $color = 'color:;';
            }?>

            <?php
            $keluar="";
            if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $keluar = "-";
            }else{
                $keluar = $data['tanggal_keluar'];
            }
            ?>

            <?php 
            if($data['janji'] == 0){
            $janji = "Ya";
            }else{
            $janji = "Tidak";
            }
            ?>

        <?php $image = $data['image'];?>
	
        <form action='proses-keluar.php' method='POST'>
        <tr>
            <input type="hidden" name="no" value="<?php echo $data['no']?>">
            <input type="hidden" name="total" value="<?php echo $data['total']?>">
            
            <td><?php echo $noo++?></td>
            <td><input name = "no_antri" class= "x" type ='hidden' readonly value="<?php echo $data['no_antri']?>"></input><?php echo $b.$a?></td>

            <td><input name= "nama" class= "x" type='hidden' readonly value="<?php echo $data['nama']?>"></input><?php echo $data['nama']?></td>

            <td> <input name = "tanggal_masuk" class= "x" type="hidden"  readonly style="width: 170px;" value= "<?php echo $data['tanggal_masuk']?>" ></input> <?php echo $data['tanggal_masuk']?></td>

            <td> <input class= "x" type="hidden" name = "tanggal_keluar"  readonly value= "<?php echo $keluar?>"></input><p style="text-align:center"><?php echo $keluar?></p> </td>

            <td> <input class= "x" type="hidden" name = "keperluan"  readonly value= "<?php echo $data['keperluan']?>"></input><?php echo $data['keperluan']?> </td>
            

            <td> <input  class= "x" type="hidden" name = "bertemu" readonly value= "<?php echo $data['bertemu']?>"></input><?php echo $data['bertemu']?> </td>


            <td><input class= "x" type="hidden" name = "janji" readonly value= "<?php echo $janji?>"><?php echo $janji?></td>

            <td> <input class= "x" type="hidden" name = "suhu_tubuh" readonly  value= "<?php echo $data['suhu_tubuh']?>"><?php echo $data['suhu_tubuh']."&deg;"?></td>
            <td> <input class= "x" type="hidden" name = "" readonly  value= "<?php echo $data['total']?>"><?php echo $data['total']?></td>

            
            
            
            <td>
               
                <input type='<?php echo $hidden;?>' name='Submit' class="btn btn-success" value='Selesai'/>

                    <?php echo "<a href='view-tamu.php?no=".$data['no']."'>Lihat</a>"?>
                
                <?php echo $hapus;?>
            </td>
            
        </tr>
        </form>
        
                </form>
        <?php }?>

        <div align="left">
  <ul class="pagination">
    <?php
      // Jika page = 1, maka LinkPrev disable
      if($page == 1){ 
    ?>        
      <!-- link Previous Page disable --> 
      <li class="disabled"><a href="#">Previous</a></li>
    <?php
      }
      else{ 
        $LinkPrev = ($page > 1)? $page - 1 : 1;  

        if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li><a href="data-tamu-keluar.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
     <?php     
        }else{
      ?> 
        <li><a href="data-tamu-keluar.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a></li>
       <?php
         } 
      }
    ?>

    <?php
      //kondisi jika parameter pencarian kosong
      if($kolomCari=="" && $kolomKataKunci==""){
        $SqlQuery = mysqli_query($connect, "SELECT *, timediff(tanggal_keluar,tanggal_masuk) as total FROM tamu WHERE tanggal_keluar!='0000-00-00 00:00:00'");
      }else{
        //kondisi jika parameter kolom pencarian diisi
        $SqlQuery = mysqli_query($connect, "SELECT *, timediff(tanggal_keluar,tanggal_masuk) as total FROM tamu WHERE tanggal_keluar!='0000-00-00 00:00:00' FROM tamu WHERE $kolomCari LIKE '%$kolomKataKunci%'");
      }     
    
      //Hitung semua jumlah data yang berada pada tabel Sisawa
      $JumlahData = mysqli_num_rows($SqlQuery);
      
      // Hitung jumlah halaman yang tersedia
      $jumlahPage = ceil($JumlahData / $limit); 
      
      // Jumlah link number 
      $jumlahNumber = 1; 

      // Untuk awal link number
      $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
      
      // Untuk akhir link number
      $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
      
      for($i = $startNumber; $i <= $endNumber; $i++){
        $linkActive = ($page == $i)? ' class="active"' : '';

        if($kolomCari=="" && $kolomKataKunci==""){
    ?>
        <li<?php echo $linkActive; ?>><a href="data-tamu-keluar.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
      }else{
        ?>
        <li<?php echo $linkActive; ?>><a href="data-tamu-keluar.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php
      }
    }
    ?>
    
    <!-- link Next Page -->
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
<script>
$(document).ready(function(){

$('.input-daterange').datepicker({

todayBtn:'linked',

format:"yyyy-mm-dd",

autoclose:true

});

});
    
    

    <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</body>
</html>
