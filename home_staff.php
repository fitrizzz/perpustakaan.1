<?php
include "conn.php";
session_start();

$id = $_SESSION["id"];
$nama = $_SESSION["nama"];
$pass = $_SESSION["pass"];
$email = $_SESSION["email"];


?>

<html>
    <body>
        <h2>JADUAL BUKU</h2>
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
                                        
                    echo "<tr>
                            <th>$id</th>
                            <th>$nama</th> 
                            <th>$keterangan</th> 
                            <th>$harga</th>
                            <th>$kategori</th>
                            <th><img src='imej/$gambar'></th>
                            <th>$tersedia</th>
                            <th><a href='update_buku.php?bukuid=$id'>update</a></th>
                            <th><a href='padam.php?bukuid=$id'>padam</a></th>
                        </tr>";
                }
            ?>
        </table>
    </body>
</html>