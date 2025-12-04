<?php
include "conn.php";
session_start();

$id = $_SESSION["id"];
$nama = $_SESSION["nama"];
$pass = $_SESSION["pass"];
$email = $_SESSION["email"];

// var_dump($id);
// var_dump($nama);
// var_dump($pass);
// var_dump($email);


?>

<html>
    <body>
        <h1>SELAMAT DATANG staff<?= $nama ?></h1>

        <br><h2>JADUAL PENGGUNA</h2>
        <h3><a href="tambah_pengguna.php">TAMBAH</a></h3>
        <table border="5px">
            <tr>
                <th>id</th>
                <th>nama</th> 
                <th>password</th> 
                <th>email</th>
                <th>UPDATE</th>
                <th>PADAM</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM pengguna";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $id = $row["pengguna_id"];
                    $nama = $row["nama_pengguna"];
                    $pass = $row["password"];
                    $email = $row["email"]; 
                    $status = "pengguna";
                    // $_SESSION["aksi"] = "update_pengguna";            
                    echo "<tr>
                            <th>$id</th>
                            <th>$nama</th> 
                            <th>$pass</th> 
                            <th>$email</th>
                            
                            <th><a href='update.php?nama=$nama & status=$status'>update</a></th>
                            <th><a href='padam.php?id=$id & status=$status'>padam</a></th>
                        </tr>";
                }
            ?>
        </table>

        <br><h2>JADUAL STAFF</h2>
        <h3><a href="tambah_staff.php">TAMBAH</a></h3>
        <table border="5px">
            <tr>
                <th>id</th>
                <th>nama</th> 
                <th>password</th> 
                <th>email</th>
                <th>UPDATE</th>
                <th>PADAM</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM staff";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $id = $row["staff_id"];
                    $nama = $row["staff_nama"];
                    $pass = $row["password"];
                    $email = $row["email"];
                    $status = "staff";         

                                        
                    echo "<tr>
                            <th>$id</th>
                            <th>$nama</th> 
                            <th>$pass</th> 
                            <th>$email</th>
                            <th><a href='update.php?nama=$nama & status=$status'>update</a></th>
                            <th><a href='padam.php?id=$id & status=$status'>padam</a></th>
                        </tr>";
                }
            ?>
        </table>

        <br><h2>JADUAL BUKU</h2>
        <h3><a href="tambah_buku.php">TAMBAH</a></h3>
        <table border="5px">
            <tr>
                <th>ISBN NUMBER</th>
                <th>nama buku</th> 
                <th>keterangan</th> 
                <th>harga</th>
                <th>kategori</th>
                <th>gambar</th>
                <th>tersedia</th>
                <th>UPDATE</th>
                <th>PADAM</th>

            </tr>
            <?php 
                $sql = "SELECT * FROM buku";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $id = $row["buku_id"];
                    $nama = $row["nama_buku"];
                    $keterangan = $row["keterangan"];
                    $harga = $row["harga"];
                    $kategori = $row["kategori"];
                    $gambar = $row["gambar"];
                    $tersedia = $row["status"];
                    $status = "buku";
                                        
                    echo "<tr>
                            <th>$id</th>
                            <th>$nama</th> 
                            <th>$keterangan</th> 
                            <th>$harga</th>
                            <th>$kategori</th>
                            <th><img src='imej/$gambar'></th>
                            <th>$tersedia</th>
                            <th><a href='update_buku.php?bukuid=$id'>update</a></th>
                            <th><a href='padam.php?id=$id'>padam</a></th>
                        </tr>";
                }
            ?>
        </table>
    </body>
</html>