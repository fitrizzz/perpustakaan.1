<?php
    include "conn.php";
    session_start();

    if(isset($_POST["hantar"])){
        $nama = $_POST["nama"];
        $pass = $_POST["pass"];
        // echo $nama . $pass;
        // var_dump($nama);
        // var_dump($pass);

        $sql = "SELECT * FROM pengguna WHERE nama_pengguna = '$nama' AND password = '$pass'";
        $result = mysqli_query($conn,$sql);

        if($row = mysqli_fetch_assoc($result)){
            // echo "pengguna";
            $_SESSION["id"] = $row["pengguna_id"];
            $_SESSION["pass"] = $row["password"];
            $_SESSION["nama"] = $row["nama_pengguna"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["datang"] = "pengguna";

            header("Location: home_pengguna.php");



        }else{
            $sql = "SELECT * FROM staff WHERE staff_nama = '$nama' AND password = '$pass'";
            $result = mysqli_query($conn,$sql);

            if($row = mysqli_fetch_assoc($result)){
                // echo "satff";

                $_SESSION["id"] = $row["staff_id"];
                $_SESSION["nama"] = $row["staff_nama"];
                $_SESSION["pass"] = $row["password"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["datang"] = "staff";
                
    
                header("Location: home_staff.php");

            }else{
                $sql = "SELECT * FROM staff WHERE admin_nama = '$nama' AND admin_password = '$pass'";
                $result = mysqli_query($conn,$sql);

                if($row = mysqli_fetch_assoc($result)){
                    // echo "admin";

                    $_SESSION["id"] = $row["admin_id"];
                    $_SESSION["nama"] = $row["admin_nama"];
                    $_SESSION["pass"] = $row["admin_password"];
                    $_SESSION["email"] = $row["admin_email"];
                    $_SESSION["datang"] = "admin";

        
                    header("Location: home_admin.php");
                }else{
                    echo "AKUN TIDAK DAPAT DIJUMPAI";
                }
            }
        }
    }
?>

<html>
    <br>
<a href="login.php">LOGIN</a>
<a href="daftar.php">DAFTAR</a>
    <body>
        <form action="login.php" method="POST">
            <input type="text" placeholder="usernama" name="nama" required>
            <input type="password" placeholder="password" name="pass" required>
            <button type="submit" name="hantar">LOGIN</button>
        </form>
    </body>
</html>