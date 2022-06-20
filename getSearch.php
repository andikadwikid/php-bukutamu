<?php
include "config.php";


$type = 0;
if(isset($_POST['type'])){
    $type = $_POST['type'];
}
// Search result
if($type == 1){
    $searchText = mysqli_real_escape_string($connect,$_POST['search']);

    $sql = "SELECT * FROM department where nama_d like '%".$searchText."%' OR kode_d like '%".$searchText."%' ORDER BY nama_d asc limit 5";

    $result = mysqli_query($connect,$sql);

    $search_arr = array();

    while($fetch = mysqli_fetch_assoc($result)){
        $id = $fetch['kode_d'];
        $name = $fetch['nama_d'];
        

        $search_arr[] = array("kode_d" => $id, "nama_d" => $name);
    }

    echo json_encode($search_arr);
}

// get User data
if($type == 2){
    $userid = mysqli_real_escape_string($connect,$_POST['userid']);

    $sql = "SELECT * FROM department where kode_d=".$userid;

    $result = mysqli_query($connect,$sql);

    $return_arr = array();
    while($fetch = mysqli_fetch_assoc($result)){
        $username = $fetch['kode_d'];
        $email = $fetch['nama_d'];

        $return_arr[] = array("kode_d"=>$username, "nama_d"=> $email);
    }

    echo json_encode($return_arr);
}