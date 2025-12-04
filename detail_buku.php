<?php
    include "conn.php";

    if(isset($_GET["bukuid"])){
        $bukuid = $_GET["bukuid"];
    }
    // echo $buku;
    $sql = "SELECT * FROM buku WHERE buku_id = $bukuid";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    // var_dump($result);
    $nama = $result["nama_buku"];
    $keterangan = $result["keterangan"];
    $harga = $result["harga"];
    $kategori = $result["kategori"];
    $gambar = $result["gambar"];
?>
<html>
    <body>
        <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>keterangan</th>
                <th>harga</th>
                <th>kategori</th>
                <th>gambar</th>
            </tr>
            <tr>
                <th><?= $bukuid ?></th>
                <th><?= $nama ?></th>
                <th><?= $keterangan ?></th>
                <th><?= $harga ?></th>
                <th><?= $kategori ?></th>
                <th><img src="imej/<?=$gambar?>"></th>
            </tr>
        </table>

    </body>
</html>