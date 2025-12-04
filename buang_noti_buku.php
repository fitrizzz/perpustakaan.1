<?php
    session_start();
    include "conn.php";

    $pid = $_SESSION["id"];
    $bukuid = $_GET["bukuid"];

    $sql = "DELETE FROM pinjam WHERE pengguna_id = $pid AND buku_id = $bukuid AND status = 'noti_me'";
    mysqli_query($conn,$sql);

    header("location: home_pengguna.php");
?>