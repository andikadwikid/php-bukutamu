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
            <th>Nomor Antri</th>    
            <th>Nama Tamu</th>
            
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Keperluan</th>
            <th>Bertemu Dengan</th>
            <th>Janji</th>
            <th>Suhu Tubuh</th>
            <th>Lama Berkunjung</th>
        </tr>
<?php

    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    date_default_timezone_set('Asia/Jakarta');
    $tgl    =date("Y-m-d");
    
    include "config.php";
        
     $sql = "
                  SELECT *,timediff(tanggal_keluar,tanggal_masuk) as total 
                  FROM tamu
                  WHERE tanggal_masuk >= '$start'
                  AND tanggal_masuk <= '$end'
                  AND tanggal_keluar!='belum keluar'
                  ORDER BY tanggal_masuk ASC
            ";
    $query = mysqli_query($connect, $sql);

    foreach ($query as $data){
        $pp = $data['no_antri'];
            $a = substr_replace($pp,"",0,9);
            $b = substr_replace($pp, "", 8);
        $p = "text-align:center";
        if($data['tanggal_keluar'] == "0000-00-00 00:00:00"){
                $keluar = "-";
            }else{
                $keluar = $data['tanggal_keluar'];
            }
            if($data['tanggal_keluar'] == 'belum keluar'){
                $color = 'background-color:red;';
            }else{
                $color = 'color:;';
            }
           
            if($data['janji'] == 0){
            $janji = "Ya";
            }else{
            $janji = "Tidak";
            }
           
            
            echo "<tr>";
            
            
            echo "<td>".$b.$a."</td>";
            echo "<td>".$data['nama']."</td>";
            echo "<td>".$data['tanggal_masuk']."</td>";
            echo "<td style='text-align:center'>".$keluar."</td>";
            echo "<td>".$data['keperluan']."</td>";
            echo "<td>".$data['bertemu']."</td>";
            echo "<td>".$janji."</td>";
            echo "<td style='$p'>".$data['suhu_tubuh'].'&deg'."</td>";
            echo "<td>".$data['total']."</td>";
            
            
            echo "</tr>";
        }
}
?>


</table>
</body>
</html>