<?php
    include "conn.php";
    session_start();

    $id = $_GET["id"];
    $status = $_GET["status"];
    $datang = $_GET["datang"];

    if($status == "pengguna"){
        // echo $status;
        $sql = "DELETE FROM pengguna WHERE pengguna_id = $id";
        mysqli_query($conn,$sql);
        header("location: home_staff.php");

    }elseif($status == "staff"){
        // echo $status;
        $sql = "DELETE FROM staff WHERE staff_id = $id";
        mysqli_query($conn,$sql);
        header("location: home_staff.php");


    }elseif($status == "buku"){
        $sql = "DELETE FROM buku WHERE buku_id = $id";
        mysqli_query($conn,$sql);

        if($datang == "staff"){
            header("location: home_staff.php");
        }else{
            header("location: home_admin.php");
        }

    }else{
        echo "NOT FOUND";
    }
?>