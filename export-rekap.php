<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
<?php 
    if (isset($_POST['export'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=nama_filenya.xls");
    
    ?>

<table border="1" class="table" align="center"> 

        <tr>
            <th>Bertemu</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
        </tr>
        </tr>
<?php

    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    date_default_timezone_set('Asia/Jakarta');
    $tgl    =date("Y-m-d");
    
    include "config.php";
        
     $sql = "
                SELECT count(  (select sum(bertemu) as count 
              from  tamu
             )
          )as a, DATE_FORMAT(tamu.tanggal_masuk,'%Y-%m-%d') as tanggal, tamu.bertemu as bertemu, department.nama_d as nama , count(tamu.bertemu) as jumlah
                FROM tamu
                INNER JOIN department
                ON tamu.bertemu = department.kode_d 
                WHERE tanggal_masuk >= '$start'
                AND tanggal_masuk <= '$end'
                GROUP BY tanggal,bertemu
                ORDER BY tanggal_masuk ASC
            ";

            $query = mysqli_query($connect, $sql);


    $sql2 = "SELECT count(  (select sum(bertemu) as count 
              from  tamu
             )
          )AS a 
          
                  FROM tamu
                  WHERE tanggal_masuk >= '$start'
                AND tanggal_masuk <= '$end'
                ";
          $query2 = mysqli_query($connect, $sql2);

    


    foreach ($query as $data){    
                        
            echo "<tr>";
            echo "<td>".$data['nama']."</td>";
            echo "<td>".$data['tanggal']."</td>";
            
            echo "<td>".$data['jumlah']."</td>";
            
            echo "</tr>";
        }
    foreach ($query2 as $datas){
            echo "<tr>";
            echo "<td colspan='2'>"."<b>Total :<b>"."</td>";
            echo "<td>".$datas['a']."</td>";
            echo "</tr>";
}
}

?>


</table>
</body>
</html>