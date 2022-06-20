<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
  <title></title>
</head>
<body>

</body>
</html>

<?php
include "config.php";

$start_date_error = '';
$end_date_error = '';

if(isset($_POST["export"]))
{
  if(empty($_POST["start_date"]))
  {
  $start_date_error = '<label class="text-danger">Start Date is required</label>';
  }
  else if(empty($_POST["end_date"]))
  {
    $end_date_error = '<label class="text-danger">End Date is required</label>';
  }
else{
  $file_name = 'Order Data.csv';

  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$file_name");
  header("Content-Type: application/csv;");

  $file = fopen('php://output', 'w');
  $header = array("Nomor Antri", "Nama Tamu", "Tanggal Masuk", "Tanggal Keluar", "Keperluan", "Bertemu Dengan", "Janji", "Suhu Tubuh");
  
  fputcsv($file, $header);

$query = "
  SELECT * FROM tamu
  WHERE tanggal_masuk>= '".$_POST["start_date"]."'
  AND tanggal_masuk <= '".$_POST["end_date"]."'
  ORDER BY tanggal_masuk DESC";

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();

foreach($result as $row)
  {
   $data = array();
   $data[] = $row["no_antri"];
   $data[] = $row["nama"];
   $data[] = $row["tanggal_masuk"];
   $data[] = $row["tanggal_keluar"];
   $data[] = $row["keperluan"];
   $data[] = $row["bertemu"];
   $data[] = $row["janji"];
   $data[] = $row["suhu_tubuh"];
  
  fputcsv($file, $data);
  }

  fclose($file);
  exit;
  }
}

$query = "
SELECT * FROM tamu
ORDER BY tanggal_masuk DESC;
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
