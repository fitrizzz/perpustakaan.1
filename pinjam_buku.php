<?php
    include "conn.php";
    session_start();
    $id = $_SESSION["id"];

    if(isset($_GET["bukuid"])){
        $bukuid = $_GET["bukuid"];
    }

    if(isset($_POST["hantar"])){
        $pid = $_POST["pid"];
        $bukuid = $_POST["bukuid"];
        $tpinjam = $_POST["tpinjam"];
        $tpulang = $_POST["tpulang"];

        $sql = "UPDATE buku SET status = 'tidak_tersedia' WHERE buku_id = $bukuid";
        $result = mysqli_query($conn,$sql);
    
        $sql = "INSERT INTO pinjam VALUES('','$tpinjam','$tpulang',$pid,NULL,$bukuid,'lulus')";
        $result = mysqli_query($conn,$sql);
        
        if($result == true){
            echo "<script>alert('BERJAYA PINJAM');</script>";
            header("location: home_pengguna.php");
        }else{
            echo "<script>alert('TIDAK BERJAYA')</script>";
        }
    }

?>
<html>
    <body>
        <form action="pinjam_buku.php" method="POST">
            <input type="text" name="pid" value="<?= $id ?>" readonly><br>
            <input type="text" name="bukuid" value="<?= $bukuid ?>" readonly><br>
            <input type="date" name="tpinjam" required><br>
            <input type="date" name="tpulang" required><br>
            <button type="submit" name="hantar">PINJAM</button>
        </form>
    </body>
</html>