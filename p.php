<html>

<head>

<title>Membuat export data berdasarkan range tanggal menggunakan php</title>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

</head>

<body>
    <?php 
include "config.php";
include "akses.php";

?>

<div class="container box">

<h1 align="center">Membuat export data berdasarkan range tanggal menggunakan php</h1>

<div class="table-responsive">

<div class="row">

<form method="post">

<div class="input-daterange">

<div class="col-md-4">

<input type="text" name="start_date" class="form-control" readonly/>

</div>

<div class="col-md-4">

<input type="text" name="end_date" class="form-control" readonly/>

</div>

</div>

<div class="col-md-2">

<input type="submit" name="export" value="Export" class="btnbtn-info"/>

</div>

</form>

</div>


</div>

</div>



<form method="post">

<div class="input-daterange">

<div class="col-md-4">

<input type="text" name="start_date" class="form-control" readonly/>

</div>

<div class="col-md-4">

<input type="text" name="end_date" class="form-control" readonly/>

</div>

</div>

<div class="col-md-2">

<input type="submit" name="export" value="Export" class="btnbtn-info"/>

</div>

</form>



</body>

</html>
<script>
$(document).ready(function(){

$('.input-daterange').datepicker({

todayBtn:'linked',

format:"yyyy-mm-dd",

autoclose:true

});

});

</script>