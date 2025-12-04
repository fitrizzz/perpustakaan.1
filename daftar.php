<?php
    include "conn.php";

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
            // echo "fail";
                echo "<script>alert('Username telah ada sila guna yang lain')</script>";
                
        }else{
            // echo "good";
            $sql = "INSERT INTO pengguna VALUES('','$pass','$nama','$email')";
            mysqli_query($conn,$sql);

        } 

    }
?>

<html>
    <body>
    <a href="login.php">LOGIN</a>
    <a href="daftar.php">DAFTAR</a>
        <form action="daftar.php" method="POST">
            <input type="text" name="nama" placeholder="username" required><br>
            <input type="password" name="pass" placeholder="password" required><br>
            <input type="email" name="email" placeholder="email" required><br>
            <button type="submit" name="hantar">DAFTAR</button>
        </form>
    </body>
</html>
