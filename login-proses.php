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

$username   = $_POST['username'];
$pass       = $_POST['password'];
$_SESSION['username']= $user;
$_SESSION['password']= $user;


$user = mysqli_query($connect,"select * from akun where username='$username' and password='$pass'");
$chek = mysqli_num_rows($user);
if($chek>0)
{   
        $row = mysqli_fetch_assoc($user);
            error_reporting(0);
            session_start(); 
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
        
            $_SESSION['nama'] = $row['nama'];
            echo '<script>
        swal({
        title: "Login Berhasil !",
        text: "",
        type: "success"
        }).then(function() {
        window.location = "home.php";
        });
        </script>';
        
        
    }
else if ($chek == 0) {
    echo '<script>
    swal({
        title: "Username atau Password Salah !",
        text: "",
        type: "error"
    }).then(function() {
        window.location = "login.php";
    });
</script>';
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_destroy();
}
else {
    header("location:login.php");
    unset($_SESSION['username']);
unset($_SESSION['login']);
session_destroy();
}

?>
</body>
</html>