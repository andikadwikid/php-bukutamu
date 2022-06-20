<?php

include "config.php";
include "akses.php";

// kalau tidak ada id di query string
if( !isset($_GET['no']) ){
    header('Location: view-tamu.php');
}

//ambil id dari query string
$no = $_GET['no'];

// buat query untuk ambil data dari database

$sql = "SELECT * FROM tamu WHERE no=$no";
$query = mysqli_query($connect, $sql);
$user = mysqli_fetch_array($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style-search.css">
    <link rel="stylesheet" type="text/css" href="form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Edit Data Tamu</title>
</head>

<body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.idle.js"></script>
<script type="text/javascript" src="timeout.js"></script>
<?php 

?>
<form id='form2' action="home.php">
    </form>

    <form action="proses-edit-data-tamu.php" style="border:1px solid #ccc" method="POST" enctype="multipart/form-data" 
    id="myForm">
    <div class="container">
    <h1>Edit Data Tamu</h1>
    <hr>

    <label for=""><b></b></label>
    <input type="hidden" placeholder="Masukan Nama Tamu" name="no" value="<?php echo $user['no']?>">

    <label for="email"><b></b></label>
    <input type="hidden" placeholder="Masukan Nama Tamu" name="no_antri" value="<?php echo $user['no_antri']?>">

    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label"><b>Nama</b></label>
    <input type="text" autocomplete="off" placeholder="Masukan Nama Tamu" name="nama" class="form-control" id="exampleFormControlInput1" value="<?php echo $user['nama']?>" required>
    </div>

    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label"><b>Keperluan</b></label>
    <input type="text" autocomplete="off" placeholder="Keperluan ..." name="keperluan" class="form-control" id="exampleFormControlInput1" value="<?php echo $user['keperluan']?>" required >
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"><b>Ingin bertemu siapa ?</b></label>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode/Department .." name="bertemu" onkeyup="isi_otomatis()" id="bertemu" value="<?php echo $user['bertemu']?>" required>

                <ul style="z-index: 1" id="searchResult"></ul>
                <div class="clear"></div>
                <div id="userDetail"></div>

                </div>

                <div class="col">
                    <input type="text" class="form-control in" name="nama_d" placeholder="" id="nama_d" readonly="">
                </div>
            </div>
    </div>
    
    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">
        <b>Sudah Memiliki Janji ?</b>
      </label>
        <div class="form-check">
      <input class="form-check-input" type="radio" name="janji" value=0 id="exampleRadios1" value="option1" checked>
      <label class="form-check-label" for="exampleRadios1">
        Ya
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="janji" value= 1 id="exampleRadios2" value="option2">
      <label class="form-check-label" for="exampleRadios2">
        Tidak
      </label>
    </div>
    </div>

    <label for="exampleFormControlInput1" class="form-label"><b>Suhu Tubuh Tamu</b></label>
    <input type="number" autocomplete="off" class="form-control" id="input exampleFormControlInput1" placeholder="Suhu Tubuh Tamu" name="suhu_tubuh" step="0.01" value="<?php echo $user['suhu_tubuh']?>" required>

    <label for="formFile" class="form-label"><b>Foto KTP : <b></label><br>
                <input type="file" class="form-control" id="formFile" name="foto" value="<?php echo $user['image']?>" required="required" accept="image/*;capture=camera">
                <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg</p>

    <div class="d-flex justify-content-center">
        <div class="clearfix">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success" id="button" name="daftar">Daftar</button>
                </div>
            <div class="col">
                    <button type="submit" form="form2" class="btn btn-info">Home</button>
            </div>
                <div class="col">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
        
            </div>
        </div>
    </div>
</form>


    <script type="text/javascript">
        $(document).ready(function(){

            $("#bertemu").keyup(function(){
                var search = $(this).val();

                if(search != ""){

                    $.ajax({
                        url: 'getSearch.php',
                        type: 'post',
                        data: {search:search, type:1},
                        dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            $("#searchResult").empty();
                            for( var i = 0; i<len; i++){
                                var id = response[i]['kode_d'];
                                var name = response[i]['nama_d'];

                                $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                            }

                            // binding click event to li
                            $("#searchResult li").bind("click",function(){
                                setText(this);
                            });


                        }
                    });
                }

            });


        });


        function setText(element){

            var value = $(element).text();
            var userid = $(element).val();

            $("#bertemu").val(value);
            $("#searchResult").empty();

            // Request User Details
            $.ajax({
                url: 'getSearch.php',
                type: 'post',
                data: {userid:userid, type:2},
                dataType: 'json',
                success: function(response){

                    var len = response.length;
                    $("#nama_d").empty();
                    if(len > 0){
                        var kode = response[0]['kode_d'];
                        var nama_d = response[0]['nama_d'];
                        $("#nama_d").val(nama_d);
                        
                    }
                }

            });
        }

    </script>

    <script>
    function myFunction() {
    confirm("Simpan Perubahan ?");
    }
    </script>

    <script type="text/javascript">
        const form = document.querySelector("#cForm");
                        let inputs = form.getElementsByTagName("input")
                        form.addEventListener("submit", function() {
                        console.log("Submit");
                        inputs.suhu_tubuh.value = "";
    </script>

    </body>
</html>