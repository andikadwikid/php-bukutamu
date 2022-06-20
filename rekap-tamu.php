<?php 
include "config.php";
include "akses.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Tamu Keluar</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="search.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.idle.js"></script>
<script type="text/javascript" src="timeout.js"></script>
	<div align="center">		
		<h1>Data Rekap</h1>
	</div>
	<br/>
	<br/>
	
	
	<h3 align="center"></h3>
		
		<div align="center">
			<form action="export-rekap.php" method="post">

		<div class="col-md-4">
		    <input type="date" name="start_date" class="form-control" />
		</div>

		<div class="col-md-4">
		    <input type="date" name="end_date" class="form-control" />
		</div><br>

		<div class="col-md-2">
		    <input type="submit" name="export" value="Export" class="btn btn-success"/>
		</div>
	</form><br>

			<form action="home.php"id="form1">
				<input type="submit"class="btn btn-primary" value="Home">
			</form>
		</div>
		<br>
	
		<div class="container">
		<div class="table-responsive">
	<table id="myTable" border="1" class="table table-bordered" align="center">
    
		<tr>
			
			
			<th>Bertemu</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
		</tr>
		<?php
        include ('akses.php');


        $sql = "SELECT DATE_FORMAT(tamu.tanggal_masuk,'%Y-%m-%d') as tanggal, tamu.bertemu as bertemu, department.nama_d as nama , count(bertemu) as jumlah 
        FROM tamu
        INNER JOIN department
        ON tamu.bertemu = department.nama_d
        GROUP BY tanggal,bertemu
        ORDER BY tanggal_masuk ASC";

        



        $sql2 = "SELECT count(  (select sum(bertemu) as count 
              from  tamu
             )
          )AS a 
                  FROM tamu";
          $query2 = mysqli_query($connect, $sql2);

        $query = mysqli_query($connect, $sql);



		foreach ($query as $data){
			
			if($data['tanggal_keluar'] == 'belum keluar'){
                $color = 'background-color:red;';
            }else{
                $color = 'color:;';
            }
			$jam = $data['total'];
            
            if($data['janji'] == 0){
            $janji = "Ya";
            }else{
            $janji = "Tidak";
            }
            
						
			echo "<tr>";
			
			echo "<td>".$data['nama']."</td>";
			echo "<td>".$data['tanggal']."</td>";
			
			echo "<td>".$data['jumlah']."</td>";
			
			echo "</tr>";
		}
			
        ?>
	</table>
</div>
</div>
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