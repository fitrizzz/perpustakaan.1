<?php
    session_start();
    include "conn.php";
    $pid = $_SESSION["id"];
    
    if(isset($_GET["bukuid"])){
        $bukuid = $_GET["bukuid"];
    }

    if(isset($_POST["hantar"])){
        $pid = $_POST["pid"];
        $bukuid = $_POST["bukuid"];
        $tpinjam = $_POST["tpinjam"];
        $tpulang = $_POST["tpulang"];

        $sql = "UPDATE buku SET status = 'tidak_tersedia' WHERE buku_id = $bukuid";
        mysqli_query($conn,$sql);

        // $sql = "UPDATE buku SET tarikh_pinjam = '$tpinjam', tarikh_pulang = '$tpulang', status ='lulus'
        // WHERE ";
        // mysqli_query($conn,$sql);

        $sql = "DELETE FROM pinjam WHERE pengguna_id = $pid AND buku_id = $bukuid AND status = 'noti_me'";
        mysqli_query($conn,$sql);

        $sql = "INSERT INTO pinjam VALUES('','$tpinjam','$tpulang',$pid,NULL,$bukuid,'lulus')";
        mysqli_query($conn,$sql);

    }

    $sql = "SELECT * FROM pinjam WHERE buku_id = $bukuid and status = 'lulus' AND pengguna_id != $pid";
    $result = mysqli_query($conn,$sql);
    
    if(($row = mysqli_fetch_assoc($result)) == true){
        echo "<script>alert('ADE ORANG BELUM PULANG BUKU TU SABO LA !!!!!!!!!');</script>";
    }else{

        echo "
            <form action='terima_dari_noti_buku.php' method='POST'>
                <input type='text' name='pid' value='$pid' readonly><br>
                <input type='text' name='bukuid' value='$bukuid' readonly><br>
                <input type='date' name='tpinjam' required><br>
                <input type='date' name='tpulang' required><br>
                <button type='submit' name='hantar'>PINJAM</button>
            </form>
        ";
    }

    // header("location: home_pengguna.php");
?>