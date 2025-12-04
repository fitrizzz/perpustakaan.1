<?php
    include "conn.php";
    session_start();

    if(isset($_POST["hantar"])){
        $nama = $_POST["nama"];
        $pass = $_POST["pass"];
        $email = $_POST["email"];

        $sql = "SELECT nama_pengguna FROM pengguna WHERE nama_pengguna = '$nama'";
        $result = mysqli_query($conn,$sql);

        $sql2 = "SELECT staff_nama FROM staff WHERE staff_nama = '$nama'";
        $result2 = mysqli_query($conn,$sql2);

        $sql3 = "SELECT admin_nama FROM staff WHERE admin_nama = '$nama'";
        $result3 = mysqli_query($conn,$sql3);

        if( $row = mysqli_fetch_assoc($result) OR
            $row2 = mysqli_fetch_assoc($result2) OR 
            $row3 = mysqli_fetch_assoc($result3)){

            echo "USER NAMA TELAH ADA SILA GUNA NAMA YANG LAIN";
        }else{
            $sql = "INSERT INTO staff VALUES('','$pass','$nama','$email',NULL,NULL,NULL,NULL)";
            mysqli_query($conn,$sql);
        }

    }
?>
<html>
    <body>
        <form action="tambah_staff.php" method="POST">
            <input type="text" name="nama" placeholder="nama" id="">
            <input type="text" name="pass" placeholder="password" id="">
            <input type="text" name="email" placeholder="email" id="">
            <button type="submit" name="hantar">TAMBAH</button>
        </form>
        <a href="home_staff.php">BACK</a>
    </body>
</html>